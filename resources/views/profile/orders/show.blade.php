@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Замовлення #{{ $order->id }}</h1>
            <span class="px-3 py-1 rounded-full text-sm mt-2 md:mt-0
                @if($order->status->name === 'Очікує') bg-yellow-100 text-yellow-800
                @elseif($order->status->name === 'Обробляється') bg-blue-100 text-blue-800
                @elseif($order->status->name === 'Відправлено') bg-purple-100 text-purple-800
                @elseif($order->status->name === 'Доставлено') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                {{ $order->status->name }}
            </span>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h2 class="text-xl font-semibold mb-4">Деталі замовлення</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Дата:</span> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    <p><span class="font-medium">Сума:</span> {{ number_format($order->total_amount, 0, '', ' ') }} грн</p>
                    <p><span class="font-medium">Метод доставки:</span> {{ $order->delivery->method->name ?? 'Не вказано' }}</p>
                    <p><span class="font-medium">Статус оплати:</span> При отриманні</p>
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold mb-4">Адреса доставки</h2>
                @if($order->delivery->address)
                <div class="space-y-2">
                    <p>{{ $order->delivery->address->full_name }}</p>
                    <p>{{ $order->delivery->address->region }}, {{ $order->delivery->address->city }}</p>
                    <p>{{ $order->delivery->address->address_line }}</p>
                    <p>{{ $order->delivery->address->postal_code }}</p>
                </div>
                @else
                <p class="text-gray-600">Адреса не вказана</p>
                @endif
            </div>
        </div>
        
        <h2 class="text-xl font-semibold mb-4">Товари</h2>
        <div class="divide-y divide-gray-200">
            @foreach($order->items as $item)
            <div class="py-4 flex">
                <div class="w-16 h-16 bg-gray-100 rounded-md mr-4 overflow-hidden">
                    <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                         alt="{{ $item->product->name }}" 
                         class="w-full h-full object-cover"
                         onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium">{{ $item->product->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $item->quantity }} × {{ number_format($item->price_at_order_time, 0, '', ' ') }} грн</p>
                </div>
                <div class="text-right">
                    <p class="font-bold">{{ number_format($item->quantity * $item->price_at_order_time, 0, '', ' ') }} грн</p>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end">
            <div class="text-right">
                <p class="text-lg font-bold">{{ number_format($order->total_amount, 0, '', ' ') }} грн</p>
            </div>
        </div>
        
        <div class="mt-8">
            <a href="{{ route('profile.orders') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                Повернутися до списку замовлень
            </a>
        </div>
    </div>
</div>
@endsection