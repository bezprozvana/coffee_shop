@extends('layouts.admin')

@section('title', 'Редагувати продукт')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('admin.products.index') }}"
               class="inline-flex items-center bg-white hover:bg-gray-100 text-gray-800 font-medium text-sm px-4 py-2.5 rounded-lg border border-gray-300 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Назад до списку
            </a>
            
            <h2 class="text-2xl font-bold text-gray-800 absolute left-1/2 transform -translate-x-1/2">Редагувати продукт</h2>
            
            
            <div></div>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Перша колонка -->
                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Назва продукту</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 border"
                                   required>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Ціна (грн)</label>
                            <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 border"
                                   required>
                        </div>

                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Кількість на складі</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 border"
                                   required>
                        </div>

                        <div>
                            <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">Бренд</label>
                            <select name="brand_id" id="brand_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="weight_id" class="block text-sm font-medium text-gray-700 mb-1">Фасування</label>
                            <select name="weight_id" id="weight_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($weights as $weight)
                                    <option value="{{ $weight->id }}" {{ $product->weight_id == $weight->id ? 'selected' : '' }}>{{ $weight->value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="country_id" class="block text-sm font-medium text-gray-700 mb-1">Країна</label>
                            <select name="country_id" id="country_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $product->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Друга колонка -->
                    <div class="space-y-5">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Категорія</label>
                            <select name="category_id" id="category_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="acidity_level_id" class="block text-sm font-medium text-gray-700 mb-1">Кислинка</label>
                            <select name="acidity_level_id" id="acidity_level_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($acidityLevels as $level)
                                    <option value="{{ $level->id }}" {{ $product->acidity_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="sweetness_level_id" class="block text-sm font-medium text-gray-700 mb-1">Солодкість</label>
                            <select name="sweetness_level_id" id="sweetness_level_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($sweetnessLevels as $level)
                                    <option value="{{ $level->id }}" {{ $product->sweetness_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="bitterness_level_id" class="block text-sm font-medium text-gray-700 mb-1">Гіркота</label>
                            <select name="bitterness_level_id" id="bitterness_level_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($bitternessLevels as $level)
                                    <option value="{{ $level->id }}" {{ $product->bitterness_level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="processing_method_id" class="block text-sm font-medium text-gray-700 mb-1">Обробка</label>
                            <select name="processing_method_id" id="processing_method_id" 
                                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2.5 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                @foreach ($processingMethods as $method)
                                    <option value="{{ $method->id }}" {{ $product->processing_method_id == $method->id ? 'selected' : '' }}>{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Фото продукту</label>
                            <input type="file" name="image" id="image" 
                                   class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                            @if($product->image)
                                <div class="mt-3">
                                    <img src="{{ asset('assets/albums/foto/' . $product->image) }}" 
                                         alt="Поточне фото" 
                                         class="h-20 object-cover rounded border border-gray-200">
                                    <p class="text-xs text-gray-500 mt-1">Поточне фото: {{ $product->image }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Опис продукту</label>
                    <textarea name="description" id="description" rows="4" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 px-3 border"
                              required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.products.index') }}" 
                       class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Скасувати
                    </a>
                    <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-emerald-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Оновити продукт
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection