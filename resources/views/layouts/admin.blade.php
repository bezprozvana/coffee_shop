<!DOCTYPE html>
<html lang="uk" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-100 flex flex-col font-sans antialiased text-gray-800">

    <header class="bg-gray-800 text-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 relative">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>

                <nav class="absolute left-1/2 transform -translate-x-1/2 flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium px-3 py-2 rounded hover:bg-gray-700 transition">Головна</a>
                    <a href="{{ route('admin.products.index') }}" class="text-sm font-medium px-3 py-2 rounded hover:bg-gray-700 transition">Продукти</a>
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-medium px-3 py-2 rounded hover:bg-gray-700 transition">Користувачі</a>
                </nav>

                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center justify-center w-9 h-9 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7" />
                            </svg>
                        </button>
                        <div class="absolute right-0 -bottom-10 bg-gray-800 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition pointer-events-none">
                            Вийти
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-semibold">@yield('page-title')</h2>
                    <p class="text-sm text-gray-500 mt-1">@yield('page-description')</p>
                </div>
                <div>
                    @yield('page-actions')
                </div>
            </div>

            <div class="bg-white border border-gray-200 shadow-sm rounded-lg p-6">
                @yield('content')
            </div>
        </div>
    </main>

</body>
</html>
