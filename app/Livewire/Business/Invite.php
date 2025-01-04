<?php

namespace App\Livewire\Business;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\InviteUser;
use App\Models\Invitation;
use RealRashid\SweetAlert\Facades\Alert;

class Invite extends Component
{

    public $inviteModal = false;
    public $email;

    public function cancel() {
        return $this->inviteModal = false;
    }

    public function invite() {
        return $this->inviteModal = true;
    }

    public function sendInvite() {
        $validated = $this->validate([
            'email' => 'email'
        ]);

        Mail::to($this->email)->send(new InviteUser());

        $this->inviteModal = false;

        $invitation = Invitation::create([
            "email" => $validated['email'],
            "business_id" => session('businessId'),
            "user_id" => Auth::user()->id
        ]);

        session()->flash('success', 'Invite Sent Successfully to User!');
        return redirect()->route('business.invites');

        $invitation = Invitation::create([
            "email" => "",
            "business_id" => session('businessId'),
            "user_id" => Auth::user()->id
        ]);

       // $this->alert('question', 'Invite Send successfully to user!');
      // Alert::success('Success Title', 'Success Message');
    }

    public function resend($email) {
        $this->email = $email;
        $this->sendInvite();
    }

    public function render()
    {
        $invitations = Invitation::paginate(10);
        return view('livewire.business.invite', compact('invitations'));
    }
}
