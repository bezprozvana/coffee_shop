@extends('layouts.app')

@section('title', $product->name . ' - Coffee Shop')

@section('content')
<div class="container mx-auto px-4 py-8">і
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li>
                <a href="{{ route('home') }}" class="hover:text-coffee-600 transition-colors">Головна</a>
            </li>
            <li>/</li>
            <li>
                <a href="{{ route('catalog') }}" class="hover:text-coffee-600 transition-colors">Каталог</a>
            </li>
            <li>/</li>
            <li>
                <a href="{{ route('catalog.category', $product->category) }}" class="hover:text-coffee-600 transition-colors">{{ $product->category->name }}</a>
            </li>
            <li>/</li>
            <li class="text-coffee-900 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8">
        <div class="lg:w-1/2">
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 flex items-center justify-center h-full">
                <div class="relative h-80 w-full overflow-hidden rounded-lg">
                    <img src="{{ asset('assets/albums/foto/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="absolute inset-0 w-full h-full object-contain transition duration-300 hover:scale-105"
                         onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                </div>
            </div>
        </div>
        
        <div class="lg:w-1/2">
            <div class="sticky top-4">
                <div class="flex justify-between items-start">
                    <h1 class="text-3xl font-light text-coffee-900 mb-4">{{ $product->name }}</h1>
                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="text-coffee-400 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 @if(auth()->user() && auth()->user()->wishlist->contains('product_id', $product->id)) !text-red-500 @endif" 
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="flex items-center mb-6">
                    <span class="text-coffee-900 font-medium text-2xl">{{ number_format($product->price, 0, '', ' ') }} грн</span>
                    <span class="ml-3 text-sm px-2 py-1 rounded-full {{ $product->stock_quantity > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->stock_quantity > 0 ? 'В наявності' : 'Немає в наявності' }}
                    </span>
                </div>
                
                @if($product->stock_quantity > 0)
                <div class="mb-8">
                    <div class="flex flex-col sm:flex-row gap-4 items-center mb-4">
                        <div class="flex items-center border border-coffee-300 rounded-lg overflow-hidden bg-white">
                            <button type="button" class="px-3 py-2 bg-coffee-50 text-coffee-700 hover:bg-coffee-100 transition" onclick="decrementQuantity()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input type="number" 
                                name="quantity" 
                                id="quantity-input"
                                value="1" 
                                min="1" 
                                max="{{ $product->stock_quantity }}"
                                class="w-16 text-center border-0 focus:ring-0 text-coffee-900">
                            <button type="button" class="px-3 py-2 bg-coffee-50 text-coffee-700 hover:bg-coffee-100 transition" onclick="incrementQuantity()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-1 w-full">
                            @csrf
                            <input type="hidden" name="quantity" id="quantity-hidden" value="1">
                            <button type="submit" 
                                    class="w-full bg-coffee-600 hover:bg-coffee-700 text-white px-6 py-3 rounded-lg transition flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Додати до кошика
                            </button>
                        </form>
                    </div>
                    
                    <form action="{{ route('comparison.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 text-coffee-700 border border-coffee-300 px-6 py-3 rounded-lg hover:bg-coffee-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Порівняти
                        </button>
                    </form>
                </div>
                @else
                <div class="mb-8 bg-gray-100 text-gray-800 p-4 rounded-lg text-center border border-gray-200">
                    Товар тимчасово відсутній
                </div>
                @endif

                <div class="mb-8 grid grid-cols-2 gap-3">
                    <div class="border border-gray-200 p-3 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-xs uppercase tracking-wider">Бренд</p>
                        <p class="font-medium text-coffee-800">{{ $product->brand->name }}</p>
                    </div>
                    <div class="border border-gray-200 p-3 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-xs uppercase tracking-wider">Країна</p>
                        <p class="font-medium text-coffee-800">{{ $product->country->name }}</p>
                    </div>
                    <div class="border border-gray-200 p-3 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-xs uppercase tracking-wider">Вага</p>
                        <p class="font-medium text-coffee-800">{{ $product->weight->name }}</p>
                    </div>
                    <div class="border border-gray-200 p-3 rounded-lg bg-gray-50">
                        <p class="text-gray-500 text-xs uppercase tracking-wider">Категорія</p>
                        <p class="font-medium text-coffee-800">{{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-4 mt-8">

        @if($product->flavorProfiles->count())
        <div class="md:w-1/2 bg-white rounded-lg shadow-md p-6 border border-gray-100">
            <h3 class="font-light text-coffee-900 text-lg mb-3">Профіль смаку</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($product->flavorProfiles as $profile)
                <span class="bg-coffee-50 text-coffee-800 text-xs px-3 py-1 rounded-full border border-coffee-200">
                    {{ $profile->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
        
        @if($product->brewingMethods->count())
        <div class="md:w-1/2 bg-white rounded-lg shadow-md p-6 border border-gray-100">
            <h3 class="font-light text-coffee-900 text-lg mb-3">Методи заварювання</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($product->brewingMethods as $method)
                <span class="bg-coffee-50 text-coffee-800 text-xs px-3 py-1 rounded-full border border-coffee-200">
                    {{ $method->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-100 mt-4 mb-8">
        <h3 class="font-light text-coffee-900 text-lg mb-3">Опис</h3>
        <p class="text-coffee-700 whitespace-pre-line leading-relaxed">{{ $product->description }}</p>
    </div>
</div>

<script>
    function updateHiddenQuantity() {
        document.getElementById('quantity-hidden').value = document.getElementById('quantity-input').value;
    }

    function incrementQuantity() {
        const input = document.getElementById('quantity-input');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
            updateHiddenQuantity();
        }
    }

    function decrementQuantity() {
        const input = document.getElementById('quantity-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            updateHiddenQuantity();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const productId = formData.get('product_id');
                const heartIcon = this.querySelector('svg');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        if (data.inWishlist) {
                            heartIcon.classList.add('!text-red-500');
                            heartIcon.classList.remove('text-coffee-400');
                        } else {
                            heartIcon.classList.remove('!text-red-500');
                            heartIcon.classList.add('text-coffee-400');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>
@endsection