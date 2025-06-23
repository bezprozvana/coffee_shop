@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Замовлення #{{ $order->id }}</h1>
                <p class="text-gray-600 mt-1">Статус: <span class="font-medium">{{ $order->status->name }}</span></p>
                <p class="text-gray-600">Дата: {{ $order->created_at->format('d.m.Y H:i') }}</p>
            </div>
            <a href="{{ route('catalog') }}" class="text-gray-900 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </a>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Товари</h2>
                
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                    <div class="py-4 flex">
                        <div class="w-20 h-20 bg-gray-50 rounded-md overflow-hidden mr-4">
                            <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-full h-full object-contain"
                                 onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-gray-900 font-medium">{{ $item->product->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $item->quantity }} × {{ number_format($item->price_at_order_time, 0, '', ' ') }} грн</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-900">{{ number_format($item->quantity * $item->price_at_order_time, 0, '', ' ') }} грн</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-l border-gray-200 pl-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Деталі замовлення</h2>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="text-gray-700 font-medium">Спосіб доставки</h3>
                        <p class="text-gray-600">Нова Пошта</p>
                    </div>
                    
                    <div>
                        <h3 class="text-gray-700 font-medium">Спосіб оплати</h3>
                        <p class="text-gray-600">Оплата при отриманні</p>
                    </div>
                    
                    <div>
    <h3 class="text-gray-700 font-medium">Адреса доставки</h3>
    <p class="text-gray-600">
        {{ $order->delivery->address->full_name }}, 
        {{ $order->delivery->address->region }}, 
        {{ $order->delivery->address->city }}, 
        {{ $order->delivery->address->address_line }}, 
        {{ $order->delivery->address->postal_code }}
    </p>
</div>
                    
                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Всього товарів:</span>
                            <span class="text-gray-900">{{ $order->items->sum('quantity') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-semibold">
                            <span class="text-gray-900">Сума:</span>
                            <span class="text-gray-900">{{ number_format($order->total_amount, 0, '', ' ') }} грн</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection