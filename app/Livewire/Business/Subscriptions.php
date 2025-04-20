<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\Component;
use App\Models\Plan;
use App\Models\BusinessPlan;

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

        $this->businessSubscription($this->business);
    }


    public function businessSubscription() {
        $plan = Plan::findOrFail($this->selectedPlan);

        $startDate = now();
        $trialEndsAt = $startDate->copy()->addDays($plan->trial_duration);
        $endsAt = $startDate->copy()->addDays($plan->duration);
    
        // Update existing active subscription or create a new one
        $subscription = BusinessPlan::where('business_id', $this->business->id)
            ->where('is_active', true)
            ->latest()
            ->first();
    
        if ($subscription) {
            // Deactivate the old plan
            $subscription->update(['is_active' => false]);
        }
    
        // Create a new plan entry
        return BusinessPlan::create([
            'business_id'   => $this->business->id,
            'plan_id'       => $plan->id,
            'starts_at'     => $startDate,
            'ends_at'       => $endsAt,
            'trial_ends_at' => $trialEndsAt,
            'is_trial'      => true,
            'is_active'     => true,
        ]);
    }

    public function render()
    {
        return view('livewire.business.subscriptions');
    }
}
