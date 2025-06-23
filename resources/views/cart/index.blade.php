@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Кошик</h1>
        
        @if($cartItems->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($cartItems as $item)
            <div class="py-6 flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/5 lg:w-1/6">
                    <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-full h-40 object-contain bg-gray-50 rounded-lg p-2"
                         onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                </div>
                <div class="w-full md:w-4/5 lg:w-5/6 flex flex-col md:flex-row gap-6">
                    <div class="flex-grow">
                        <h3 class="font-semibold text-lg text-gray-900">{{ $item->product->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $item->product->country->name }}</p>
                        <p class="text-gray-600 text-sm">{{ $item->product->weight->name }}</p>
                        <p class="text-gray-900 font-bold mt-2">{{ number_format($item->product->price, 0, '', ' ') }} грн</p>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <form action="{{ route('cart.decrement', $item) }}" method="POST" class="h-full">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-lg hover:bg-gray-50 h-full transition-colors">
                                    &minus;
                                </button>
                            </form>
                            <span class="px-3 text-gray-900">{{ $item->quantity }}</span>
                            <form action="{{ route('cart.increment', $item) }}" method="POST" class="h-full">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-lg hover:bg-gray-50 h-full transition-colors">
                                    &plus;
                                </button>
                            </form>
                        </div>
                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-gray-700 transition-colors mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-900 font-bold">{{ number_format($item->total_amount, 0, '', ' ') }} грн</p>
                        @if($item->quantity > $item->product->stock_quantity)
                        <p class="text-red-500 text-xs mt-1">На складі лише {{ $item->product->stock_quantity }} шт.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 border-t border-gray-200 pt-6">
            <div class="flex justify-between items-center mb-3">
                <span class="text-gray-600">Всього товарів:</span>
                <span class="font-semibold text-gray-900">{{ $totalItems }}</span>
            </div>
            <div class="flex justify-between items-center mb-6">
                <span class="text-gray-600">Сума:</span>
                <span class="font-semibold text-gray-900 text-xl">{{ number_format($subtotal, 0, '', ' ') }} грн</span>
            </div>
                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full sm:w-auto px-4 py-2.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                        Очистити кошик
                    </button>
                </form>
                <a href="{{ route('cart.checkout') }}" class="w-full sm:w-auto px-6 py-2.5 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors text-center">
                    Оформити замовлення
                </a>
            </div>
        </div>
        @else
        <div class="text-center py-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Кошик порожній</h3>
            <p class="text-gray-600 mb-4">Додайте товари до кошика, щоб продовжити покупки</p>
            <a href="{{ route('catalog') }}" class="inline-block bg-gray-900 text-white px-6 py-2 rounded-md hover:bg-gray-800 transition-colors">
                Перейти до каталогу
            </a>
        </div>
        @endif
    </div>
</div>
@endsection