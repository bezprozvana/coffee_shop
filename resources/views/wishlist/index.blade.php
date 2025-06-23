@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-coffee-900">Список бажаного</h1>
            <span class="bg-coffee-100 text-coffee-800 px-3 py-1 rounded-full text-sm">
                {{ $wishlistItems->count() }} {{ trans_choice('товар|товари|товарів', $wishlistItems->count()) }}
            </span>
        </div>
        
        @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
            <div class="group relative bg-white rounded-lg border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="absolute top-2 right-2 z-10">
                    <span class="{{ $item->product->stock_quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs px-2 py-1 rounded-full">
                        {{ $item->product->stock_quantity > 0 ? 'В наявності' : 'Немає' }}
                    </span>
                </div>
                
                <form action="{{ route('wishlist.remove', $item->product) }}" method="POST" class="absolute top-2 left-2 z-10">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 bg-white rounded-full shadow-md text-gray-400 hover:text-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>

                <a href="{{ route('catalog.show', $item->product) }}" class="block">
                    <div class="h-48 bg-gray-50 overflow-hidden relative">
                        <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                             alt="{{ $item->product->name }}" 
                             class="w-full h-full object-contain transition duration-300 group-hover:scale-105"
                             onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                    </div>
                    
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 mb-1 truncate">{{ $item->product->name }}</h3>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">{{ $item->product->country->name }}</span>
                            <span class="text-sm text-gray-500">{{ $item->product->weight->name }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-3">
                            <span class="font-bold text-coffee-900">{{ number_format($item->product->price, 0, '', ' ') }} грн</span>
                            @if($item->product->stock_quantity > 0)
                            <form action="{{ route('cart.add', $item->product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="text-white bg-coffee-600 hover:bg-coffee-700 px-3 py-1 rounded text-sm flex items-center gap-1 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Купити
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-coffee-50 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-coffee-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Ваш список бажаного порожній</h3>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">Тут з'являться товари, які ви додасте за допомогою кнопки "У список бажаного"</p>
            <a href="{{ route('catalog') }}" class="inline-flex items-center px-5 py-2.5 bg-coffee-600 hover:bg-coffee-700 text-white rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Перейти до покупок
            </a>
        </div>
        @endif
    </div>
</div>
@endsection