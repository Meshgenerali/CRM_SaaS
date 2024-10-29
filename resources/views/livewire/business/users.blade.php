<div>
   <table class="w-full text-sm text-left">
    <thead class="bg-gray-700/50 text-gray-200 uppercase">
        <tr>
            <th class="px-6 py-4 font-medium">Name</th>
            <th class="px-6 py-4 font-medium">Email</th>            
            <th class="px-6 py-4 font-medium">Role</th>
            <th class="px-6 py-4 font-medium text-right">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-700">
        @foreach ($users as $user)
        <tr class="hover:bg-gray-700/50 text-gray-300">
            <td class="px-6 py-4">{{$user->name}}</td>
            <td class="px-6 py-4">{{$user->email}}</td>
            <td class="px-6 py-4">
                @foreach ($user->roles as $role)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900/50 text-blue-200 border border-blue-700">
                    {{$role->name}}
                </span>
                @endforeach
               
            </td>
            <td class="px-6 py-4 text-right">
                <div class="flex items-center justify-end space-x-3">
                    <button wire:click="edit('{{$user->id}}')" class="text-blue-400 hover:text-blue-300 p-1 hover:bg-blue-400/10 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <button class="text-red-400 hover:text-red-300 p-1 hover:bg-red-400/10 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<x-dialog-modal wire:model="assignRoles">
    <!-- <x-slot name="title">
        Register
    </x-slot> -->

    <x-slot name="content">
        <h2 class="text-xl font-bold text-center mb-6">Assign Roles to User</h2>
        @foreach ($roles as $role)
        <div class="block mt-4">
            <label for="role{{$role->id}}" class="flex items-center">
                <x-checkbox 
                    wire:model="selectedRoles" 
                    id="role{{$role->id}}"
                    value="{{ $role->id }}"    
                />
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $role->name }}</span>
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

</div>