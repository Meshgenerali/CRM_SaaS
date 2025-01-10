   <!-- notifications Dropdown -->
   <div class="ms-3 relative">
    <x-dropdown align="right" width="72">
        <x-slot name="trigger">
            
                <span class="inline-flex rounded-md">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                      

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <span class="text-red-700">{{auth()->user()->unreadNotifications()->count()}}</span>
                                                                                
                    </button>
                </span>
           
        </x-slot>

        <x-slot name="content">
            <!-- Notification Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Notifications') }}
            </div>
            @foreach (auth()->user()->unreadNotifications as $notification)
            <div @if(!$notification->read_at) class="bg-blue-700" @endif>
            <x-dropdown-link class="flex justify-between" wire:click="read('{{$notification->id}}')">
               <span> {{ $notification->data['message'] }}</span>
               <span> {{ $notification->created_at->diffForHumans() }}</span>
            </x-dropdown-link>
            </div>
            @endforeach

            <div class="border-t border-gray-200 dark:border-gray-600"></div>

            <x-dropdown-link href="{{route('notifications')}}">
                {{ __('See All') }}
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>