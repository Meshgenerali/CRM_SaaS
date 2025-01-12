<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-6">
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" 
            x-show="show" 
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 
                   bg-green-500 text-white py-3 px-6 rounded-lg shadow-lg text-sm">
           {{ session('message') }}
       </div>
       @endif
        @livewire('kanban.board')
    </div>
</x-app-layout>
