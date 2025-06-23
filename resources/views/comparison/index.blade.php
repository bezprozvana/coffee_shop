@extends('layouts.app')

@section('title', 'Порівняння товарів - Coffee Shop')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-coffee-dark">Порівняння товарів</h1>
        </div>
        
        @if($products->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-coffee-light/30">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-coffee-dark uppercase tracking-wider">
                            Характеристика
                        </th>
                        @foreach($products as $product)
                        <th scope="col" class="px-6 py-4 text-center w-64" data-product-id="{{ $product->id }}">
                            <div class="flex flex-col items-center">
                                <div class="relative mb-3">
                                    <a href="{{ route('catalog.show', $product) }}">
                                        <img src="{{ asset('assets/albums/foto/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="h-40 object-contain"
                                             onerror="this.src='{{ asset('assets/albums/foto/default.jpg') }}'">
                                    </a>
                                    <button onclick="removeFromComparison({{ $product->id }})" 
                                            class="absolute top-0 right-0 bg-white rounded-full p-1 shadow-md hover:bg-red-100 transition"
                                            title="Видалити з порівняння">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <a href="{{ route('catalog.show', $product) }}" class="text-sm font-medium text-coffee-dark hover:text-coffee-primary text-center">
                                    {{ $product->name }}
                                </a>
                                <div class="mt-1 text-coffee-primary font-bold">
                                    {{ number_format($product->price, 0, '', ' ') }} грн
                                </div>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($attributes as $attributeKey => $attributeLabel)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $attributeLabel }}
                        </td>
                        @foreach($products as $product)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            @switch($attributeKey)
                                @case('price')
                                    {{ number_format($product->price, 0, '', ' ') }} грн
                                    @break
                                @case('brand')
                                    {{ $product->brand->name ?? '-' }}
                                    @break
                                @case('country')
                                    {{ $product->country->name ?? '-' }}
                                    @break
                                @case('category')
                                    {{ $product->category->name ?? '-' }}
                                    @break
                                @case('weight')
                                    {{ $product->weight->name ?? '-' }}
                                    @break
                                @case('stock')
                                    <span class="{{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock_quantity > 0 ? 'В наявності' : 'Немає в наявності' }}
                                    </span>
                                    @break
                                @case('acidity')
                                    {{ $product->acidityLevel->name ?? '-' }}
                                    @break
                                @case('sweetness')
                                    {{ $product->sweetnessLevel->name ?? '-' }}
                                    @break
                                @case('bitterness')
                                    {{ $product->bitternessLevel->name ?? '-' }}
                                    @break
                                @case('processing')
                                    {{ $product->processingMethod->name ?? '-' }}
                                    @break
                                @case('brewing')
                                    @if($product->brewingMethods->isNotEmpty())
                                        <div class="flex flex-wrap justify-center gap-1">
                                            @foreach($product->brewingMethods as $method)
                                            <span class="bg-coffee-light text-coffee-dark text-xs px-2 py-1 rounded">
                                                {{ $method->name }}
                                            </span>
                                            @endforeach
                                        </div>
                                    @else
                                        -
                                    @endif
                                    @break
                                @case('flavors')
                                    @if($product->flavorProfiles->isNotEmpty())
                                        <div class="flex flex-wrap justify-center gap-1">
                                            @foreach($product->flavorProfiles as $profile)
                                            <span class="bg-coffee-light text-coffee-dark text-xs px-2 py-1 rounded">
                                                {{ $profile->name }}
                                            </span>
                                            @endforeach
                                        </div>
                                    @else
                                        -
                                    @endif
                                    @break
                                @default
                                    -
                            @endswitch
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-200 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Порівнюється {{ $products->count() }} з {{ $maxCompareItems }} можливих товарів
            </div>
            <div>
                <button id="clear-comparison" 
                        class="px-4 py-2 bg-white border border-red-500 text-red-500 rounded-lg hover:bg-red-50 transition">
                    Очистити порівняння
                </button>
            </div>
        </div>
        @else
        <div class="p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Список порівняння порожній</h3>
            <p class="text-gray-600 mb-6">Додавайте товари до порівняння, щоб побачити їх характеристики</p>
            <a href="{{ route('catalog') }}" class="inline-block bg-coffee-primary text-white px-6 py-2 rounded-lg hover:bg-coffee-dark transition">
                Перейти до каталогу
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function removeFromComparison(productId) {
        if (confirm('Видалити товар з порівняння?')) {
            fetch(`/comparison/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const comparisonCounter = document.getElementById('comparison-count');
                    if (comparisonCounter) {
                        comparisonCounter.textContent = data.comparison_count;
                    }
                    
                    const productColumn = document.querySelector(`th[data-product-id="${productId}"]`);
                    if (productColumn) {
                        const columnIndex = Array.from(productColumn.parentNode.children).indexOf(productColumn);
                        document.querySelectorAll(`tr td:nth-child(${columnIndex + 1})`).forEach(td => {
                            td.remove();
                        });
                        productColumn.remove();
                    }
                    
                    if (data.comparison_count === 0) {
                        window.location.reload();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Помилка при видаленні товару');
            });
        }
    }

document.getElementById('clear-comparison')?.addEventListener('click', function() {
    if (confirm('Очистити весь список порівняння?')) {
        fetch('{{ route("comparison.clear") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                _method: 'DELETE'
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
                const comparisonCounter = document.getElementById('comparison-count');
                if (comparisonCounter) {
                    comparisonCounter.textContent = 0;
                    comparisonCounter.classList.add('hidden');
                }
                
                alert(data.message);
                
                window.location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Помилка при очищенні порівняння: ' + error.message);
        });
    }
});
</script>
@endpush