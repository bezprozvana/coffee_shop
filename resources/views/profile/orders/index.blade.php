@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Мої замовлення</h1>
        
        @if($orders->isEmpty())
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Замовлень не знайдено</h3>
                <p class="text-gray-600 mb-4">Ви ще не робили жодних замовлень</p>
                <a href="{{ route('catalog') }}" class="inline-block bg-gray-900 text-white px-6 py-2 rounded-md hover:bg-gray-800 transition-colors">
                    Перейти до каталогу
                </a>
            </div>
        @else
            <div class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <div class="py-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
                        <div class="mb-2 md:mb-0">
                            <h3 class="font-semibold text-lg">Замовлення #{{ $order->id }}</h3>
                            <p class="text-gray-600 text-sm">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 rounded-full text-sm 
                                @if($order->status->name === 'Очікує') bg-yellow-100 text-yellow-800
                                @elseif($order->status->name === 'Обробляється') bg-blue-100 text-blue-800
                                @elseif($order->status->name === 'Відправлено') bg-purple-100 text-purple-800
                                @elseif($order->status->name === 'Доставлено') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $order->status->name }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <p class="font-medium">Сума замовлення:</p>
                            <p class="font-bold">{{ number_format($order->total_amount, 0, '', ' ') }} грн</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="font-medium mb-2">Товари:</h4>
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-md mr-3 overflow-hidden">
                                    <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover"
                                         onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                                </div>
                                <div class="flex-grow">
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} × {{ number_format($item->price_at_order_time, 0, '', ' ') }} грн</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <a href="{{ route('orders.show', $order) }}" class="text-gray-900 font-medium hover:text-gray-700 transition-colors">
                            Детальніше →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection