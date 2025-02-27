
<div>

    <x-button wire:click="invite">Invite User</x-button>
    <br> <br>

    <table class="w-full text-sm text-left">
        <thead class="bg-gray-700/50 text-gray-200 uppercase">
            <tr>
                <th class="px-6 py-4 font-medium">#</th>
                <th class="px-6 py-4 font-medium">Email</th>
                <th class="px-6 py-4 font-medium">Send At</th>
                <th class="px-6 py-4 font-medium">Actions</th>
            </tr>
        </thead>
        @php
        $index_serial = ($invitations->currentPage()-1) * $invitations->perPage()+1;
        @endphp
        <tbody class="divide-y divide-gray-700">
            @foreach ($invitations as $invitation)
            <tr class="hover:bg-gray-700/50 text-gray-300">
                <td class="px-6 py-4 font-medium text-gray-200">{{$index_serial++}}</td>
                <td class="px-6 py-4">{{$invitation->email}}</td>
                <td class="px-6 py-4">{{$invitation->created_at}}</td>
                <td class="px-6 py-4">
                    <x-secondary-button wire:click="resend('{{$invitation->email}}')">Resend</x-secondary-button>
                </td>
            </tr>  
            @endforeach         
        </tbody>
    </table>
    
<x-dialog-modal wire:model="inviteModal">
    <!-- <x-slot name="title">
        Register
    </x-slot> -->

    <x-slot name="content">

        <div class="mb-4">
            <label class="block text-gray-400 mb-2">User Email</label>
            <input wire:model.defer="email" type="email" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter User Email">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
            Cancel
        </x-secondary-button>

        <x-danger-button class="ml-2" wire:click="sendInvite" wire:loading.attr="disabled">
            Send Invite
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

</x-dialog-modal>

<div wire:loading class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-gray-800 text-white p-4 rounded-lg shadow-lg border border-gray-700 flex items-center space-x-3">
        <!-- Loading spinner -->
        <svg class="animate-spin h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Rendering your page...</span>
    </div>
</div>

</div>
