<?php

namespace App\Livewire\Business;

use App\Models\Plan;
use App\Models\Business;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;


class Register extends Component
{
    use UsesSpamProtection;

    public $showForm = false;
    public $planSelected;
    public $plans;
    public $currentStep = 1;

    // Business Information
    public $businessName;
    public $businessEmail;
    public $businessPhone;
    public $businessAddress;
    public $businessCity;
    public $businessIndustry;

    // User Information
    public $firstName;
    public $email;
    public $password;
    public $passwordConfirmation;

    protected $rules = [
        'planSelected' => 'required',
        'businessName' => 'required|min:2',
        'businessEmail' => 'required|email',
        'businessPhone' => 'required',
        'businessAddress' => 'required',
        'businessCity' => 'required',
        'businessIndustry' => 'required',
        'firstName' => 'required|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|same:passwordConfirmation',
    ];

    public HoneypotData $extraFields;
    
    public function mount(Request $request)
    {
        $this->extraFields = new HoneypotData();
        $this->plans = Plan::all();

        if($request->register=='true') {
            $this->showForm = true;
        }
    }

    #[On('selected-plan')]
    public function selectedPlan(Plan $plan)
    {
        $this->planSelected = $plan->id;
        $this->currentStep = 2;
        $this->showForm = true;
       // dd($this->planSelected);  
       
    }

    public function selectPlan($planId)
    {
        $this->planSelected = $planId;
    }

    public function nextStep()
    {
        if ($this->currentStep < 3) {
            $this->validateStep($this->currentStep);
            $this->currentStep++;
            //dd(Plan::find($this->planSelected)->trial_duration);
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    private function validateStep($step)
    {
        switch ($step) {
            case 1:
                $this->validate(['planSelected' => 'required']);
                break;
            case 2:
                $this->validate([
                    'businessName' => 'required|min:2',
                    'businessEmail' => 'required|email',
                    'businessPhone' => 'required',
                    'businessAddress' => 'required',
                    'businessCity' => 'required',
                    'businessIndustry' => 'required',
                ]);
            
                if(Auth::check()) {
                    $business = $this->createBusiness();
                    $user = Auth::user();
                    $role = Role::where('name', 'admin')->first();
                    $user->businesses()->attach($business->id);
                    $user->roles()->attach($role->id);
                    $this->redirectRoute('dashboard');
                }

                break;
        }
    }

    public function validateStep2()
    {
        $this->validateStep(2);
        return true;
    }

    public function submitRegistration()
    {
        $this->validate();

        $this->protectAgainstSpam();


        $business = $this->createBusiness();

        $user = User::create([
            'name' => $this->firstName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // assign admin role to the first user automatically
        $role = Role::where('name', 'admin')->first();
        // Create the user and associate with the business
        $business->users()->attach($user->id);
        $user->roles()->attach($role->id);

        $this->redirectRoute('login');
        // $this->reset();
        $this->showForm = false;

        // Emit an event or set a flash message
        // session()->flash('message', 'Registration successful!');
        // $this->dispatch('registration-successful');
    }

    public function createBusiness() {
        $businessData = [
            'plan_id' => $this->planSelected,
            'name' => $this->businessName,
            'email' => $this->businessEmail,
            'phone' => $this->businessPhone,
            'address' => $this->businessAddress,
            'city' => $this->businessCity,
            'industry' => $this->businessIndustry,
            'expire_at' => Carbon::now()->addDays(Plan::find($this->planSelected)->trial_duration),
        ];

        return Business::create($businessData);
    }

    public function render()
    {
        return view('livewire.business.register', [
            'currentStep' => $this->currentStep
        ]);
    }
}