<?php

namespace App\Livewire\Business;


use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

use App\Models\Role;

class Roles extends Component
{
 
    use WithPagination;
    use AuthorizesRequests;

    public $name;
    public $selectedRole;
    public $isEditing = false;
    public $showDeleteModal = false;
    public $search = '';

    protected $rules = [
        'name' => 'required|min:3|max:50'
    ];

    public function render()
    {
        $roles = Role::where('business_id', session('businessId'))
            ->when($this->search, function($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.business.roles', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $this->validate();

        Role::create([
            'name' => $this->name,
            'business_id' => session('businessId')
        ]);

        $this->reset(['name']);
        session()->flash('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $this->selectedRole = $role;
        $this->name = $role->name;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $this->selectedRole->update([
            'name' => $this->name,
        ]);

        $this->isEditing = false;
        $this->reset(['name', 'selectedRole']);
        session()->flash('success', 'Role updated successfully.');
    }

    public function confirmDelete(Role $role)
    {
        $this->selectedRole = $role;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->selectedRole->delete();
        $this->showDeleteModal = false;
        $this->reset(['selectedRole']);
        session()->flash('success', 'Role deleted successfully.');
    }

    public function cancel()
    {
        $this->isEditing = false;
        $this->showDeleteModal = false;
        $this->reset(['name',  'selectedRole']);
    }
}
