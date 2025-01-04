
<div class="p-6 bg-gray-900 text-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-white">Role Management</h2>
        <x-button wire:click="createNewRole">Create Role</x-button>
        <div class="flex space-x-4">
            <input type="text" 
                   wire:model.debounce.300ms="search" 
                   placeholder="Search roles..."
                   class="rounded-md bg-gray-800 border-gray-700 text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 placeholder-gray-400">
        </div>
    </div>

    {{-- Roles List --}}
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Name</th>
                    
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 divide-y divide-gray-700">
                @foreach($roles as $role)
                    <tr class="hover:bg-gray-700 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-200">{{ $role->name }}</td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-4"> {{-- Changed space-x-3 to gap-4 for better separation --}}
                                <button wire:click="edit({{ $role->id }})"
                                        class="inline-flex items-center px-3 py-2 border border-indigo-500 shadow-sm text-sm font-medium rounded-md text-indigo-300 bg-gray-800 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-800 transition-all duration-150 ease-in-out group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-indigo-400 group-hover:text-white transition-colors duration-150" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $role->id }})"
                                        class="inline-flex items-center px-3 py-2 border border-red-500 shadow-sm text-sm font-medium rounded-md text-red-300 bg-gray-800 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 focus:ring-offset-gray-800 transition-all duration-150 ease-in-out group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-red-400 group-hover:text-white transition-colors duration-150" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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