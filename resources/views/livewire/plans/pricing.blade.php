<section class="bg-gray-900 py-8 rounded-lg">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-white mb-8">Choose Your Plan</h2>
        <div class="flex flex-col md:flex-row justify-center gap-8">

        @foreach ($plans as $plan)
        
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

        @endforeach
 


        </div>
    </div>
</section>