<?php

namespace App\Livewire\Kanban;

use Livewire\Component;
use App\Models\Lead;
use App\Models\LeadStatus;

class Board extends Component
{
    public $leads;
    public $statuses = [];
    public $data = [];

    public function mount() {
      $this->loadStatuses();  
      $this->groupData();
    }

    // load default plus custom statuses
    
    public function loadStatuses() {
        // Default CRM statuses
        $defaultStages = ['new', 'contacted', 'converted'];

        // Custom stages from database (scoped by business automatically)
        $customStages = LeadStatus::all()->pluck('name')->toArray();

        // Merge and remove duplicates
        $this->statuses = array_unique(array_merge($defaultStages, $customStages));

        // Initialize the data buckets
        foreach ($this->statuses as $status) {
            $this->data[$status] = [];
        }
    }

    public function groupData() {
        $this->reset('data');

        // Get all stages (slugs as keys)
        $stages = LeadStatus::orderBy('order')->get();
        
        foreach ($stages as $stage) {
            $this->data[$stage->slug] = [];
        }

        $this->leads = Lead::all();
        foreach($this->leads as $lead) {
            $this->data[$lead->status][] = $lead;
        }
    }

    public function updateLeadStatus($orderedData) {
        
        foreach($orderedData as $group) {
            foreach($group['items'] as $item) {
                Lead::find($item['value'])->update(["status"=>$group['value']]);
            }
        }

        $this->groupData();
    }

    public function openAddStageModal()
    {
        // Emit event to open the Add Stage modal
        $this->dispatch('openAddStageModal');
    }

    public function render()
    {
        return view('livewire.kanban.board');
    }
}
