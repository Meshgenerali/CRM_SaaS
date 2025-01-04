<div class="bg-gray-800 rounded-lg border border-gray-700 shadow-xl p-6 hover:bg-gray-700 transition-all duration-300">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-400">Active Subscription</p>
            <p class="text-2xl font-semibold text-white mt-2">
                Name: {{ $business->plan->name }} <br> Price: USD {{$business->plan->price}}
            </p>
            <p class="text-xs text-green-400 mt-2">
                Expire Date: 
                <span class="flex items-center mt-2 mb-2">
                    {{$business->expire_at}}
                </span>
            </p>
        </div>
        <div class="p-3 bg-gray-900/50 rounded-full">
            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
        </div>
    </div>

    <section class="bg-gray-900 py-8 rounded-lg">
        <h2 class="text-4xl font-bold text-white text-center mb-8">Choose Your Plan</h2>
    <div class="flex flex-col md:flex-row justify-center gap-8">
        
        @foreach ($plans as $plan)
        @if($business->plan->id != $plan->id)
        
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <h3 class="text-2xl font-bold mb-4">{{$plan->name}}</h3>
                <p class="text-gray-400 mb-6">{{$plan->description}}</p>
                <p class="text-4xl font-bold mb-4">$ {{$plan->price}}<span class="text-lg text-gray-400">/month</span></p>
                <!-- <ul class="text-gray-400 mb-6">
                    <li class="mb-2">✔ 5 Projects</li>
                    <li class="mb-2">✔ 10 Users</li>
                    <li class="mb-2">✔ Email Support</li>
                </ul> -->
                <a wire:click="selectPlan('{{$plan->id}}')" class="inline-block bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition">Choose Plan</a>
        </div>
        @endif
        @endforeach

        </div>
    </section>

</div>

