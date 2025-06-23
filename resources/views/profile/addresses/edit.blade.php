@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Редагувати адресу</h1>
        
        <form action="{{ route('profile.addresses.update', $address) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="full_name" class="block text-gray-700 mb-1">Повне ім'я</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $address->full_name) }}" 
                           class="w-full border-gray-300 rounded-md" required>
                </div>
                
                <div>
                    <label for="region" class="block text-gray-700 mb-1">Область</label>
                    <input type="text" id="region" name="region" value="{{ old('region', $address->region) }}" 
                           class="w-full border-gray-300 rounded-md" required>
                </div>
                
                <div>
                    <label for="city" class="block text-gray-700 mb-1">Місто</label>
                    <input type="text" id="city" name="city" value="{{ old('city', $address->city) }}" 
                           class="w-full border-gray-300 rounded-md" required>
                </div>
                
                <div>
                    <label for="address_line" class="block text-gray-700 mb-1">Адреса</label>
                    <input type="text" id="address_line" name="address_line" value="{{ old('address_line', $address->address_line) }}" 
                           class="w-full border-gray-300 rounded-md" required>
                </div>
                
                <div>
                    <label for="postal_code" class="block text-gray-700 mb-1">Поштовий індекс</label>
                    <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code', $address->postal_code) }}" 
                           class="w-full border-gray-300 rounded-md" required>
                </div>
                
                <div class="flex items-center">
                    <input type="checkbox" id="is_default" name="is_default" value="1" 
                           {{ $address->is_default ? 'checked' : '' }}
                           class="mr-2 border-gray-300 rounded text-gray-700">
                    <label for="is_default">Зробити основною адресою</label>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8">
                <a href="{{ route('profile.addresses') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                    Назад
                </a>
                <button type="submit" class="px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors">
                    Оновити адресу
                </button>
            </div>
        </form>
    </div>
</div>
@endsection