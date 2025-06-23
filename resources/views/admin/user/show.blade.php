@extends('layouts.admin')

@section('title', 'Інформація про користувача')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('admin.users.index') }}"
               class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-800 font-medium text-sm px-4 py-2.5 rounded-lg border border-gray-300 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                          clip-rule="evenodd" />
                </svg>
                Назад до списку
            </a>

            <h2 class="text-2xl font-bold text-gray-800 absolute left-1/2 transform -translate-x-1/2">Інформація про користувача</h2>
        </div>

        <div class="bg-white shadow-xl rounded-lg border border-gray-200 mb-6 p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-800 text-sm">
                <div><strong>ID:</strong> {{ $user->id }}</div>
                <div><strong>Ім’я:</strong> {{ $user->name }}</div>
                <div><strong>Email:</strong> {{ $user->email }}</div>
                <div><strong>Дата реєстрації:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</div>
            </div>
        </div>

        <div class="bg-white shadow-xl rounded-lg border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Історія замовлень</h3>

            @if ($user->orders->isEmpty())
                <p class="text-gray-500">Замовлень не знайдено.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сума</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Статус</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($user->orders as $order)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($order->total_price, 2) }} грн</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
