@extends('layouts.admin')

@section('title', 'Деталі продукту')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.products.index') }}"
           class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-800 font-medium text-sm px-4 py-2.5 rounded-lg border border-gray-300 shadow-sm transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Назад до списку
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-lg p-6 border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @if($product->image)
                <div>
                    <img src="{{ asset('assets/albums/foto/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-full rounded-lg shadow-md object-cover">
                </div>
            @endif

            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->name }}</h2>
                <p class="text-xl text-emerald-700 font-semibold mb-2">{{ $product->price }} грн</p>

                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>Бренд:</strong> {{ $product->brand->name ?? '—' }}</li>
                    <li><strong>Категорія:</strong> {{ $product->category->name ?? '—' }}</li>
                    <li><strong>Країна походження:</strong> {{ $product->country->name ?? '—' }}</li>
                    <li><strong>Вага:</strong> {{ $product->weight->value ?? '—' }}</li>
                    <li><strong>Кислотність:</strong> {{ $product->acidityLevel->name ?? '—' }}</li>
                    <li><strong>Солодкість:</strong> {{ $product->sweetnessLevel->name ?? '—' }}</li>
                    <li><strong>Гіркота:</strong> {{ $product->bitternessLevel->name ?? '—' }}</li>
                    <li><strong>Метод обробки:</strong> {{ $product->processingMethod->name ?? '—' }}</li>
                    <li><strong>Кількість на складі:</strong> {{ $product->stock_quantity }}</li>
                    <li><strong>Створено:</strong> {{ $product->created_at->format('d.m.Y H:i') }}</li>
                    <li><strong>Оновлено:</strong> {{ $product->updated_at->format('d.m.Y H:i') }}</li>
                </ul>

                <p class="text-sm text-gray-600 mb-4">{{ $product->description }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
