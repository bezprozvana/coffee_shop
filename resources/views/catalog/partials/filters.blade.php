<div class="bg-white p-6 rounded-lg shadow-sm sticky top-4">
    <form action="{{ request()->has('search') ? route('catalog.search') : (isset($category) ? route('catalog.category', $category) : route('catalog.index')) }}" method="GET">

        <div class="mb-6">
            <input type="text" name="search" placeholder="Пошук в каталозі..." 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-coffee-500"
                   value="{{ request('search') }}">
        </div>

        <div class="mb-6">
            <h3 class="font-medium mb-3">Ціна</h3>
            <div class="flex items-center justify-between mb-2">
                <span>{{ $filters['currentMinPrice'] }} грн</span>
                <span>{{ $filters['currentMaxPrice'] }} грн</span>
            </div>
            <input type="hidden" name="min_price" value="{{ request('min_price', $filters['minPrice']) }}">
            <input type="hidden" name="max_price" value="{{ request('max_price', $filters['maxPrice']) }}">
            <div class="price-slider" 
                 data-min="{{ $filters['minPrice'] }}" 
                 data-max="{{ $filters['maxPrice'] }}"
                 data-current-min="{{ request('min_price', $filters['minPrice']) }}"
                 data-current-max="{{ request('max_price', $filters['maxPrice']) }}"></div>
        </div>

        @if(!isset($category))
        <div class="mb-6">
            <h3 class="font-medium mb-3">Категорії</h3>
            @foreach($filters['categories'] as $cat)
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="category_{{ $cat->id }}" name="category_id[]" value="{{ $cat->id }}"
                           {{ in_array($cat->id, (array)request('category_id')) ? 'checked' : '' }}
                           class="rounded text-coffee-600 focus:ring-coffee-500">
                    <label for="category_{{ $cat->id }}" class="ml-2 text-sm">{{ $cat->name }}</label>
                </div>
            @endforeach
        </div>
        @endif

        <div class="mb-6">
            <h3 class="font-medium mb-3">Країна походження</h3>
            @foreach($filters['countries'] as $country)
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="country_{{ $country->id }}" name="country_id[]" value="{{ $country->id }}"
                           {{ in_array($country->id, (array)request('country_id')) ? 'checked' : '' }}
                           class="rounded text-coffee-600 focus:ring-coffee-500">
                    <label for="country_{{ $country->id }}" class="ml-2 text-sm">{{ $country->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-6">
            <h3 class="font-medium mb-3">Бренди</h3>
            @foreach($filters['brands'] as $brand)
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="brand_{{ $brand->id }}" name="brand_id[]" value="{{ $brand->id }}"
                           {{ in_array($brand->id, (array)request('brand_id')) ? 'checked' : '' }}
                           class="rounded text-coffee-600 focus:ring-coffee-500">
                    <label for="brand_{{ $brand->id }}" class="ml-2 text-sm">{{ $brand->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-6">
            <h3 class="font-medium mb-3">Метод обробки</h3>
            @foreach($filters['processingMethods'] as $method)
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="method_{{ $method->id }}" name="processing_method_id[]" value="{{ $method->id }}"
                           {{ in_array($method->id, (array)request('processing_method_id')) ? 'checked' : '' }}
                           class="rounded text-coffee-600 focus:ring-coffee-500">
                    <label for="method_{{ $method->id }}" class="ml-2 text-sm">{{ $method->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="w-full bg-coffee-600 text-white py-2 px-4 rounded-lg hover:bg-coffee-700 transition">
            Застосувати фільтри
        </button>
        @if(request()->except('page'))
            <a href="{{ request()->has('search') ? route('catalog.search') : (isset($category) ? route('catalog.category', $category) : route('catalog.index') }}" 
               class="block mt-2 text-center text-sm text-coffee-600 hover:text-coffee-800">
                Скинути фільтри
            </a>
        @endif
    </form>
</div>