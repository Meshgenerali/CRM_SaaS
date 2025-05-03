<div class="py-4">
  <div class="max-w-7xl mx-auto">
    <!-- Modern CRM Header with Search and Controls -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-5">
      <!-- Search Bar -->
      <div class="relative w-full md:w-96">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input 
          type="search" 
          class="block w-full py-2 pl-10 pr-3 text-sm bg-gray-800 border border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-200 placeholder-gray-400" 
          placeholder="Search leads by name, email or company..." 
          wire:model.debounce.300ms="search"
        >
      </div>
      
      <!-- Controls -->
      <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center space-x-4 bg-gray-800 p-2 rounded-lg">
          <div class="flex items-center">
            <span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>
            <span class="text-sm text-gray-300">High</span>
          </div>
          <div class="flex items-center">
            <span class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></span>
            <span class="text-sm text-gray-300">Medium</span>
          </div>
          <div class="flex items-center">
            <span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>
            <span class="text-sm text-gray-300">Low</span>
          </div>
        </div>
        
        <!-- Filter Dropdown -->
        <div class="relative">
          <button class="flex items-center bg-gray-800 text-gray-200 px-3 py-2 rounded-lg hover:bg-gray-700 transition">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span>Filter</span>
          </button>
        </div>
        
        <!-- Add Stage Button -->
        <button 
          wire:click="openAddStageModal" 
          class="flex items-center bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition"
        >
          <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          <span>Add Stage</span>
        </button>
      </div>
    </div>

    <!-- Kanban Board Container -->
    <div class="bg-gradient-to-b from-gray-700 to-gray-900 p-4 rounded-xl shadow-xl">
      <!-- Column Wrapper -->
      <div wire:sortable="updateLeadOrder" wire:sortable-group="updateLeadStatus" class="flex gap-4 overflow-x-auto pb-2 min-h-[500px]">
        @foreach ($statuses as $status)
          <div wire:key="group-{{ $status }}" class="flex-shrink-0 w-80">
            <!-- Column Header with Status Name and Add Icon -->
            <div class="bg-gray-800 rounded-t-lg p-3 border-b border-gray-600">
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <h2 class="text-lg font-semibold text-gray-200 capitalize">
                    {{ $status }}
                  </h2>
                  <span class="ml-2 text-xs text-gray-400 bg-gray-700 px-2 py-1 rounded-full">
                    {{ count($data[$status] ?? []) }}
                  </span>
                </div>
                <div class="flex items-center">
                  <button 
                    wire:click="openLeadOptionsModal('{{ $status }}')"
                    class="text-gray-400 hover:text-gray-200 p-1 rounded-full transition-colors duration-200 mr-1"
                    title="Column options"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                  </button>
                  <button 
                    wire:click="openAddLeadModal('{{ $status }}')"
                    class="text-gray-400 hover:text-blue-400 hover:bg-gray-700 p-1 rounded-full transition-colors duration-200"
                    title="Add lead to {{ $status }}"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
            
            <!-- Column Content -->
            <div class="bg-gray-800 rounded-b-lg p-3 shadow-md min-h-[400px]">
              <div wire:sortable-group.item-group="{{ $status }}" class="space-y-3">
                @forelse ($data[$status] ?? [] as $lead)
                  @php
                  $analysis = json_decode($lead->ai_analysis, true) ?: [];
                  $priority = $analysis['priority'] ?? $lead->priority ?? 'low';
                  @endphp
                  <div 
                    wire:key="task-{{ $lead->id }}" 
                    wire:sortable-group.item="{{ $lead->id }}" 
                    class="bg-gray-700 p-3 rounded-lg shadow hover:shadow-lg transform hover:scale-[1.02] transition-all duration-200 cursor-pointer border-l-4 {{ $priority === 'High' ? 'border-red-500' : ($priority === 'Medium' ? 'border-yellow-500' : 'border-green-500') }}"
                  >
                    <span wire:sortable-group.handle>
                      <div class="flex items-center justify-between">
                        <h3 class="font-medium text-gray-200 truncate max-w-[180px]">{{ $lead->name }}</h3>
                        <span class="flex items-center px-2 py-1 rounded-full {{ $priority === 'High' ? 'bg-red-900/30 text-red-400' : ($priority === 'Medium' ? 'bg-yellow-900/30 text-yellow-400' : 'bg-green-900/30 text-green-400') }}">
                          <span class="w-2 h-2 rounded-full {{ $priority === 'High' ? 'bg-red-500' : ($priority === 'Medium' ? 'bg-yellow-500' : 'bg-green-500') }} mr-1"></span>
                          <span class="text-xs font-medium">
                            {{ ucfirst($priority) }}
                          </span>
                        </span>
                      </div>
                      
                      <!-- Company & Email -->
                      @if(!empty($lead->company) || !empty($lead->email))
                        <div class="mt-2">
                          @if(!empty($lead->company))
                            <div class="flex items-center text-xs text-gray-400">
                              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                              </svg>
                              <span class="truncate max-w-[180px]">{{ $lead->company }}</span>
                            </div>
                          @endif
                          
                          @if(!empty($lead->email))
                            <div class="flex items-center text-xs text-gray-400 mt-1">
                              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                              </svg>
                              <span class="truncate max-w-[180px]">{{ $lead->email }}</span>
                            </div>
                          @endif
                        </div>
                      @endif
                      
                      <div class="flex items-center justify-between mt-2">
                        <span class="bg-blue-900/30 text-blue-400 px-2 py-1 rounded-full text-xs">{{ $lead->status }}</span>
                        <div class="flex items-center">
                          @if(!empty($lead->value))
                            <span class="text-xs font-medium text-green-400 mr-2">
                              ${{ number_format($lead->value) }}
                            </span>
                          @endif
                          <span class="text-xs text-gray-400">{{ $lead->created_at->diffForHumans() }}</span>
                        </div>
                      </div>
                      
                      <p class="text-sm text-gray-400 mt-2 line-clamp-2">{{ $lead->message }}</p>
                      
                      <!-- Quick Actions -->
                      <div class="flex justify-end mt-2 pt-2 border-t border-gray-600">
                        <button title="Email" class="text-gray-400 hover:text-blue-400 p-1">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                          </svg>
                        </button>
                        <button title="Edit" class="text-gray-400 hover:text-yellow-400 p-1 ml-1">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                          </svg>
                        </button>
                      </div>
                    </span>
                  </div>
                @empty
                  <div class="bg-gray-700/50 rounded-lg p-6 text-center flex flex-col items-center justify-center h-40">
                    <svg class="h-10 w-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="text-gray-400 text-sm mt-3">No leads in this stage</p>
                    <button 
                      wire:click="openAddLeadModal('{{ $status }}')"
                      class="mt-3 text-blue-400 hover:text-blue-300 text-sm flex items-center"
                    >
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      </svg>
                      Add your first lead
                    </button>
                  </div>
                @endforelse
              </div>
            </div>
          </div>
        @endforeach
        
        <!-- Add New Stage Column -->
        <div class="flex-shrink-0 w-64 flex items-center justify-center">
          <button 
            wire:click="openAddStageModal"
            class="bg-gray-800 hover:bg-gray-700 text-gray-400 hover:text-gray-200 rounded-lg p-4 flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-700 transition-colors duration-200"
          >
            <svg class="w-8 h-8 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>Add New Stage</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  
@livewire('lead.add-stage-modal')
</div>