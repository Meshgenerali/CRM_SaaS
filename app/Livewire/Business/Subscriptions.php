<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\Component;
use App\Models\Plan;
use App\Models\BusinessPlan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;

use Carbon\Carbon;
class Subscriptions extends Component
{
    public $business;
    public $plans;
    public $selectedPlan;
    public $paymentModal = false;
    public $mpesaNumber = '';

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

    // show payment modal
    public function subscribeNow() {
        $this->paymentModal = true;
    }

    public function stkPush(Request $request) {

        $this->validate([
            'mpesaNumber' => ['required', 'numeric', 'digits:9'],
        ], [
            'mpesaNumber.required' => 'Please enter your M-Pesa number',
            'mpesaNumber.numeric' => 'M-Pesa number must be numeric',
            'mpesaNumber.digits' => 'M-Pesa number must be 9 digits'
        ]);

         // Format phone number to 254 format
         $phone = '254' . $this->mpesaNumber;
            
         // Get selected plan price
         $amount = (int) $this->business->plan->price;
    
            $mpesa = new \Safaricom\Mpesa\Mpesa();
    
            $BusinessShortCode = '174379'; // e.g. 174379 for sandbox
            $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
            $TransactionType = 'CustomerPayBillOnline';
            $Amount = $amount;
            $PartyA = $phone;
            $PartyB = '174379';
            $PhoneNumber = $phone;
            $CallBackURL = 'http://yourdomain.com/mpesa/callback'; // call route('mpesa.callback')
            $AccountReference = 'SAASCRM';
            $TransactionDesc = 'SaaS CRM Subscription';
            $Remarks = 'Payment for CRM Access';
    
            try {
                $stkResponse = $mpesa->STKPushSimulation(
                    $BusinessShortCode,
                    $LipaNaMpesaPasskey,
                    $TransactionType,
                    $Amount,
                    $PartyA,
                    $PartyB,
                    $PhoneNumber,
                    $CallBackURL,
                    $AccountReference,
                    $TransactionDesc,
                    $Remarks
                );

                dd($stkResponse);
    
                // return response()->json([
                //     'message' => 'STK push initiated',
                //     'response' => $stkResponse
                // ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => 'Failed to initiate STK push',
                    'message' => $e->getMessage()
                ], 500);
            }
    }

    public function cancel() {
        return $this->paymentModal = false;
    }

    public function render()
    {
        return view('livewire.business.subscriptions');
    }
}
