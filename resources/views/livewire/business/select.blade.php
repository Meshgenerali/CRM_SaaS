
<div>
    @if ($showButton && auth()->user()->businesses->count()>1)

        <button 
            wire:click="change"
            class="flex items-center gap-2 px-3 py-2 bg-gray-800 hover:bg-gray-700 rounded-md transition-all duration-200 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <span class="text-white truncate max-w-[150px]">{{ session('businessName') }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    @else
    <div class="flex items-center px-3 py-2 bg-gray-800 rounded-md border border-gray-700">
    <span class="text-white truncate max-w-[150px]">{{ session('businessName') }}</span>
    </div>
    @endif
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
