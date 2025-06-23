<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="{{ asset('assets/albums/icons/logo.png') }}" alt="Coffee Shop Logo" class="h-12 transition-transform hover:scale-105">
        </a>

        <div class="w-1/3 mx-4">
            <form action="{{ route('catalog.search') }}" method="GET">
                <div class="relative">
                    <input type="text" name="search" placeholder="Пошук кави..." 
                        class="w-full pl-4 pr-10 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-coffee-500"
                        value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 top-2 text-gray-500 hover:text-coffee-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="flex items-center space-x-6">
            @auth
                <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-coffee-600 transition relative group">
                    <div class="p-1.5 rounded-full group-hover:bg-coffee-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <span class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-coffee-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                        Мій профіль
                    </span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-coffee-600 transition relative group">
                    <div class="p-1.5 rounded-full group-hover:bg-coffee-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <span class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-coffee-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                        Увійти
                    </span>
                </a>
            @endauth
            
            <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-coffee-600 transition relative group">
                <div class="p-1.5 rounded-full group-hover:bg-coffee-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-coffee-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                    Обране
                </span>
            </a>
            
            <a href="{{ route('comparison.index') }}" class="text-gray-700 hover:text-coffee-600 transition relative group">
                <div class="p-1.5 rounded-full group-hover:bg-coffee-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-coffee-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                    Порівняння
                </span>
            </a>
            
            <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-coffee-600 transition relative group">
                <div class="p-1.5 rounded-full group-hover:bg-coffee-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-coffee-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition whitespace-nowrap">
                    Кошик
                </span>
            </a>
        </div>
    </div>
</header>