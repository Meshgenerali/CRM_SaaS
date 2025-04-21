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
                <p class="text-5xl font-bold text-white">KES {{ number_format($business->plan->price, 2) }}</p>
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
                            <span class="text-4xl font-bold text-white">KES {{ $plan->price }}</span>
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

    <x-dialog-modal wire:model="paymentModal">
        <!-- <x-slot name="title">
            Register
        </x-slot> -->
    
        <x-slot name="content">
    
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-6 overflow-hidden relative">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-blue-500/10 rounded-full blur-3xl"></div>
                
                <!-- Modal Content -->
                <div class="relative">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <div class="inline-flex p-3 bg-green-500/10 rounded-full mb-4">
                            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-2">Complete Your Payment</h3>
                        <p class="text-gray-400">Enter your M-Pesa number to receive the payment prompt</p>
                    </div>
                    
                    <!-- Selected Plan Details -->
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 mb-8 border border-gray-700/50">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-400">Selected Plan</p>
                                <h4 class="text-xl font-bold text-white">{{ $business->plan->name }}</h4>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-400">Price</p>
                                <p class="text-2xl font-bold text-white">KES {{ number_format($business->plan->price, 2) }}</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-400">{{ $business->plan->description }}</p>
                    </div>
                    
                    <!-- Payment Form -->
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">M-Pesa Number</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400">+254</span>
                                </div>
                                <input 
                                    wire:model.defer="mpesaNumber" 
                                    type="number" 
                                    class="w-full pl-16 pr-4 py-3 bg-gray-700/50 border border-gray-600/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-white placeholder-gray-400 transition-all duration-300"
                                    placeholder="7XXXXXXXX"
                                    pattern="[0-9]*"
                                    maxlength="9"
                                >
                            </div>
                            @error('mpesaNumber') 
                                <p class="mt-2 text-sm text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex justify-end gap-4 pt-4">
                            <button 
                                wire:click="cancel" 
                                wire:loading.attr="disabled"
                                class="px-6 py-2.5 bg-gray-700/50 hover:bg-gray-700 text-gray-300 hover:text-white rounded-xl font-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500"
                            >
                                Cancel
                            </button>
                            <button 
                                wire:click="stkPush" 
                                wire:loading.attr="disabled"
                                class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-medium transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 flex items-center gap-2"
                            >
                                <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                </svg>
                                <span wire:loading.remove>Receive STK Push</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>    
    
        </x-slot>
    
        {{-- <x-slot name="footer">
            <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                Cancel
            </x-secondary-button>
    
            <x-danger-button class="ml-2" wire:click="sendInvite" wire:loading.attr="disabled">
                Send Invite
            </x-danger-button>
        </x-slot> --}}
    
    </x-dialog-modal>

    <x-loading />

</div>