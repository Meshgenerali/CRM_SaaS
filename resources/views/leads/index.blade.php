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
                        <div class="mb-6 p-4 bg-gray-800 rounded-lg shadow-md border border-gray-700">
                            <div class="flex flex-col md:flex-row justify-between gap-4">
                                <!-- Lead Info -->
                                <div class="w-full md:w-3/4">
                                    <h3 class="text-2xl font-bold text-white">{{ $lead->name }}</h3>
                                    <p class="text-sm text-gray-400">{{ $lead->email }} | {{ $lead->phone ?? 'No phone number' }}</p>
                                    <p class="text-sm text-gray-400 mt-1">Status: <span class="font-semibold text-indigo-400">{{ ucfirst($lead->status) }}</span></p>
                                    <p class="mt-2 text-gray-300">{{ $lead->message ?? 'No notes provided' }}</p>
                
                                    <!-- AI Insights -->
                                    <div class="mt-6 bg-gray-700 p-4 rounded-lg border border-gray-600">
                                        <p class="text-sm font-semibold text-gray-200 mb-1">📌 <span class="text-indigo-300">Lead Summary</span></p>
                                        <p class="text-sm text-gray-300 italic">This lead is interested in CRM automation tools. High engagement expected based on previous communication.</p>
                
                                        <p class="text-sm font-semibold text-gray-200 mt-4">🚦 Estimated Priority:</p>
                                        <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full bg-green-600 text-white">High</span>
                
                                        <p class="text-sm font-semibold text-gray-200 mt-4">✉️ Suggested Follow-up Email:</p>
                                        <p class="text-sm text-gray-300 mt-1">Hi {{ $lead->name }}, thanks for your interest in our CRM tools. I’d love to help you explore automation features tailored to your business. Let me know when you’re free to chat!</p>
                                    </div>
                                </div>
                
                                <!-- Actions -->
                                <div class="flex flex-col gap-3 w-full md:w-1/4">
                                    <!-- AI Analyze -->
                                    <form action="{{ route('lead.analyze') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                            🔍 AI Analyze
                                        </button>
                                    </form>
                
                                    <!-- Edit -->
                                    <a href="{{ route('leads.edit', $lead->id) }}" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium transition text-center">
                                        ✏️ Edit
                                    </a>
                
                                    <!-- Delete -->
                                    <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                                            🗑️ Delete
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
