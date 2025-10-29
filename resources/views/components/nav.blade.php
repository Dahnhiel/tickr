<nav class="bg-white shadow-sm px-6 py-4 fixed top-0 left-0 right-0 z-50">
    <div class="flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Hamburger Menu Button -->
            @auth
                <button id="hamburger-menu" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="hamburger-icon">
                        <span class="block w-6 h-0.5 bg-gray-600 mb-1 transition-all duration-300"></span>
                        <span class="block w-6 h-0.5 bg-gray-600 mb-1 transition-all duration-300"></span>
                        <span class="block w-6 h-0.5 bg-gray-600 transition-all duration-300"></span>
                    </div>
                </button>
            @endauth

            <!-- Logo/Brand -->
            <a href="/" class="flex items-center space-x-2">
                <span class="text-2xl font-bold">
                    <x-logo />
                </span>
            </a>

            <!-- Search Bar (Desktop Only) -->
            @auth
                <div class="hidden lg:block">
                    <div class="relative">
                        <input
                            type="text"
                            placeholder="Search your task here..."
                            class="w-80 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"
                        >
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-400 text-white p-1.5 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Right side - User actions and date -->
        <div class="flex items-center space-x-4">
            @auth
                <!-- Search Button (Mobile Only) -->
                <button class="lg:hidden p-2 text-gray-400 hover:text-gray-600" id="mobile-search-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <button class="p-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-7a5 5 0 0110 0v7z"></path>
                    </svg>
                </button>

                <button class="hidden sm:block p-2 text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </button>

                <div class="hidden sm:block text-right">
                    <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::now()->format('l') }}</div>
                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600 font-medium">
                    Login
                </a>

                <a href="{{ route('register') }}" class="text-sm text-gray-700 hover:text-blue-600 font-medium">
                    Register
                </a>
            @endguest
        </div>
    </div>

    <!-- Mobile Search Bar (Hidden by default) -->
    @auth
        <div id="mobile-search" class="lg:hidden mt-4 hidden">
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search your task here..."
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"
                >
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-400 text-white p-1.5 rounded">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endauth
</nav>

<style>
.hamburger-icon.active span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.hamburger-icon.active span:nth-child(2) {
    opacity: 0;
}

.hamburger-icon.active span:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -6px);
}
</style>
