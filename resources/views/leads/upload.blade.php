<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Leads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto px-4 py-12">
    <div class="max-w-lg mx-auto bg-gray-800 text-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6">Import Leads CVS Files</h2>
        
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <a href="{{ asset('samples/Leads.csv') }}" target="_blank" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                Download Sample CSV File
            </a>

            <div class="mb-4 mt-4">
                <x-label for="file" value="{{ __('File') }}" />
                <x-input id="file" class="block mt-1 w-full" type="file" name="file" :value="old('file')" required autofocus autocomplete="name" />
            </div>
            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-bold hover:bg-blue-700 transition duration-300 ease-in-out">
                Add Lead
            </button>
        </form>
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
