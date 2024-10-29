<?php

namespace App\Livewire\Business;

use App\Models\Business;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class Roles extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $name;
    public $selectedRole;
    public $isEditing = false;
    public $showDeleteModal = false;
    public $search = '';
    public $assignPermissions = false;
    public $permissions;
    public $permissionIds;
    public $selectedPermissions = [];  

    protected $rules = [
        'name' => 'required|min:3|max:50',
        'selectedPermissions' => 'required|array|min:1' 
    ];

    public function mount() 
    {
        if (! Gate::allows('view roles')) {
            abort(403);
        }
        $this->permissions = Business::find(session('businessId'))->plan->permissions;
    }

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

    public function createNewRole() 
    {   
        $this->reset(['name', 'selectedPermissions', 'selectedRole']); 
        $this->permissions = Business::find(session('businessId'))->plan->permissions;
        $this->assignPermissions = true;
        $this->isEditing = false;
    }

    public function create()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'business_id' => session('businessId')
        ]);

        // Sync the selected permissions
        if (!empty($this->selectedPermissions)) {
            $role->permissions()->sync($this->selectedPermissions);
        }

        $this->reset(['name', 'selectedPermissions']);
        $this->assignPermissions = false;
        session()->flash('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $this->assignPermissions = true;
        $this->selectedRole = $role;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->name = $role->name;
        $this->isEditing = true;
    }

    public function save()
    {

        $this->validate();

        if ($this->isEditing) {
            // Update existing role
            $this->selectedRole->update([
                'name' => $this->name,
            ]);
            $this->selectedRole->permissions()->sync($this->selectedPermissions);
            session()->flash('success', 'Role updated successfully.');
        } else {
            // Create new role
            $role = Role::create([
                'name' => $this->name,
                'business_id' => session('businessId')
            ]);
            $role->permissions()->sync($this->selectedPermissions);
            session()->flash('success', 'Role created successfully.');
        }

        $this->assignPermissions = false;
        $this->reset(['name', 'selectedRole', 'selectedPermissions', 'isEditing']);
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
        $this->assignPermissions = false;
        $this->showDeleteModal = false;
        $this->reset(['name', 'selectedRole', 'selectedPermissions']);
    }
}