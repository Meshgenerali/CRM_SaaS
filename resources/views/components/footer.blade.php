<footer class="bg-gray-900 text-gray-300">
    <div class="container mx-auto px-4 py-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Brand -->
            <div>
                <h3 class="text-2xl font-bold text-white mb-3">SaaSCRM</h3>
                <p class="text-sm text-gray-400">Powering smarter customer management with AI and automation.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-yellow-400 transition">Dashboard</a></li>
                    <li><a href="{{ route('leads.index') }}" class="hover:text-yellow-400 transition">Leads</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Reports</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Settings</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-yellow-400 transition">Help Center</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-yellow-400 transition">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Subscribe</h4>
                <form class="space-y-2">
                    <input type="email" placeholder="Your email" class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-gray-900 px-3 py-2 rounded font-semibold transition">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-10 border-t border-gray-700 pt-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-500">
            <p>© {{ now()->year }} SaaSCRM. All rights reserved.</p>
            <div class="flex space-x-4 mt-2 sm:mt-0">
                <a href="#" class="hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-yellow-400"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </div>
</footer>
