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
                        @php
                            $analysis = json_decode($lead->ai_analysis, true);
                        @endphp
                        <div class="p-5 mb-2 bg-gray-800 rounded-lg shadow-md border border-gray-700">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Lead Info -->
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-white">{{ $lead->name }}</h3>
                                    <p class="text-gray-400 text-sm mt-1">{{ $lead->email }} | {{ $lead->phone ?? 'No phone' }}</p>
                                    <div class="mt-2 flex items-center">
                                        <span class="text-sm text-gray-400">Status:</span>
                                        <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-indigo-900 text-indigo-200">{{ ucfirst($lead->status) }}</span>
                                    </div>
                                    <p class="mt-3 text-gray-300 text-sm">{{ $lead->message ?? 'No notes provided' }}</p>
                                    
                                    <!-- AI Insights -->
                                    @if($analysis)
                                    <div class="mt-4 bg-gray-750 p-4 rounded border border-gray-600">
                                        <div class="flex items-center mb-2">
                                            <span class="text-indigo-300 font-medium">Lead Summary</span>
                                        </div>
                                        <p class="text-sm text-gray-300">{{ $analysis['summary'] ?? 'N/A' }}</p>
                                        
                                        <div class="mt-3 flex items-center">
                                            <span class="text-gray-300 text-sm">Priority:</span>
                                            <span class="ml-2 px-2 py-0.5 text-xs rounded {{ ($analysis['priority'] ?? '') === 'High' ? 'bg-red-600 text-white' : (($analysis['priority'] ?? '') === 'Medium' ? 'bg-yellow-500 text-black' : 'bg-green-500 text-black') }}">
                                                {{ $analysis['priority'] ?? 'Unknown' }}
                                            </span>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <p class="text-gray-300 text-sm mb-1">Suggested Response:</p>
                                            <p class="text-xs text-gray-400">Hi {{ $lead->name }}, thanks for your interest in our CRM tools. I'd love to help you explore automation features tailored to your business. Let me know when you're free to chat!</p>
                                        </div>
                                    </div>
                                    @else
                                        <p class="mt-4 text-gray-400 italic">No AI analysis yet. Click "Analyze" to generate one.</p>
                                    @endif
                                </div>
                                
                                <!-- Actions -->
                                <div class="flex flex-col gap-2 w-full md:w-auto md:min-w-32">
                                    <form action="{{ route('lead.analyze') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                        <button type="submit" class="w-full bg-gray-700 hover:bg-gray-600 text-gray-200 px-3 py-2 rounded text-sm transition">
                                            Analyze
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('leads.edit', $lead->id) }}" class="w-full bg-gray-700 hover:bg-gray-600 text-gray-200 px-3 py-2 rounded text-sm transition text-center">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full bg-gray-700 hover:bg-red-700 text-gray-200 px-3 py-2 rounded text-sm transition">
                                            Delete
                                        </button>
                                    </form>

                                    <a href="{{ route('leads.contact', $lead->id) }}" class="w-full bg-gray-700 hover:bg-gray-600 text-gray-200 px-3 py-2 rounded text-sm transition text-center">
                                        Contact
                                    </a>
                                    
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
