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
    <!-- Add Lead Button -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-bold text-white">Leads</h2>
        <a href="{{ route('leads.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
            Add New Lead
        </a>
    </div>

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
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold">{{ $lead->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $lead->email }} | {{ $lead->phone ?? 'No phone number' }}</p>
                        <p class="text-sm text-gray-400">Status: <span class="font-semibold">{{ ucfirst($lead->status) }}</span></p>
                        <p class="mt-2 text-gray-300">{{ $lead->message ?? 'No notes' }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4">
                        <a href="{{ route('leads.edit', $lead->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lead?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 ease-in-out">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-400">No leads available. Add a new lead to get started.</p>
        @endforelse
    </div>
    
    <!-- Pagination (if needed) -->
    <div class="mt-6">
        {{ $leads->links() }}
    </div>
</div>

            </div>
        </div>
    </div>
</x-app-layout>
