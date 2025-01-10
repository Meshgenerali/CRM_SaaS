<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Auth;

class Unread extends Component
{

    public function read($notificationId) {
        $notification = Auth::user()->notifications()->find($notificationId);
        $notification->markAsRead();
        $this->redirect($notification->data['link']); 
    }
    public function render()
    {
        return view('livewire.notifications.unread');
    }
}
