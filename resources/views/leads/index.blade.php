<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container mx-auto px-4 py-12">
                    <!-- Header Section -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                        <h2 class="text-4xl font-bold text-white mb-4 md:mb-0">Leads</h2>

                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('leads.upload') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Upload</span>
                            </a>
                            <a href="{{ route('leads.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM13.707 13.293a1 1 0 010 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 011.414-1.414L9 14.586V7a1 1 0 012 0v7.586l1.293-1.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Export</span>
                            </a>
                            <a href="{{ route('leads.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                <span>Create</span>
                            </a>                           
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if (session()->has('message'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
                            x-show="show" 
                            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                                    bg-green-500 text-white py-3 px-6 rounded-lg shadow-lg text-sm">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Leads Table -->
                    <div class="bg-gray-800 text-white rounded-lg shadow-lg p-8">
                        @forelse($leads as $lead)
                            <div class="mb-6 p-4 bg-gray-700 rounded-lg shadow-md">
                                <div class="flex flex-col md:flex-row justify-between items-center">
                                    <div class="mb-4 md:mb-0">
                                        <h3 class="text-xl font-bold">{{ $lead->name }}</h3>
                                        <p class="text-sm text-gray-400">{{ $lead->email }} | {{ $lead->phone ?? 'No phone number' }}</p>
                                        <p class="text-sm text-gray-400">Status: <span class="font-semibold">{{ ucfirst($lead->status) }}</span></p>
                                        <p class="mt-2 text-gray-300">{{ $lead->message ?? 'No notes' }}</p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-wrap gap-2">
                                        <!-- Assign Lead Button -->
                                        <form action="#" method="POST">
                                            @csrf
                                            <button type="submit" class="text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition duration-300 flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                                </svg>
                                                <span>Assign</span>
                                            </button>
                                        </form>

                                        <!-- Edit Button -->
                                        <a href="{{ route('leads.edit', $lead->id) }}" class="text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300 flex items-center space-x-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400">No leads available. Add a new lead to get started.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $leads->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>