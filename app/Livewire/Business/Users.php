<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use App\Models\User;
use App\Notifications\CommonNotification;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    public $roles;
    public $assignRoles = false;
    public $user;
    public $selectedRoles = [];

    public function mount() {
        $this->roles = Role::all();
    }

    public function edit(User $user) {
        $this->user = $user;
        $this->assignRoles = true;

        $roleIds = $user->roles->flatten()->pluck('id');
        // getting roleid as an array
        $this->selectedRoles = $roleIds->toArray();


    }

    public function save() {
        $this->user->roles()->sync($this->selectedRoles);
        $this->assignRoles = false;

        $message = "User Roles updated for ".$this->user->name;
        $link = route('business.users');
        Auth::user()->notify(new CommonNotification($message, $link));
    }

    public function cancel() {
        $this->assignRoles = false;
    }
    public function render()
    {
        return view('livewire.business.users', [
            'users' => Business::find(session('businessId'))->users()->paginate(10)
        ]);
    }
}
