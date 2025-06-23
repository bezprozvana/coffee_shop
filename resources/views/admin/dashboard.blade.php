@extends('layouts.admin')

@section('title', 'Панель адміністратора')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Панель адміністратора</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <a href="{{ route('admin.products.index') }}" class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-amber-100 text-amber-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-amber-600 transition-colors">Продукти</h3>
                        </div>
                        <p class="mt-2 text-gray-600">Керування асортиментом кави</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-purple-600 transition-colors">Замовлення</h3>
                        </div>
                        <p class="mt-2 text-gray-600">Перегляд та керування замовленнями</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-rose-100 text-rose-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-rose-600 transition-colors">Користувачі</h3>
                        </div>
                        <p class="mt-2 text-gray-600">Керування користувачами системи</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-green-600 transition-colors">Категорії</h3>
                        </div>
                        <p class="mt-2 text-gray-600">Керування категоріями продуктів</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.brands.index') }}" class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">Бренди</h3>
                        </div>
                        <p class="mt-2 text-gray-600">Керування брендами кави</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection