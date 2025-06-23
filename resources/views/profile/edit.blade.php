@extends('layouts.app')

@section('title', 'Редагування профілю')

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-800 px-6 py-5 border-b border-gray-700">
                <h1 class="text-2xl font-bold text-white">Редагування профілю</h1>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Ім'я</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-600 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-600 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Телефон</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-600 focus:ring focus:ring-amber-200 focus:ring-opacity-50">
                            @error('phone_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('profile.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Скасувати
                            </a>
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-800 hover:bg-amber-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                Зберегти зміни
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection