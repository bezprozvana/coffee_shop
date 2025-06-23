<div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition duration-300">
    <!-- Зображення товару -->
    <div class="relative pb-3/4 h-48">
        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/albums/coffee-placeholder.jpg') }}" 
             alt="{{ $product->name }}" 
             class="absolute h-full w-full object-cover">
        
        <!-- Бейдж для акційних товарів -->
        @if($product->isOnSale())
            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                Акція
            </div>
        @endif
    </div>
    
    <!-- Контент картки -->
    <div class="p-4">
        <!-- Бренд -->
        <div class="text-sm text-gray-500 mb-1">{{ $product->brand->name }}</div>
        
        <!-- Назва товару -->
        <h3 class="font-semibold text-lg mb-2">
            <a href="{{ route('product.show', $product) }}" class="hover:text-coffee-600">{{ $product->name }}</a>
        </h3>
        
        <!-- Характеристики -->
        <div class="text-sm text-gray-600 mb-3 space-y-1">
            <div>Країна: {{ $product->country->name }}</div>
            <div>Вага: {{ $product->weight->name }}</div>
            <div>Смаковий профіль: {{ $product->flavorProfiles->pluck('name')->join(', ') }}</div>
        </div>
        
        <!-- Ціна та кнопки -->
        <div class="flex items-center justify-between mt-4">
            <div class="font-bold text-lg">{{ $product->price }} грн</div>
            
            <div class="flex space-x-2">
                @auth
                    <button class="text-gray-500 hover:text-coffee-600" title="Додати до списку бажаного">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                @endauth
                
                <button class="bg-coffee-600 hover:bg-coffee-700 text-white px-3 py-1 rounded text-sm font-medium">
                    В кошик
                </button>
            </div>
        </div>
    </div>
</div>