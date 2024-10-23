
<div>

    <x-button wire:click="invite">Invite User</x-button>
    <br> <br>
    
    <div class="bg-gray-700 text-white text-2xl">
        <div class="container mx-auto px-4 py-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 text-white">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="py-2 px-4 text-left">#</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Sent At</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>

                    @php
                    $index_serial = ($invitations->currentPage()-1) * $invitations->perPage()+1;
                    @endphp
                    
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach ($invitations as $invitation)
                        
                        <tr>
                            <td class="py-2 px-4">{{$index_serial++}}</td>
                            <td class="py-2 px-4">{{$invitation->email}}</td>
                            <td class="py-2 px-4">{{$invitation->created_at}}</td>
                            <td class="py-2 px-4">
                                <x-secondary-button wire:click="resend('{{$invitation->email}}')">Resend</x-secondary-button>
                            </td>
                        </tr>

                        @endforeach
                  
                    </tbody>
                </table>
            </div>
        </div>
        
        
    </div>

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
</div>
