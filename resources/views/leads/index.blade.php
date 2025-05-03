<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-2 lg:px-2">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto px-2 py-6">
                
                <!-- Navigation & Action Card -->
                <div class="mb-6 bg-gradient-to-r from-gray-900 to-gray-800 rounded-lg shadow-md">
                    <div class="flex flex-col md:flex-row justify-between items-center p-4">
                        <!-- Left side: Breadcrumb Navigation -->
                        <div class="text-gray-300 flex items-center mb-4 md:mb-0">
                            <a href="{{ route('dashboard') }}" class="hover:text-blue-400 transition">Dashboard</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <a href="{{ route('leads.index') }}" class="hover:text-blue-400 transition">Leads</a>
                            @if(request()->routeIs('leads.converted'))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span class="text-blue-400">Converted</span>
                            @endif
                        </div>
                        
                        <!-- Right side: Action Buttons -->
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('leads.upload') }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                Upload
                            </a>
                            <a href="{{ route('leads.export') }}" class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM13.707 13.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L9 14.586V7a1 1 0 012 0v7.586l1.293-1.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Export
                            </a>
                            <a href="{{ route('leads.create') }}" class="bg-green-600 text-white px-3 py-2 rounded-lg hover:bg-green-700 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Create
                            </a>                           
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session()->has('message'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
                        x-show="show" 
                        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                                bg-green-500 text-white py-3 px-6 rounded-lg shadow-lg text-sm z-50">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Leads kanban board -->
                @livewire('kanban.board')
            </div>
        </div>
    </div>
</x-app-layout>