@extends('layouts.admin')

@section('title', 'Додати бренд')

@section('content')
<div class="max-w-xl mx-auto py-8">
<h2 class="text-2xl font-bold mb-6 text-gray-800 text-center w-full">Додати бренд</h2>

    <form action="{{ route('admin.brands.store') }}" method="POST" class="space-y-6 bg-white p-6 rounded-lg shadow">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Назва бренду</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
            @error('name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.brands.index') }}" class="text-gray-600 hover:underline mr-4">Скасувати</a>
            <button type="submit"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg shadow">
                Зберегти
            </button>
        </div>
    </form>
</div>
@endsection
