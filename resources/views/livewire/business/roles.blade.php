
<div class="p-6 bg-gray-900 text-gray-100 min-h-screen">
    <div class="flex flex-wrap justify-between items-center mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-white mb-2 sm:mb-0">Role Management</h2>
        <div class="flex flex-wrap gap-2 sm:gap-4">
            <x-button wire:click="createNewRole">Create Role</x-button>
            {{-- <input type="text" 
                   wire:model.debounce.300ms="search" 
                   placeholder="Search roles..."
                   class="rounded-md bg-gray-800 border-gray-700 text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400 w-full sm:w-auto"> --}}
        </div>
    </div>
    

    {{-- Roles List --}}
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">

        <div class="overflow-x-auto">
            <x-table>
                <thead class="bg-gray-700">
                    <tr>
                        <x-th>Name</x-th>
                        <x-th>Actions</x-th>
                    </tr>
                </thead>
                <x-tbody>
                    @foreach($roles as $role)
                        <x-tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $role->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-4">
                                    <button wire:click="edit({{ $role->id }})" class="...">Edit</button>
                                    <button wire:click="confirmDelete({{ $role->id }})" class="...">Delete</button>
                                </div>
                            </td>
                        </x-tr>
                    @endforeach
                </x-tbody>
            </x-table>
        </div>
        

        <div class="px-6 py-4 bg-gray-800">
            {{ $roles->links() }}
        </div>
    </div>

    <x-dialog-modal wire:model="assignPermissions">
        <!-- <x-slot name="title">
            Register
        </x-slot> -->
    
        <x-slot name="content">
            
            <h2 class="text-xl font-bold text-center mb-6">Manage Roles & Permissions</h2>

            <div>
                <label class="block text-sm font-medium text-gray-300">Role Name</label>
                <input type="text" 
                       wire:model="name"
                       class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') 
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <label class="block mt-4 text-sm font-medium text-gray-300">Permissions</label>
            @foreach ($permissions as $permission)
            <div class="block mt-4 mb-8">
                <label for="permission{{$permission->id}}" class="flex items-center">
                    <x-checkbox 
                        wire:model="selectedPermissions" 
                        id="permission{{$permission->id}}"
                        value="{{ $permission->id }}"    
                    />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission->name }}</span>
                </label>
            </div>
    
            @endforeach
                <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                    Cancel
                </x-secondary-button>
        
                <x-danger-button class="ml-2" wire:click="save" wire:loading.attr="disabled">
                    Save
                </x-danger-button>
            
        </x-slot>
    
        {{-- <x-slot name="footer">
            <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
    
            <x-danger-button class="ml-2" wire:click="sendInvite" wire:loading.attr="disabled">
                Send Invite
            </x-danger-button>
        </x-slot> --}}
    
    </x-dialog>


    {{-- Delete Confirmation Modal --}}
     @if($showDeleteModal)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-700">
                    <div class="bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                                <!-- Heroicon name: outline/exclamation -->
                                <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-200" id="modal-title">
                                    Delete Role
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-400">
                                        Are you sure you want to delete this role? This action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button"
                                wire:click="delete"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-150">
                            Delete
                        </button>
                        <button type="button"
                                wire:click="cancel"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-600 shadow-sm px-4 py-2 bg-gray-700 text-base font-medium text-gray-200 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-150">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif 

{{-- Updating only the Flash Messages section for brevity --}}

{{-- Flash Messages --}}
@if (session()->has('success'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                bg-green-600 text-white py-3 px-6 rounded-lg shadow-xl text-sm
                border border-green-500 z-50 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        {{ session('success') }}
    </div>
@endif

{{-- Error Flash Messages (optional but recommended) --}}
@if (session()->has('error'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                bg-red-600 text-white py-3 px-6 rounded-lg shadow-xl text-sm
                border border-red-500 z-50 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
        </svg>
        {{ session('error') }}
    </div>
@endif
</div>

{{-- Add this to your layout to ensure Livewire styles work with dark theme --}}
@push('styles')
<style>
    /* Dark theme pagination styling */
    .dark .pagination-link {
        @apply bg-gray-800 text-gray-300 border-gray-600 hover:bg-gray-700;
    }
    
    .dark .pagination-active {
        @apply bg-indigo-600 text-white border-indigo-600;
    }
</style>
@endpush