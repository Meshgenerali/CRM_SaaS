<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use OpenAI\Laravel\Facades\OpenAI;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::paginate(10);
        return view('leads.index', compact('leads'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:new,contacted,converted',
            'message' => 'nullable|string',
        ]);
        
        $formData['business_id'] = session('businessId');
        $lead = Lead::create($formData);
        session()->flash('message', 'Lead Created Successfully!');
        return redirect()->route('leads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:new,contacted,converted',
            'message' => 'nullable|string',
        ]);

        $lead->update($formData);

        session()->flash('message', 'Lead Updated Successfully!');
        return redirect()->route('leads.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy(Lead $lead)
    {
        $lead->delete(); 

        return redirect()->route('leads.index');
    }

    // contact lead

    public function contact(Lead $lead) {
        return view('leads.contact', compact('lead'));
    }

    // send email to lead

    public function sendemail(Lead $lead, Request $request) {
        dd($request->lead->id);
    }

    public function leads_export() {
        return Excel::download(new LeadsExport, 'leads.xlsx');
    }

    public function leads_upload() {
        
        return view('leads.upload');
    }

    public function leads_import(Request $request) {
        $request->validate([
            'file' => 'required|mimetypes:text/csv|mimes:csv'
        ]); 
        Excel::import(new LeadsImport, request()->file('file'));
        session()->flash('message', 'Leads Imported Successfully');  
        return redirect()->route('leads.index');      
    }

    public function analyze(Request $request) {
        $leadId = $request->lead_id;
        $lead = Lead::findOrFail($leadId);
        $prompt = "Given this lead:\n\n" .
                "Name: {$lead->name}\n" .
                "Message: {$lead->message}\n\n" .
                "Generate a JSON response containing:\n" .
                "- summary: a one-line summary of the lead intent\n" .
                "- priority: High, Medium or Low based on urgency and intent\n" .
                "- follow_up: a professional follow-up email";
        
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-goog-api-key' => config('services.gemini.api_key'),
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ]
            ]);

        if (!$response->ok()) {
            return response()->json([
                'error' => 'Gemini API call failed',
                'status' => $response->status(),
                'body' => $response->body()
            ], 500);
        }
    
                // Safely extract AI text response
                $aiContent = $response->json('candidates.0.content.parts.0.text') ?? $response->json('candidates.0.content.parts.0') ?? null;

                if (!$aiContent) {
                    return response()->json([
                        'error' => 'No AI response',
                        'response' => $response->json()
                    ], 500);
                }

                // Log raw response
                \Log::info('Raw Gemini AI Response:', ['content' => $aiContent]);

                // Extract JSON block from the code block
                if (preg_match('/```json(.*?)```/s', $aiContent, $matches)) {
                    $cleanJson = trim($matches[1]);

                    try {
                        $parsed = json_decode($cleanJson, true);

                        if (is_array($parsed)) {
                            // Save to database
                            $lead->ai_analysis = json_encode($parsed, JSON_PRETTY_PRINT);
                            $lead->save();

                            return redirect()->back()->with('message', 'AI analysis generated and saved successfully.');
                        }

                        return response()->json([
                            'error' => 'JSON parsing failed',
                            'raw' => $cleanJson
                        ], 500);
                    } catch (\Throwable $e) {
                        return response()->json([
                            'error' => 'Failed to decode JSON',
                            'exception' => $e->getMessage(),
                            'raw' => $cleanJson
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'error' => 'No JSON block found in AI content',
                        'raw' => $aiContent
                    ], 500);
                }


    }
}
