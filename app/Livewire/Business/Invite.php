<?php

namespace App\Livewire\Business;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUser;
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
        $this->validate([
            'email' => 'email'
        ]);

        Mail::to($this->email)->send(new InviteUser());

        $this->inviteModal = false;

        session()->flash('success', 'Invite Sent Successfully to User!');
        return redirect()->route('dashboard');

       // $this->alert('question', 'Invite Send successfully to user!');
      // Alert::success('Success Title', 'Success Message');
    }

    public function render()
    {
        return view('livewire.business.invite');
    }
}
