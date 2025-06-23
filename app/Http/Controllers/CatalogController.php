<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Country;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Weight;
use App\Models\AcidityLevel;
use App\Models\SweetnessLevel;
use App\Models\BitternessLevel;
use Illuminate\Http\Request;
use App\Models\ProcessingMethod;

class CatalogController extends Controller
{
    /**
     * Display the full product catalog with filters
     */
    public function index(Request $request)
    {

        $query = Product::query()
            ->with(['category', 'brand', 'country', 'weight'])
            ->whereNull('deleted_at');

        $this->applyFilters($query, $request);

        $this->applySorting($query, $request);

        $perPage = $request->get('per_page', 27);
        $products = $query->paginate($perPage)->withQueryString();

        $filters = $this->getFilterData($request);

        return view('catalog.index', compact('products', 'filters'));
    }

    /**
     * Display products for a specific category
     */
    public function showCategory(Category $category, Request $request)
    {
        $query = Product::query()
            ->with(['category', 'brand', 'country', 'weight'])
            ->where('category_id', $category->id)
            ->whereNull('deleted_at');

        $this->applyFilters($query, $request);
        $this->applySorting($query, $request);

        $perPage = $request->get('per_page', 27);
        $products = $query->paginate($perPage)->withQueryString();

        $filters = $this->getFilterData($request, $category);

        return view('catalog.index', compact('products', 'filters', 'category'));
    }

    /**
     * Display product detail
     */
    public function showProduct(Product $product)
{

    if ($product->stock_quantity <= 0) {
        abort(404);
    }

    $product->load([
        'category', 
        'brand', 
        'country', 
        'weight',
        'brewingMethods',
        'flavorProfiles'
    ]);

    $similarProducts = Product::query()
        ->with(['brand', 'country', 'weight'])
        ->where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->where('stock_quantity', '>', 0)
        ->inRandomOrder()
        ->limit(4)
        ->get();

    // Отримуємо дані для фільтрів
    $categories = Category::all();
    $countries = Country::all();
    $brands = Brand::all();
    $minPrice = Product::min('price');
    $maxPrice = Product::max('price');

    return view('catalog.show', [
        'product' => $product,
        'similarProducts' => $similarProducts,
        'categories' => $categories,
        'countries' => $countries,
        'brands' => $brands,
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice
    ]);
}

    /**
     * Quick search for AJAX
     */
    public function quickSearch(Request $request)
    {
        $q = $request->get('query', '');
        if (strlen($q) < 3) {
            return response()->json([]);
        }

        $results = Product::query()
            ->where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->where('stock_quantity', '>', 0)
            ->with(['category', 'brand'])
            ->limit(5)
            ->get();

        return response()->json($results);
    }

    /**
     * Apply filters to query
     */
    private function applyFilters($query, Request $request)
    {

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', Product::max('price'));
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        if ($request->filled('category')) {
            $query->whereIn('category_id', (array)$request->input('category'));
        }

        if ($request->filled('brand')) {
            $query->whereIn('brand_id', (array)$request->input('brand'));
        }

        if ($request->filled('country')) {
            $query->whereIn('country_id', (array)$request->input('country'));
        }

        if ($request->filled('weight')) {
            $query->whereIn('weight_id', (array)$request->input('weight'));
        }

        if ($request->filled('brewing_method')) {
            $query->whereHas('brewingMethods', function($q) use ($request) {
                $q->whereIn('brewing_method_id', (array)$request->input('brewing_method'));
            });
        }

        if ($request->filled('processing_method')) {
            $query->whereIn('processing_method_id', (array)$request->input('processing_method'));
        }

        if ($request->filled('flavor_profile')) {
            $query->whereHas('flavorProfiles', function($q) use ($request) {
                $q->whereIn('flavor_profile_id', (array)$request->input('flavor_profile'));
            });
        }
    }

    /**
 * Apply sorting to query
 */
private function applySorting($query, Request $request)
{
    $sort = $request->get('sort', 'newest');
    
    switch ($sort) {
        case 'price_asc':
            $query->orderBy('price', 'ASC');
            break;
            
        case 'price_desc':
            $query->orderBy('price', 'DESC');
            break;
            
        case 'newest':
            $query->orderBy('created_at', 'DESC');
            break;
            
        default:
            break;
    }
}
    private function getFilterData(Request $request, Category $category = null)
{
    $query = Product::query()->whereNull('deleted_at');
    
    if ($category) {
        $query->where('category_id', $category->id);
    }

    if ($request->has('search')) {
        $searchTerm = $request->get('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }

    $minPrice = $query->min('price');
    $maxPrice = $query->max('price');

    return [
        'minPrice' => $minPrice,
        'maxPrice' => $maxPrice,
        'currentMinPrice' => $request->get('min_price', $minPrice),
        'currentMaxPrice' => $request->get('max_price', $maxPrice),
        'selectedFilters' => $request->except(['page', 'sort', 'per_page']),
        'sort' => $request->get('sort', 'newest'),
        'categories' => Category::all(),
        'countries' => Country::all(),
        'brands' => Brand::all(),
        'weights' => Weight::all(),
        'processingMethods' => ProcessingMethod::all(),
        'acidityLevels' => AcidityLevel::all(),
        'sweetnessLevels' => SweetnessLevel::all(),
        'bitternessLevels' => BitternessLevel::all(),
        'currentCategory' => $category ?? null,
    ];
}

    public function search(Request $request)
    {
        $searchTerm = $request->get('search');
        
        $query = Product::query()
            ->with(['category', 'brand', 'country', 'weight'])
            ->whereNull('deleted_at');

        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $this->applySearchFilters($query, $request);

        $this->applySorting($query, $request);

        $perPage = $request->get('per_page', 27);
        $products = $query->paginate($perPage)->withQueryString();

        $filters = $this->getFilterData($request);

        return view('catalog.index', compact('products', 'filters', 'searchTerm'));
    }

    private function applySearchFilters($query, Request $request)
    {
        if ($request->filled('brand_id')) {
            $query->whereIn('brand_id', (array)$request->input('brand_id'));
        }

        if ($request->filled('weight_id')) {
            $query->whereIn('weight_id', (array)$request->input('weight_id'));
        }

        if ($request->filled('country_id')) {
            $query->whereIn('country_id', (array)$request->input('country_id'));
        }

        if ($request->filled('category_id')) {
            $query->whereIn('category_id', (array)$request->input('category_id'));
        }

        if ($request->filled('acidity_level_id')) {
            $query->whereIn('acidity_level_id', (array)$request->input('acidity_level_id'));
        }

        if ($request->filled('sweetness_level_id')) {
            $query->whereIn('sweetness_level_id', (array)$request->input('sweetness_level_id'));
        }

        if ($request->filled('bitterness_level_id')) {
            $query->whereIn('bitterness_level_id', (array)$request->input('bitterness_level_id'));
        }

        if ($request->filled('processing_method_id')) {
            $query->whereIn('processing_method_id', (array)$request->input('processing_method_id'));
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $minPrice = $request->input('min_price', 0);
            $maxPrice = $request->input('max_price', Product::max('price'));
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }
    }

}
