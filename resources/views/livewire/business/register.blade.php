<x-dialog-modal wire:model="showForm">
    <!-- <x-slot name="title">
        Register
    </x-slot> -->

    <x-slot name="content">
    
    <div x-data="{ step: 1, selectedPlan: null }" class="bg-gray-800 flex items-center justify-center py-10">
    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <!-- Step Indicator -->
        <div class="flex justify-between mb-6">
            <div :class="step >= 1 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">1</div>
            <div :class="step >= 2 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">2</div>
            <div :class="step >= 3 ? 'bg-blue-600' : 'bg-gray-500'" class="w-8 h-8 rounded-full text-center font-bold leading-8">3</div>
        </div>


        <div x-show="step === 1">
            <h2 class="text-2xl font-bold mb-4">Select a Plan</h2>
            <div class="space-y-4">

                @foreach ($plans as $plan)
                <!-- Dynamic Plan Selection: Change `selectedPlan` based on the clicked plan's ID -->
                <div :class="selectedPlan === {{ $plan->id }} ? 'border-blue-500' : 'border-gray-700'" class="border p-4 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-2">{{$plan->name}}</h3>
                    <p class="text-gray-400 mb-4">{{$plan->description}}</p>
                    <p class="text-2xl font-bold mb-2">${{$plan->price}}<span class="text-sm text-gray-400">/month</span></p>
                    <!-- Button dynamically sets `selectedPlan` to the current plan's ID -->
                    <button @click="selectedPlan = {{ $plan->id }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition w-full">Select</button>
                </div>
                @endforeach

            </div>

            <!-- Next Button -->
            <button @click="step++" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition w-full mt-6" :disabled="!selectedPlan">Next</button>
        </div>


        <div x-show="step === 2">
            <h2 class="text-2xl font-bold mb-4">Business Registration</h2>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Business Name</label>
                <input type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Business Email</label>
                <input type="email" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Business Phone Number</label>
                <input type="tel" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business phone number">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Business Address</label>
                <input type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your business address">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">City</label>
                <input type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="City">
            </div>
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Industry</label>
                <select class="w-full px-4 py-2 bg-gray-700 text-gray-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="" disabled selected>Select your industry</option>
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
            </div>
            <div class="flex justify-between">
                <button @click="step--" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">Back</button>
                <button @click="step++" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Next</button>
            </div>
        </div>


        <div x-show="step === 3">
            <h2 class="text-2xl font-bold mb-4">User Information</h2>
            
            <!-- First Name -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">First Name</label>
                <input type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your first name">
            </div>

            <!-- Last Name -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Last Name</label>
                <input type="text" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your last name">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Email</label>
                <input type="email" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter your email">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Password</label>
                <input type="password" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Create a password">
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label class="block text-gray-400 mb-2">Confirm Password</label>
                <input type="password" class="w-full px-4 py-2 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Confirm your password">
            </div>

            <!-- Step Navigation -->
            <div class="flex justify-between">
                <button @click="step--" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">Back</button>
                <button @click="step++" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">Submit</button>
            </div>
        </div>

    </div>
</div>



    </x-slot>

</x-dialog-modal>