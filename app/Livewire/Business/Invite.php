<?php

namespace App\Livewire\Business;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\InviteUser;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Invite extends Component
{
    use LivewireAlert;

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

        return $this->inviteModal = false;

        $this->alert('question', 'Invite Send successfully to user!',[
            'showConfirmButton' => true
        ]);
    }

    public function render()
    {
        return view('livewire.business.invite');
    }
}
