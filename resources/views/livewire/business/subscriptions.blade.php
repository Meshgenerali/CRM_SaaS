<div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-purple-600/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-600/10 rounded-full blur-3xl"></div>
    
    <!-- Active Plan Section -->
    <div class="relative">
        <div class="flex flex-col md:flex-row items-center justify-between gap-8 mb-12">
            <div class="flex-1">
                <p class="text-sm font-medium text-purple-400 mb-2">Current Subscription</p>
                <h2 class="text-3xl font-bold text-white mb-1">{{ $business->plan->name }}</h2>
                <p class="text-5xl font-bold text-white">${{ number_format($business->plan->price, 2) }}</p>
                <p class="text-gray-400 text-sm mt-1">per month</p>
                
                <!-- Trial Information Card -->
                <div class="mt-6 bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-gray-700/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">Trial Period Active</p>
                            <p class="text-xs text-gray-400">Expires on {{ \Carbon\Carbon::parse($business->expire_at)->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="h-2 flex-1 bg-gray-700 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500" style="width: 70%"></div>
                        </div>
                        <p class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($business->expire_at)->diffForHumans(now(), [
                            'parts' => 2,
                            'short' => true,
                            'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE
                         ]) }} left</p>
                    </div>
                </div>
            </div>
            
            <!-- Action Area -->
            <div class="flex flex-col items-center gap-4">
                <div class="p-6 bg-gradient-to-br from-purple-500/20 to-blue-500/20 rounded-full backdrop-blur-sm">
                    <svg class="w-12 h-12 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <button
                    wire:click="subscribeNow"
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40 transform hover:-translate-y-0.5"
                >
                    Subscribe Now
                </button>
            </div>
        </div>
        
        <!-- Available Plans Section -->
        <div class="relative bg-gradient-to-br from-gray-800/50 to-gray-900/50 p-8 rounded-2xl backdrop-blur-sm border border-gray-700/30">
            <h2 class="text-3xl font-bold text-white text-center mb-2">Change Plan</h2>
            <p class="text-gray-400 text-center mb-10">Select a plan that best fits your needs</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($plans as $plan)
                @if($business->plan->id != $plan->id)
                <div class="group relative bg-gray-800/50 p-6 rounded-xl border border-gray-700/30 hover:border-blue-500/30 transition-all duration-300 overflow-hidden">
                    <!-- Hover Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 to-purple-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <div class="relative">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $plan->name }}</h3>
                        <p class="text-sm text-gray-400 mb-4 min-h-[40px]">{{ $plan->description }}</p>
                        
                        <div class="mb-6">
                            <span class="text-4xl font-bold text-white">${{ $plan->price }}</span>
                            <span class="text-gray-400 ml-1">/month</span>
                        </div>
                        
                        <button 
                            wire:click="selectPlan('{{ $plan->id }}')"
                            class="w-full py-3 px-4 rounded-xl font-medium bg-gray-700/50 hover:bg-blue-600 text-gray-200 hover:text-white border border-gray-600/50 hover:border-blue-500 transition-all duration-300 transform hover:scale-[1.02]"
                        >
                            Select Plan
                        </button>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>