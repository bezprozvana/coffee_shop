@extends('layouts.app')

@section('title', 'Мої адреси')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Заголовок -->
            <div class="bg-gray-800 px-6 py-5 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">Мої адреси</h1>
                    <a href="{{ route('profile.index') }}" class="text-gray-300 hover:text-white transition">
                        Назад до профілю
                    </a>
                </div>
            </div>
            
            <!-- Основний вміст -->
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Список адрес -->
                    <div class="lg:col-span-2 space-y-6">
                        @if($addresses->isEmpty())
                            <div class="bg-gray-50 p-6 rounded-lg shadow text-center">
                                <p class="text-gray-600">У вас ще немає збережених адрес</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($addresses as $address)
                                <div class="bg-gray-50 p-6 rounded-lg shadow relative group">
                                    @if($address->is_default)
                                        <span class="absolute top-4 right-4 bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            За замовчуванням
                                        </span>
                                    @endif
                                    
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-gray-900">{{ $address->full_name }}</h3>
                                            <p class="text-gray-600">{{ $address->address_line }}</p>
                                            <p class="text-gray-600">{{ $address->postal_code }}, {{ $address->city }}, {{ $address->region }}</p>
                                        </div>
                                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition">
                                            <a href="{{ route('profile.addresses.edit', $address) }}" 
                                               class="text-gray-500 hover:text-amber-600 transition"
                                               title="Редагувати">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('profile.addresses.destroy', $address) }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю адресу?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-500 hover:text-red-600 transition" title="Видалити">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <!-- Форма додавання/редагування адреси -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                            {{ isset($editAddress) ? 'Редагувати адресу' : 'Додати нову адресу' }}
                        </h2>
                        
                        @if(isset($editAddress))
                            <x-profile.address-form 
                                :address="$editAddress" 
                                method="PUT" 
                                action="{{ route('profile.addresses.update', $editAddress) }}" />
                        @else
                            <x-profile.address-form 
                                method="POST" 
                                action="{{ route('profile.addresses.store') }}" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection