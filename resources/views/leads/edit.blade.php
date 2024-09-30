<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Leads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                        <div class="container mx-auto px-4 py-12">
                            <div class="max-w-lg mx-auto bg-gray-800 text-white p-8 rounded-lg shadow-lg">
                                <h2 class="text-3xl font-bold mb-6">Edit Lead</h2>

                                @if ($errors->any())
                                    <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('leads.update', $lead->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Name -->
                                    <div class="mb-4">
                                        <label for="name" class="block text-lg mb-2">Name</label>
                                        <input type="text" id="name" name="name" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('name', $lead->name) }}" required>
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="block text-lg mb-2">Email</label>
                                        <input type="email" id="email" name="email" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('email', $lead->email) }}" required>
                                    </div>

                                    <!-- Phone -->
                                    <div class="mb-4">
                                        <label for="phone" class="block text-lg mb-2">Phone</label>
                                        <input type="text" id="phone" name="phone" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('phone', $lead->phone) }}">
                                    </div>

                                    <!-- Status -->
                                    <div class="mb-4">
                                        <label for="status" class="block text-lg mb-2">Status</label>
                                        <select id="status" name="status" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                                            <option value="new" {{ old('status', $lead->status) == 'new' ? 'selected' : '' }}>New</option>
                                            <option value="contacted" {{ old('status', $lead->status) == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="converted" {{ old('status', $lead->status) == 'converted' ? 'selected' : '' }}>Converted</option>
                                        </select>
                                    </div>

                                    <!-- Notes -->
                                    <div class="mb-6">
                                        <label for="message" class="block text-lg mb-2">Message</label>
                                        <textarea id="message" name="message" class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4">{{ old('message', $lead->message) }}</textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition duration-300 ease-in-out">
                                        Update Lead
                                    </button>
                                </form>
                            </div>
                        </div>

            </div>
        </div>
    </div>
</x-app-layout>
