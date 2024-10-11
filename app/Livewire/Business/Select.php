<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\Component;
use Illuminate\Http\Request;

class Select extends Component
{
    public $showSelection = false;
    public $businessId;
    public $showButton;

    public function mount(Request $request)
    {

        if($request->selectBusiness=='true') {
            $this->showSelection = true;
        }
    }

    public function change() {
        $this->showSelection = true;
    }

    public function selectBusiness(Business $business, Request $request) {
        //dd($business->id);
        $request->session()->put('businessId', $business->id);
        $this->redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.business.select');
    }
}
