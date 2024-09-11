<?php

namespace App\Livewire\Business;

use App\Models\Plan;
use Livewire\Component;
use Livewire\Attributes\On;

class Register extends Component
{

    public $showForm = false;
    public $planSelected;

    public $plans;

    public function mount() {
        $this->plans = Plan::all();
    }

    #[On('selected-plan')]
    public function selectedPlan(Plan $plan) {

        $this->planSelected = $plan;
        $this->showForm = true;
    }
    public function render()
    {
        return view('livewire.business.register');
    }
}
