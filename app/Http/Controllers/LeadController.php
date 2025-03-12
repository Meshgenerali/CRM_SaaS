<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use OpenAI\Laravel\Facades\OpenAI;
use App\Exports\LeadsExport;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function analyze() {
        // use try catch block here ....
        $result = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello!'],
            ],
        ]);
        
        dd($result->choices[0]->message->content); 
    }
}
