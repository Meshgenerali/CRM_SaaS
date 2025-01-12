<?php

namespace App\Livewire\Kanban;

use Livewire\Component;
use App\Models\Lead;

class Board extends Component
{
    public $leads;
    public $statuses = ['new','contacted', 'converted'];
    public $data = [
        'new' => [],
        'contacted' => [],
        'converted'=> [],
    ];

    public function mount() {
      $this->groupData();
    }

    public function groupData() {
        $this->reset('data');
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
    public function render()
    {
        return view('livewire.kanban.board');
    }
}
