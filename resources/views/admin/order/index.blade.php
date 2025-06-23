@extends('layouts.admin')

@section('title', 'Список замовлень')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-800 font-medium text-sm px-4 py-2.5 rounded-lg border border-gray-300 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                          clip-rule="evenodd"/>
                </svg>
                Назад
            </a>

            <h2 class="text-2xl font-bold text-gray-800">Список замовлень</h2>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Користувач</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Сума</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Статус</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Дата створення</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Дії</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">#{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($order->total_amount, 2) }} грн</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $order->status->id == 1 ? 'bg-yellow-100 text-yellow-800' : ($order->status->id == 2 ? 'bg-blue-100 text-blue-800' : ($order->status->id == 3 ? 'bg-green-100 text-green-800' : ($order->status->id == 4 ? 'bg-purple-100 text-purple-800' : 'bg-red-100 text-red-800'))) }}">
                                    {{ $order->status->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="text-blue-600 hover:text-blue-800 transition" title="Переглянути">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 3a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 12a5 5 0 110-10 5 5 0 010 10z"/>
                                            <path d="M10 7a3 3 0 100 6 3 3 0 000-6z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                       class="text-yellow-600 hover:text-yellow-800 transition" title="Редагувати">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-1.414 1.414-2.828-2.828L13.586 3.586zM11.172 6l-8.49 8.49A1 1 0 002 16v2h2a1 1 0 00.707-.293l8.49-8.49-2.025-2.025z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Видалити замовлення?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800 transition" title="Видалити">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-.894.553L4.382 4H2a1 1 0 100 2h1v10a2 2 0 002 2h8a2 2 0 002-2V6h1a1 1 0 100-2h-2.382l-.724-1.447A1 1 0 0014 2H6zm2 6a1 1 0 112 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection