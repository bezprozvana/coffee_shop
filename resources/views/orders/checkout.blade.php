@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Оформлення замовлення</h1>
        
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Товари в кошику -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Ваше замовлення</h2>
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                        <div class="py-4 flex justify-between">
                            <div>
                                <h3 class="font-medium">{{ $item->product->name }}</h3>
                                <p class="text-gray-600 text-sm">{{ $item->quantity }} × {{ number_format($item->product->price, 0, '', ' ') }} грн</p>
                            </div>
                            <div class="font-medium">
                                {{ number_format($item->total_amount, 0, '', ' ') }} грн
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex justify-between font-semibold text-lg">
                            <span>Всього:</span>
                            <span>{{ number_format($subtotal, 0, '', ' ') }} грн</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                        <p class="text-blue-800">Оплата при отриманні товару</p>
                    </div>
                </div>
                
                <!-- Форма доставки -->
                <div>
                    <h2 class="text-xl font-semibold mb-4">Дані доставки</h2>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Метод доставки</label>
                        @foreach($deliveryMethods as $method)
                        <div class="flex items-center mb-2">
                            <input type="radio" id="method_{{ $method->id }}" name="delivery_method_id" 
                                   value="{{ $method->id }}" class="mr-2" required
                                   {{ $loop->first ? 'checked' : '' }}>
                            <label for="method_{{ $method->id }}">{{ $method->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 mb-2">Адреса доставки</label>
                        
                        @if($addresses->count() > 0)
                        <div class="mb-4">
                            <select name="address_id" id="address-select" class="w-full border-gray-300 rounded-md">
                                <option value="">Нова адреса</option>
                                @foreach($addresses as $address)
                                <option value="{{ $address->id }}">
                                    {{ $address->full_name }}, {{ $address->region }}, {{ $address->city }}, {{ $address->address_line }}, {{ $address->postal_code }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        
                        <div id="new-address-fields" class="{{ $addresses->count() > 0 ? 'hidden' : '' }} space-y-4">
                            <div>
                                <label for="full_name" class="block text-gray-700 mb-1">Повне ім'я</label>
                                <input type="text" id="full_name" name="full_name" 
                                       class="w-full border-gray-300 rounded-md" 
                                       value="{{ old('full_name') }}"
                                       {{ $addresses->count() > 0 ? '' : 'required' }}>
                            </div>
                            
                            <div>
                                <label for="region" class="block text-gray-700 mb-1">Область</label>
                                <input type="text" id="region" name="region" 
                                       class="w-full border-gray-300 rounded-md" 
                                       value="{{ old('region') }}"
                                       {{ $addresses->count() > 0 ? '' : 'required' }}>
                            </div>
                            
                            <div>
                                <label for="city" class="block text-gray-700 mb-1">Місто</label>
                                <input type="text" id="city" name="city" 
                                       class="w-full border-gray-300 rounded-md" 
                                       value="{{ old('city') }}"
                                       {{ $addresses->count() > 0 ? '' : 'required' }}>
                            </div>
                            
                            <div>
                                <label for="address_line" class="block text-gray-700 mb-1">Адреса</label>
                                <input type="text" id="address_line" name="address_line" 
                                       class="w-full border-gray-300 rounded-md" 
                                       value="{{ old('address_line') }}"
                                       {{ $addresses->count() > 0 ? '' : 'required' }}>
                            </div>
                            
                            <div>
                                <label for="postal_code" class="block text-gray-700 mb-1">Поштовий індекс</label>
                                <input type="text" id="postal_code" name="postal_code" 
                                       class="w-full border-gray-300 rounded-md" 
                                       value="{{ old('postal_code') }}"
                                       {{ $addresses->count() > 0 ? '' : 'required' }}>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-between gap-3 mt-8">
                        <a href="{{ route('cart.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-center">
                            Повернутися до кошика
                        </a>
                        <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors">
                            Оформити замовлення
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if($addresses->count() > 0)
<script>
    document.getElementById('address-select').addEventListener('change', function() {
        const newAddressFields = document.getElementById('new-address-fields');
        const isNewAddress = this.value === '';
        
        newAddressFields.classList.toggle('hidden', !isNewAddress);
        
        // Додатково можна зробити поля необов'язковими при виборі існуючої адреси
        const requiredInputs = newAddressFields.querySelectorAll('[required]');
        requiredInputs.forEach(input => {
            input.required = isNewAddress;
        });

        // Якщо обрано існуючу адресу - заповнюємо поля
        if (!isNewAddress) {
            const selectedAddress = @json($addresses->keyBy('id'));
            const address = selectedAddress[this.value];
            
            document.getElementById('full_name').value = address.full_name;
            document.getElementById('region').value = address.region;
            document.getElementById('city').value = address.city;
            document.getElementById('address_line').value = address.address_line;
            document.getElementById('postal_code').value = address.postal_code;
        }
    });
</script>
@endif
@endsection