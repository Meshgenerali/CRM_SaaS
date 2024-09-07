<x-guest-layout>
<section class="py-4">
  <div class="container mx-auto px-6 md:px-12 lg:px-24">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg p-8 md:p-12">
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4">Get in Touch</h1>
        <p class="text-lg text-gray-300">Feel free to reach out to us with any questions, concerns, or feedback. We're here to help!</p>
      </div>
      
      <div class="flex flex-col md:flex-row md:space-x-12">
        <!-- Contact Information -->
        <div class="md:w-1/2 mb-8 md:mb-0">
          <h2 class="text-2xl font-bold mb-6">Contact Information</h2>
          
          <div class="mb-6">
            <p class="text-lg text-gray-400 mb-2">Email</p>
            <p class="text-lg">support@yourcrm.com</p>
          </div>
          
          <div class="mb-6">
            <p class="text-lg text-gray-400 mb-2">Phone</p>
            <p class="text-lg">+1 (123) 456-7890</p>
          </div>
          
          <div class="mb-6">
            <p class="text-lg text-gray-400 mb-2">Office Address</p>
            <p class="text-lg">123 SaaS Street, Suite 456<br>Your City, Your Country</p>
          </div>
        </div>
        
        <!-- Contact Form -->
        <div class="md:w-1/2">
          <h2 class="text-2xl font-bold mb-6">Send Us a Message</h2>
          
          <form action="#" method="POST">
            <div class="mb-6">
              <label for="name" class="block text-lg text-gray-300 mb-2">Your Name</label>
              <input type="text" id="name" name="name" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="John Doe">
            </div>
            
            <div class="mb-6">
              <label for="email" class="block text-lg text-gray-300 mb-2">Your Email</label>
              <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="johndoe@example.com">
            </div>
            
            <div class="mb-6">
              <label for="message" class="block text-lg text-gray-300 mb-2">Your Message</label>
              <textarea id="message" name="message" class="w-full px-4 py-3 bg-gray-700 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4" placeholder="Write your message here..."></textarea>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition duration-300 ease-in-out">
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</x-guest-layout>