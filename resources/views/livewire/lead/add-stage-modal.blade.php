<x-dialog-modal wire:model="showModal">

    <x-slot name="content">
        {{-- create new stage UI elements --}}

        <div class="space-y-6 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            <!-- Stage Name -->
            <div>
                <x-label for="stageName" value="Stage Name" class="text-sm font-medium" />
                <x-input id="stageName" type="text" wire:model.defer="stageName" 
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                    placeholder="e.g., New Lead, Qualified, Proposal, Negotiation" />
                <x-input-error for="stageName" class="mt-1" />
            </div>

            <!-- Stage Color -->
            <div>
                <x-label for="stageColor" value="Stage Color" class="text-sm font-medium" />
                <div class="mt-1 grid grid-cols-7 gap-2">
                    @foreach(['#4f46e5', '#10b981', '#ef4444', '#f59e0b', '#8b5cf6', '#ec4899', '#3b82f6'] as $color)
                        <button type="button" 
                            wire:click="$set('stageColor', '{{ $color }}')" 
                            class="h-8 w-8 rounded-full focus:outline-none focus:ring-2 ring-offset-2 ring-offset-gray-800 ring-white transition-transform hover:scale-110 {{ $stageColor === $color ? 'ring-2 scale-110' : '' }}"
                            style="background-color: {{ $color }}">
                        </button>
                    @endforeach
                </div>
                <div class="mt-3 flex items-center">
                    <x-label for="customColor" value="Custom:" class="text-sm font-medium mr-2" />
                    <input type="color" id="customColor" wire:model="stageColor" 
                        class="h-8 w-8 rounded overflow-hidden cursor-pointer" />
                    <span class="ml-2 text-sm">{{ $stageColor }}</span>
                </div>
                <x-input-error for="stageColor" class="mt-1" />
            </div>

            <!-- Stage Order -->
            <div>
                <x-label for="stageOrder" value="Display Order" class="text-sm font-medium" />
                <x-input id="stageOrder" type="number" wire:model.defer="stageOrder" min="1" 
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Determines the position in your pipeline (lower numbers appear first)
                </p>
            </div>
        </div>
            <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
    
            <x-danger-button class="ml-2" wire:click="addStage" wire:loading.attr="disabled">
                Save
            </x-danger-button>
        
    </x-slot>

</x-dialog>