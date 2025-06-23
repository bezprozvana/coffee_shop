@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Мої адреси</h1>
            <a href="{{ route('profile.addresses.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors">
                Додати адресу
            </a>
        </div>

        @if($addresses->isEmpty())
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Адрес не знайдено</h3>
                <p class="text-gray-600 mb-4">Додайте свою першу адресу доставки</p>
                <a href="{{ route('profile.addresses.create') }}" class="inline-block bg-gray-900 text-white px-6 py-2 rounded-md hover:bg-gray-800 transition-colors">
                    Додати адресу
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($addresses as $address)
                <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="font-semibold text-lg">{{ $address->full_name }}</h3>
                        @if($address->is_default)
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Основна</span>
                        @endif
                    </div>
                    
                    <div class="space-y-2 text-gray-700">
                        <p><span class="font-medium">Область:</span> {{ $address->region }}</p>
                        <p><span class="font-medium">Місто:</span> {{ $address->city }}</p>
                        <p><span class="font-medium">Адреса:</span> {{ $address->address_line }}</p>
                        <p><span class="font-medium">Поштовий індекс:</span> {{ $address->postal_code }}</p>
                    </div>
                    
                    <div class="flex gap-2 mt-6">
                        <a href="{{ route('profile.addresses.edit', $address) }}" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm">
                            Редагувати
                        </a>
                        <form action="{{ route('profile.addresses.destroy', $address) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm">
                                Видалити
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection