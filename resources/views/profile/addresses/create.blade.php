@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Додати нову адресу</h1>

        <form action="{{ route('profile.addresses.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">ПІБ</label>
                <input type="text" id="full_name" name="full_name" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <div>
                <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Область</label>
                <input type="text" id="region" name="region" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Місто</label>
                <input type="text" id="city" name="city" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <div>
                <label for="address_line" class="block text-sm font-medium text-gray-700 mb-1">Адреса</label>
                <input type="text" id="address_line" name="address_line" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Поштовий індекс</label>
                <input type="text" id="postal_code" name="postal_code" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors">
                    Зберегти
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
