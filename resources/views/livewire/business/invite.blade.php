
<div>

    <x-button wire:click="invite">Invite User</x-button>

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
