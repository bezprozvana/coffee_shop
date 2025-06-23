@extends('layouts.admin')

@section('title', 'Редагувати замовлення #'.$order->id)

@section('content')
    <div class="max-w-xl mx-auto px-4 py-8">
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
            <h2 class="text-2xl font-bold text-gray-800">Редагувати замовлення #{{ $order->id }}</h2>
        </div>

        <div class="bg-white shadow-xl rounded-lg p-6 border border-gray-200">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="order_status_id" class="block text-sm font-medium text-gray-700 mb-1">Статус замовлення</label>
                    <select name="order_status_id" id="order_status_id" class="w-full border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 rounded-lg shadow-sm text-sm px-4 py-2 transition">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" {{ $order->order_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('order_status_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg shadow-md transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 10a1 1 0 011-1h3V6a1 1 0 112 0v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 01-1-1z"/>
                        </svg>
                        Оновити статус
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection