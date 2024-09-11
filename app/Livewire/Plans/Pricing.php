<?php

namespace App\Livewire\Plans;

use Livewire\Component;
use App\Models\Plan;

class Pricing extends Component
{
    public $plans;
    public $selectedPlan;

    public function mount() {
        $this->plans = Plan::all();
    }

    public function selectPlan(Plan $plan) {
        
        $this->selectedPlan = $plan;
        $this->dispatch('selected-plan', $plan); 
    }
    public function render()
    {
        return view('livewire.plans.pricing');
    }
}
