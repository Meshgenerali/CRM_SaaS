<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
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

    public function selectBusiness($businessId, Request $request) {

        try {

                $business = Business::findOrFail($businessId);
                if (!Auth::user()->businesses->contains($business->id)) {
                    abort(403, 'Unauthorized Access To This Business.');
                }

                    $request->session()->put('businessId', $business->id);
                    $this->redirect('/dashboard');

        } catch (ModelNotFoundException $e) {

                Log::warning('Invalid business access attempt', [
                    'user_id' => Auth::id(),
                    'attempted_business_id' => $businessId,
                    'ip' => $request->ip()
                ]);

                return redirect()->back();
           
        }


    }

    public function render()
    {
        return view('livewire.business.select');
    }
}
