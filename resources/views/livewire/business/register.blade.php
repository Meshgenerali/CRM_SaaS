<div>
<x-dialog-modal wire:model="showForm">
    <!-- <x-slot name="title">
        Register
    </x-slot> -->

    <x-slot name="content">
    
    <div x-data="{ step: $wire.entangle('currentStep') }" class="bg-gray-800 flex items-center justify-center py-10">
            <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg w-full max-w-lg">
                <!-- Step Indicator -->
                <div class="flex justify-between mb-6">
                    <div :class="step >= 1 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">1</div>
                    <div :class="step >= 2 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">2</div>
                    <div :class="step >= 3 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">3</div>
                </div>

                <!-- Step 1: Plan Selection -->
                <div x-show="step === 1">
                    <h2 class="text-2xl font-bold mb-4">Select a Plan</h2>
                    <div class="space-y-4">
                        @foreach ($plans as $plan)
                            <div :class="$wire.planSelected === {{ $plan->id }} ? 'border-blue-500' : 'border-gray-700'" class="border p-4 rounded-lg shadow-lg">
                                <h3 class="text-xl font-bold mb-2">{{ $plan->name }}</h3>
                                <p class="text-gray-400 mb-4">{{ $plan->description }}</p>
                                <p class="text-2xl font-bold mb-2">${{ $plan->price }}<span class="text-sm text-gray-400">/month</span></p>
                                <button wire:click="selectPlan({{ $plan->id }})" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition w-full">Select</button>
                            </div>
                        @endforeach
                    </div>
                    <br>
                    <button wire:click="nextStep" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Next</button>
                </div>

                <!-- Step 2: Business Registration -->
                <div x-show="step === 2">
                    <h2 class="text-2xl font-bold mb-4">Business Registration</h2>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Business Name</label>
                        <input wire:model.defer="businessName" type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business name">
                        @error('businessName') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Business Email</label>
                        <input wire:model.defer="businessEmail" type="email" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business email">
                        @error('businessEmail') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Business Phone Number</label>
                        <input wire:model.defer="businessPhone" type="tel" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business phone number">
                        @error('businessPhone') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Business Address</label>
                        <input wire:model.defer="businessAddress" type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business address">
                        @error('businessAddress') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">City</label>
                        <input wire:model.defer="businessCity" type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="City">
                        @error('businessCity') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Industry</label>
                        <select wire:model.defer="businessIndustry" class="w-full px-4 py-2 bg-gray-700 text-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="">Select your industry</option>
                            <option value="technology">Technology</option>
                            <option value="finance">Finance</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="education">Education</option>
                            <option value="retail">Retail</option>
                            <option value="manufacturing">Manufacturing</option>
                            <option value="hospitality">Hospitality</option>
                            <option value="real_estate">Real Estate</option>
                            <option value="other">Other</option>
                        </select>
                        @error('businessIndustry') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-between">
                    <button @click="$wire.previousStep()" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">Back</button>
                    <button @click="$wire.nextStep()" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Next</button>
                    </div>
                </div>

                <!-- Step 3: User Information -->
                <div x-show="step === 3">
                    <h2 class="text-2xl font-bold mb-4">User Information</h2>
                    <x-honeypot livewire-model="extraFields" />
                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Full Name</label>
                        <input wire:model.defer="firstName" type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your full name">
                        @error('firstName') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Email</label>
                        <input wire:model.defer="email" type="email" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your email">
                        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Password</label>
                        <input wire:model.defer="password" type="password" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Create a password">
                        @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-400 mb-2">Confirm Password</label>
                        <input wire:model.defer="passwordConfirmation" type="password" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Confirm your password">
                    </div>

                    <!-- Step Navigation -->
                    <div class="flex justify-between">
                        <button @click="step--" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">Back</button>
                        <button wire:click="submitRegistration" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">Submit</button>
                    </div>
                </div>
            </div>
        </div>


    </x-slot>

</x-dialog-modal>

    <div wire:loading class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-gray-800 text-white p-4 rounded-lg shadow-lg border border-gray-700 flex items-center space-x-3">
            <!-- Loading spinner -->
            <svg class="animate-spin h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Rendering your page...</span>
        </div>
    </div>

</div>