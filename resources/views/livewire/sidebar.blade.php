
<div 
    x-show="sidebar"
    x-transition:enter="transform transition-transform duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform transition-transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-800 shadow-lg"
>
    <div class="flex flex-col h-full">
        <!-- Sidebar Header -->
        <div class="flex items-center h-16 px-6 bg-gray-800">
            <h1 class="px-9 py-2 text-xl font-semibold text-white bg-gray-800 rounded">
                @livewire('business.select', ['showButton' => true])
            </h1>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="{{route('dashboard')}}" @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                <span class="text-sm font-medium group-hover:text-white">Dashboard</span>
            </svg>
            </a>

            <a href="{{route('leads.index')}}" @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    <span class="text-sm font-medium group-hover:text-white">Leads</span>
                </svg>
            </a>
              
            <!-- Users Menu -->
            <div x-data="{ open: $persist(false).as('user-menu') }">
                <a @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="text-sm font-medium group-hover:text-white">Users</span>
                    <svg class="ml-auto h-5 w-5 transition-transform transform" :class="open ? 'rotate-180' : 'rotate-0'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                
                <!-- Sub-links for Users -->
                <div x-show="open" x-collapse class="ml-6 mt-2 space-y-1">
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 1</a>
                    <a href="#" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-lg">Sublink 2</a>
                </div>
            </div>

            <!-- Settings Menu -->
            <div x-data="{ open: $persist(false).as('settings-menu') }">
                <a @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors group cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm font-medium group-hover:text-white">Settings</span>
                    <svg class="ml-auto h-5 w-5 transition-transform transform" :class="open ? 'rotate-180' : 'rotate-0'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
                
                <!-- Sub-links for Settings -->
                <div x-show="open" x-collapse class="ml-6 mt-2 space-y-1">
                    <a href="{{route('business.roles')}}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('business.roles') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Roles</a>
                    <a href="{{route('business.invites')}}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('business.invites') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Invite Users</a>
                    <a href="{{route('business.subscriptions')}}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('business.subscriptions') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Subscriptions</a>
                </div>
            </div>

            <!-- Other navigation items... -->
        </nav>
    </div>
</div>
