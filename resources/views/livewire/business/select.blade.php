
<div>
    @if ($showButton && auth()->user()->businesses->count()>1)
        <a class="bg-gray-500 pointer-cursor" wire:click="change">{{session('businessName')}}</a>
    @else
    <a class="bg-gray-500 pointer-cursor">{{session('businessName')}}</a>
    @endif
    {{session('businessId')}}
<x-dialog-modal wire:model="showSelection">
    <!-- <x-slot name="title">
        Register
    </x-slot> -->

    <x-slot name="content">
        <h2 class="text-xl font-bold text-center mb-6">Select a Business to Continue</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @if (auth()->check() && auth()->user()->businesses->isNotEmpty())
        @foreach (auth()->user()->businesses as $business)
        <div wire:click="selectBusiness({{ $business->id }})"
            class="cursor-pointer p-4 bg-gray-700 rounded-lg shadow-lg hover:bg-blue-600 transition-all duration-200 transform hover:scale-105">

           <h3 class="text-lg font-bold text-white">{{ $business->name }}</h3>
           <p class="text-gray-400">{{ $business->city }}</p>
           <p class="text-gray-400">{{ $business->email }}</p>
           
           <div class="mt-4">
               <!-- Business Status -->
               <span class="inline-block text-sm {{ $business->expire_at > now() ? 'text-green-500' : 'text-red-500' }}">
                   {{ $business->expire_at > now() ? 'Active' : 'Expired' }}
               </span>
           </div>
       </div>
        @endforeach
        @endif
        </div>
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
