<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\Component;
use App\Models\Plan;

use Carbon\Carbon;
class Subscriptions extends Component
{
    public $business;
    public $plans;
    public $selectedPlan;

    public function mount() {
        $this->business = Business::find(session('businessId'));
        $this->plans = Plan::all();
    }

    public function selectPlan($planId)
    {
        $this->selectedPlan = $planId;
        $businessData = [
            'plan_id' => $this->selectedPlan,
            'expire_at' => Carbon::now()->addDays(Plan::find($this->selectedPlan)->trial_duration),
        ];

        $this->business->update($businessData);
    }

    // public function selectPlan(Plan $plan) {
        
    //     $this->selectedPlan = $plan;
    //     $businessData = [
    //         'plan_id' => $this->plan,
    //         'expire_at' => Carbon::now()->addDays(Plan::find($this->selectedPlan)->trial_duration),
    //     ];

    //     $this->business->update($businessData);
    // }

    public function render()
    {
        return view('livewire.business.subscriptions');
    }
}
