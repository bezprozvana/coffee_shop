@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Бокова панель фільтрів -->
        <aside class="w-full md:w-1/4 lg:w-1/5">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4 border border-gray-200">
                <h2 class="text-xl font-bold mb-6 text-gray-900 border-b pb-3">Фільтри</h2>
                
<form id="filter-form" method="GET" action="{{ route('catalog') }}">
    <div class="mb-8">
        <h3 class="font-semibold mb-4 text-gray-900 text-sm uppercase tracking-wider">Ціна, грн</h3>
        <div class="flex items-center justify-between mb-4">
            <input type="number" id="min-price-input" name="min_price" 
                   value="{{ $filters['currentMinPrice'] }}"
                   class="border border-gray-300 rounded-md px-3 py-1.5 bg-gray-50 w-24 text-sm">
            <div class="w-4 h-px bg-gray-300 mx-2"></div>
            <input type="number" id="max-price-input" name="max_price" 
                   value="{{ $filters['currentMaxPrice'] }}"
                   class="border border-gray-300 rounded-md px-3 py-1.5 bg-gray-50 w-24 text-sm">
        </div>
        
        <div class="relative h-10">
            <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 rounded-full transform -translate-y-1/2"></div>
            <div id="price-range" class="absolute top-1/2 left-0 right-0 h-1 bg-gray-900 rounded-full transform -translate-y-1/2"></div>
            
            <input type="range" 
                   min="{{ $filters['minPrice'] }}" 
                   max="{{ $filters['maxPrice'] }}" 
                   value="{{ $filters['currentMinPrice'] }}" 
                   id="min-price" 
                   class="absolute w-full top-1/2 h-1 appearance-none pointer-events-none transform -translate-y-1/2 bg-transparent z-20"
                   step="10">
                   
            <input type="range" 
                   min="{{ $filters['minPrice'] }}" 
                   max="{{ $filters['maxPrice'] }}" 
                   value="{{ $filters['currentMaxPrice'] }}" 
                   id="max-price" 
                   class="absolute w-full top-1/2 h-1 appearance-none pointer-events-none transform -translate-y-1/2 bg-transparent z-20"
                   step="10">
        </div>
    </div>

                    @if($filters['categories']->count())
                    <div class="mb-8">
                        <h3 class="font-semibold mb-3 text-gray-900 text-sm uppercase tracking-wider">Категорії</h3>
                        <div class="space-y-3 max-h-60 overflow-y-auto thin-scrollbar pr-2">
                            @foreach($filters['categories'] as $category)
                            <div class="flex items-center">
                                <input type="checkbox" id="category-{{ $category->id }}" name="category[]" 
                                       value="{{ $category->id }}" 
                                       @if(in_array($category->id, (array)request('category'))) checked @endif
                                       class="rounded border-gray-300 text-gray-900 focus:ring-gray-500 h-4 w-4">
                                <label for="category-{{ $category->id }}" class="ml-3 text-gray-700 text-sm">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($filters['countries']->count())
                    <div class="mb-8">
                        <h3 class="font-semibold mb-3 text-gray-900 text-sm uppercase tracking-wider">Країна</h3>
                        <div class="space-y-3 max-h-60 overflow-y-auto thin-scrollbar pr-2">
                            @foreach($filters['countries'] as $country)
                            <div class="flex items-center">
                                <input type="checkbox" id="country-{{ $country->id }}" name="country[]" 
                                       value="{{ $country->id }}" 
                                       @if(in_array($country->id, (array)request('country'))) checked @endif
                                       class="rounded border-gray-300 text-gray-900 focus:ring-gray-500 h-4 w-4">
                                <label for="country-{{ $country->id }}" class="ml-3 text-gray-700 text-sm">
                                    {{ $country->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($filters['brands']->count())
                    <div class="mb-8">
                        <h3 class="font-semibold mb-3 text-gray-900 text-sm uppercase tracking-wider">Бренди</h3>
                        <div class="space-y-3 max-h-60 overflow-y-auto thin-scrollbar pr-2">
                            @foreach($filters['brands'] as $brand)
                            <div class="flex items-center">
                                <input type="checkbox" id="brand-{{ $brand->id }}" name="brand[]" 
                                       value="{{ $brand->id }}" 
                                       @if(in_array($brand->id, (array)request('brand'))) checked @endif
                                       class="rounded border-gray-300 text-gray-900 focus:ring-gray-500 h-4 w-4">
                                <label for="brand-{{ $brand->id }}" class="ml-3 text-gray-700 text-sm">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white py-2.5 px-4 rounded-md transition text-sm font-medium">
                            Застосувати фільтри
                        </button>
                        @if(count($filters['selectedFilters']) > 0)
                        <a href="{{ route('catalog') }}" class="block w-full text-center text-gray-500 hover:text-gray-900 text-xs py-2 transition">
                            Скинути всі фільтри
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </aside>

        <main class="w-full md:w-3/4 lg:w-4/5">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h1 class="text-2xl font-bold text-gray-900">
                        @isset($filters['currentCategory'])
                            {{ $filters['currentCategory']->name }}
                        @else
                            Весь каталог
                        @endisset
                        <span class="text-gray-500 text-lg font-normal">({{ $products->total() }})</span>
                    </h1>
                    
                    
                </div>
            </div>

            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition border border-gray-200 group relative">

                    <div class="absolute top-2 right-2 z-10 flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">

                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="p-1.5 bg-white rounded-full shadow-md hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ auth()->user() && auth()->user()->wishlist->contains('product_id', $product->id) ? 'text-red-500 fill-red-500' : 'text-gray-400' }}" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </form>
                        
                        <form action="{{ route('comparison.add', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-1.5 bg-white rounded-full shadow-md hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <a href="{{ route('catalog.show', $product) }}" class="block">
                        <div class="h-48 bg-gray-50 overflow-hidden relative">
                            <img src="{{ asset('assets/albums/foto/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-contain transition duration-300 group-hover:scale-105"
                                 onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-medium text-gray-900 mb-1 line-clamp-2" title="{{ $product->name }}">{{ $product->name }}</h3>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-gray-500">{{ $product->country->name }}</span>
                                <span class="text-sm text-gray-500">{{ $product->weight->name }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-3">
                                <span class="font-bold text-gray-900">{{ number_format($product->price, 0, '', ' ') }} грн</span>
                                @if($product->stock_quantity > 0)
                                <button onclick="addToCart({{ $product->id }}, 1, this)" 
                                        class="text-white bg-gray-900 hover:bg-gray-800 px-3 py-1 rounded-md text-sm flex items-center gap-1 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Купити
                                </button>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
                {{ $products->links() }}
            </div>
            @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Товарів не знайдено</h3>
                <p class="text-gray-600 mb-4">Спробуйте змінити параметри фільтрації</p>
                <a href="{{ route('catalog') }}" class="inline-block bg-gray-900 hover:bg-gray-800 text-white px-6 py-2 rounded-md transition">
                    Скинути фільтри
                </a>
            </div>
            @endif
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
    .thin-scrollbar::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }
    .thin-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }
    .thin-scrollbar::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 2px;
    }
    .thin-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        background: transparent;
    }
    
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        background: #111827;
        border-radius: 50%;
        cursor: pointer;
        margin-top: -7px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        background: #111827;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        border: none;
    }
    
    input[type="range"]::-webkit-slider-runnable-track {
        width: 100%;
        height: 2px;
        cursor: pointer;
        background: transparent;
        border-radius: 1px;
    }
    
    input[type="range"]::-moz-range-track {
        width: 100%;
        height: 2px;
        cursor: pointer;
        background: transparent;
        border-radius: 1px;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Елементи для фільтрації ціни
    const minPriceSlider = document.getElementById('min-price');
    const maxPriceSlider = document.getElementById('max-price');
    const minPriceInput = document.getElementById('min-price-input');
    const maxPriceInput = document.getElementById('max-price-input');
    const priceRange = document.getElementById('price-range');
    const filterForm = document.getElementById('filter-form');

    function updatePriceRange() {
        const minVal = parseInt(minPriceSlider.value);
        const maxVal = parseInt(maxPriceSlider.value);
        
        minPriceInput.value = minVal;
        maxPriceInput.value = maxVal;
        
        const minPercent = ((minVal - minPriceSlider.min) / (minPriceSlider.max - minPriceSlider.min)) * 100;
        const maxPercent = ((maxVal - maxPriceSlider.min) / (maxPriceSlider.max - maxPriceSlider.min)) * 100;

        priceRange.style.left = `${minPercent}%`;
        priceRange.style.width = `${maxPercent - minPercent}%`;
    }

    minPriceSlider.addEventListener('input', function() {
        if (parseInt(minPriceSlider.value) > parseInt(maxPriceSlider.value)) {
            maxPriceSlider.value = minPriceSlider.value;
        }
        updatePriceRange();
    });

    maxPriceSlider.addEventListener('input', function() {
        if (parseInt(maxPriceSlider.value) < parseInt(minPriceSlider.value)) {
            minPriceSlider.value = maxPriceSlider.value;
        }
        updatePriceRange();
    });

    minPriceInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value)) value = minPriceSlider.min;
        if (value < minPriceSlider.min) value = minPriceSlider.min;
        if (value > maxPriceSlider.value) value = maxPriceSlider.value;
        
        minPriceSlider.value = value;
        this.value = value;
        updatePriceRange();
        submitForm();
    });

    maxPriceInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value)) value = maxPriceSlider.max;
        if (value > maxPriceSlider.max) value = maxPriceSlider.max;
        if (value < minPriceSlider.value) value = minPriceSlider.value;
        
        maxPriceSlider.value = value;
        this.value = value;
        updatePriceRange();
        submitForm();
    });

    let timeout;
    [minPriceSlider, maxPriceSlider].forEach(slider => {
        slider.addEventListener('change', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                submitForm();
            }, 500);
        });
    });

    function submitForm() {
        filterForm.submit();
    }

    updatePriceRange();

    document.querySelectorAll('#filter-form input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', submitForm);
    });

    document.getElementById('sort').addEventListener('change', submitForm);

    function addToCart(productId, quantity, button) {
        @auth
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', quantity);
            formData.append('_token', '{{ csrf_token() }}');

            const originalHtml = button.innerHTML;
            button.innerHTML = `<svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>`;
            button.disabled = true;

            fetch('{{ route("cart.add", ":product") }}'.replace(':product', productId), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCounter(data.cartCount);
                    showToast(data.message, 'success');
                } else {
                    showToast(data.message || 'Помилка додавання до кошика', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Сталася помилка', 'error');
            })
            .finally(() => {
                button.innerHTML = originalHtml;
                button.disabled = false;
            });
        @else
            window.location.href = '{{ route("login") }}';
        @endauth
    }

    function updateCartCounter(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count;
            el.classList.remove('hidden');
        });
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        } animate-fade-in-up`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    document.querySelectorAll('.wishlist-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const button = this.querySelector('button');
            const originalHtml = button.innerHTML;
            button.innerHTML = `<svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>`;
            button.disabled = true;

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    product_id: this.querySelector('input[name="product_id"]').value
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
                    const heartIcon = this.querySelector('svg');
                    if (data.inWishlist) {
                        heartIcon.classList.add('text-red-500', 'fill-red-500');
                        heartIcon.classList.remove('text-gray-400');
                    } else {
                        heartIcon.classList.remove('text-red-500', 'fill-red-500');
                        heartIcon.classList.add('text-gray-400');
                    }
                    showToast(data.message, 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Сталася помилка', 'error');
            })
            .finally(() => {
                button.innerHTML = originalHtml;
                button.disabled = false;
            });
        });
    });
});
</script>
@endpush