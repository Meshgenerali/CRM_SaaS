<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Lead') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                        <div class="container mx-auto px-4 py-12">

                            <div class="text-white">
                                <h2 class="text-3xl font-bold mb-6 text-center">Create Lead</h2>
        
                                @if ($errors->any())
                                    <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
        
                                <form action="{{ route('leads.store') }}" method="POST" class="space-y-6">
                                    @csrf
        
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-lg mb-1">Name</label>
                                        <input type="text" id="name" name="name"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            value="{{ old('name') }}" required>
                                    </div>
        
                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-lg mb-1">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            value="{{ old('email') }}" required >
                                    </div>
        
                                    <!-- Phone -->
                                    <div>
                                        <label for="phone" class="block text-lg mb-1">Phone</label>
                                        <input type="text" id="phone" name="phone"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            value="{{ old('phone') }}">
                                    </div>
        
                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-lg mb-1">Status</label>
                                        <select id="status" name="status"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                            <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New</option>
                                            <option value="contacted" {{ old('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="converted" {{ old('status') == 'converted' ? 'selected' : '' }}>Converted</option>
                                        </select>
                                    </div>
        
                                    <!-- Notes -->
                                    <div>
                                        <label for="message" class="block text-lg mb-1">Message</label>
                                        <textarea id="message" name="message" rows="6"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Enter notes or comments...">{{ old('message') }}</textarea>
                                    </div>
        
                                    <!-- Update Button -->
                                    <div class="text-right">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition ease-in-out duration-300">
                                            Create Lead
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>

            </div>
        </div>
    </div>
</x-app-layout>
