<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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

        Lead::create($formData);

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
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('leads.index');
    }
}
