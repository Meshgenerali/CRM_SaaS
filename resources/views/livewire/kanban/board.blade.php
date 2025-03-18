<div>
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-200">Leads Kanban Board</h1>
        </div>
    
        <!-- Kanban Board -->
        <div wire:sortable="updateLeadOrder" wire:sortable-group="updateLeadStatus" class="flex gap-6 overflow-x-auto pb-4">
            @foreach ($statuses as $status)
                <div wire:key="group-{{ $status }}" class="flex-shrink-0 w-80">
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4 text-gray-200 capitalize">{{ $status }}</h2>
    
                        <div wire:sortable-group.item-group="{{ $status }}" class="space-y-3">
                            @forelse ($data[$status] as $lead)
                                <div wire:key="task-{{ $lead->id }}" wire:sortable-group.item="{{ $lead->id }}" class="bg-gray-700 p-4 rounded-lg shadow cursor-pointer hover:bg-gray-600">
                                    <span wire:sortable-group.handle><h3 class="font-medium mb-2 text-gray-200">{{ $lead->name }}</h3>
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-sm">{{ $lead->status }}</span>
                                        <span class="text-sm text-gray-400">{{ $lead->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-400 mt-2">{{ $lead->message }}</p>
                                </span>
                                </div>
                            @empty
                                <p class="text-gray-400 text-sm">No leads available.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
</div>
