<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                
                @can('test')
                <p class="text-gray-200">test</p>
                @endcan

                @can('test2')
                <p class="text-gray-200">test2</p>
                @endcan

                @can('test3')
                <p class="text-gray-200">test3</p>
                @endcan

                @can('test4')
                <p class="text-gray-200">test4</p>
                @endcan

                @livewire('business.invite')

            </div>
        </div>
    </div>
</x-app-layout>
