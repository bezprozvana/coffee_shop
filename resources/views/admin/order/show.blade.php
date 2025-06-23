@extends('layouts.admin')

@section('title', 'Замовлення #'.$order->id)

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.orders.index') }}"
               class="inline-flex items-center text-sm text-gray-700 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                          clip-rule="evenodd"/>
                </svg>
                Назад до списку
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Замовлення #{{ $order->id }}</h2>
        </div>

        <div class="bg-white shadow-xl border border-gray-200 rounded-lg p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Інформація про замовлення</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-600 text-sm">Статус:</span>
                            <p class="text-lg font-medium {{ $order->status->id == 1 ? 'text-yellow-600' : ($order->status->id == 2 ? 'text-blue-600' : ($order->status->id == 3 ? 'text-green-600' : ($order->status->id == 4 ? 'text-purple-600' : 'text-red-600'))) }}">
                                {{ $order->status->name }}
                            </p>
                        </div>
                        <div>
                            <span class="text-gray-600 text-sm">Користувач:</span>
                            <p class="text-lg">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 text-sm">Сума замовлення:</span>
                            <p class="text-lg font-bold">{{ number_format($order->total_amount, 2) }} грн</p>
                        </div>
                        <div>
                            <span class="text-gray-600 text-sm">Метод доставки:</span>
                            <p class="text-lg">{{ $order->delivery->method->name ?? 'Не вказано' }}</p>
                        </div>
                        <div>
    <span class="text-gray-600 text-sm">Адреса доставки:</span>
    @if($order->delivery && $order->delivery->address)
        <p class="text-lg">
            {{ $order->delivery->address->full_name }}, 
            {{ $order->delivery->address->region }}, 
            {{ $order->delivery->address->city }}, 
            {{ $order->delivery->address->address_line }}, 
            {{ $order->delivery->address->postal_code }}
        </p>
    @else
        <p class="text-lg">Не вказано</p>
    @endif
</div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Дата та час</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-600 text-sm">Створено:</span>
                            <p class="text-lg">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 text-sm">Оновлено:</span>
                            <p class="text-lg">{{ $order->updated_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Товари у замовленні</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Фото</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Товар</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ціна</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Кількість</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Сума</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('assets/albums/foto/' . $item->product->image) }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="h-16 w-16 object-cover rounded"
                                        onerror="this.onerror=null; this.src='{{ asset('images/no-image.png') }}'">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($item->price_at_order_time, 2) }} грн</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->quantity }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ number_format($item->price_at_order_time * $item->quantity, 2) }} грн</div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection