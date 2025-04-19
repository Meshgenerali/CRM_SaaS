<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Lead') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                        <div class="container mx-auto px-4 py-12">

                            <div class="text-white">
                                <h2 class="text-3xl font-bold mb-6 text-center">Contact Lead</h2>
            
                                @if ($errors->any())
                                    <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @php
                                    $analysis = json_decode($lead->ai_analysis, true);
                                    $followUp = '';

                                    if (isset($analysis['follow_up'])) {
                                        // If follow_up is a nested array, extract "body" key if present
                                        if (is_array($analysis['follow_up']) && isset($analysis['follow_up']['body'])) {
                                            $followUp = $analysis['follow_up']['body'];
                                        } elseif (is_string($analysis['follow_up'])) {
                                            $followUp = $analysis['follow_up'];
                                        }
                                    }

                                    // Replace \n with real line breaks for display
                                    $followUpFormatted = str_replace('\n', "\n", $followUp);
                                @endphp
            
                                <form action="{{ route('leads.sendemail', $lead->id) }}" method="POST" class="space-y-6">
                                    @csrf
                                                
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-lg mb-1">Name</label>
                                        <input type="text" id="name" name="name" readonly
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none cursor-not-allowed"
                                            value="{{ old('name', $lead->name) }}" required>
                                    </div>
            
                                    <!-- Email (Readonly) -->
                                    <div>
                                        <label for="email" class="block text-lg mb-1">Email</label>
                                        <input type="email" id="email" name="email" readonly
                                            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none cursor-not-allowed"
                                            value="{{ old('email', $lead->email) }}">
                                    </div>
            
                                    <!-- Phone (Readonly) -->
                                    <div>
                                        <label for="phone" class="block text-lg mb-1">Phone</label>
                                        <input type="text" id="phone" name="phone" readonly
                                            class="w-full px-4 py-2 bg-gray-700 text-gray-300 rounded-lg focus:outline-none cursor-not-allowed"
                                            value="{{ old('phone', $lead->phone) }}">
                                    </div>
            
                                    <!-- Email Body -->
                                    <div>
                                        <label for="message" class="block text-lg mb-1">Email Body</label>
                                        <textarea id="message" name="message" rows="6"
                                            class="w-full px-4 py-2 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="Write your message to the lead here...">{{ old('message', $followUpFormatted) }}</textarea>
                                    </div>
            
                                    <!-- Send Button -->
                                    <div class="text-right">
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition ease-in-out duration-300">
                                            Send Email
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>

            </div>
        </div>
    </div>
</x-app-layout>
