<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparisonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        
        $products = $user->comparisons()
            ->with([
                'product.brand',
                'product.country',
                'product.category',
                'product.weight',
                'product.acidityLevel',
                'product.sweetnessLevel',
                'product.bitternessLevel',
                'product.processingMethod',
                'product.brewingMethods',
                'product.flavorProfiles'
            ])
            ->get()
            ->pluck('product');
        
        $attributes = $this->getComparisonAttributes($products);
        
        return view('comparison.index', [
            'products' => $products,
            'attributes' => $attributes,
            'maxCompareItems' => 4
        ]);
    }
    public function add(Product $product)
    {
        $user = Auth::user();
        
        // Check if product already in comparison
        if ($user->comparisons()->where('product_id', $product->id)->exists()) {
            return back()->with('info', 'Цей товар вже є у порівнянні');
        }
        
        $maxItems = 4;
        if ($user->comparisons()->count() >= $maxItems) {
            return back()->with('error', "Максимальна кількість товарів для порівняння - {$maxItems}");
        }
        
        $user->comparisons()->create(['product_id' => $product->id]);
        
        return back()->with('success', 'Товар додано до порівняння');
    }
    public function remove(Product $product)
{
    $user = Auth::user();
    
    $deleted = $user->comparisons()
        ->where('product_id', $product->id)
        ->delete();

    if ($deleted) {
        return response()->json([
            'success' => true,
            'message' => 'Товар видалено з порівняння',
            'comparison_count' => $user->comparisons()->count()
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Товар не знайдено у порівнянні'
    ], 404);
}
    public function clear(Request $request)
{
    $user = Auth::user();
    $count = $user->comparisons()->count();
    
    if ($count > 0) {
        $user->comparisons()->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Порівняння очищено',
            'comparison_count' => 0
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Список порівняння вже порожній',
        'comparison_count' => 0
    ]);
}
    private function getComparisonAttributes($products)
    {
        $attributes = [
            'price' => 'Ціна',
            'brand' => 'Бренд',
            'country' => 'Країна походження',
            'category' => 'Категорія',
            'weight' => 'Вага',
            'stock' => 'Наявність',
            'acidity' => 'Кислинка',
            'sweetness' => 'Солодкість',
            'bitterness' => 'Гіркота',
            'processing' => 'Метод обробки',
            'brewing' => 'Методи заварювання',
            'flavors' => 'Аромати'
        ];
        $activeAttributes = [];
        foreach ($attributes as $key => $label) {
            foreach ($products as $product) {
                if ($this->hasAttributeValue($product, $key)) {
                    $activeAttributes[$key] = $label;
                    break;
                }
            }
        }
        return $activeAttributes;
    }
    private function hasAttributeValue($product, $attribute)
    {
        switch ($attribute) {
            case 'price':
                return true;
            case 'brand':
                return $product->brand !== null;
            case 'country':
                return $product->country !== null;
            case 'category':
                return $product->category !== null;
            case 'weight':
                return $product->weight !== null;
            case 'stock':
                return true;
            case 'acidity':
                return $product->acidityLevel !== null;
            case 'sweetness':
                return $product->sweetnessLevel !== null;
            case 'bitterness':
                return $product->bitternessLevel !== null;
            case 'processing':
                return $product->processingMethod !== null;
            case 'brewing':
                return $product->brewingMethods->isNotEmpty();
            case 'flavors':
                return $product->flavorProfiles->isNotEmpty();
            default:
                return false;
        }
    }
    private function getAttributeValue($product, $attribute)
    {
        switch ($attribute) {
            case 'price':
                return number_format($product->price, 0, '', ' ') . ' грн';
            case 'brand':
                return $product->brand->name;
            case 'country':
                return $product->country->name;
            case 'category':
                return $product->category->name;
            case 'weight':
                return $product->weight->name;
            case 'stock':
                return $product->stock_quantity > 0 ? 'В наявності' : 'Немає в наявності';
            case 'acidity':
                return $product->acidityLevel->name;
            case 'sweetness':
                return $product->sweetnessLevel->name;
            case 'bitterness':
                return $product->bitternessLevel->name;
            case 'processing':
                return $product->processingMethod->name;
            case 'brewing':
                return $product->brewingMethods->pluck('name')->join(', ');
            case 'flavors':
                return $product->flavorProfiles->pluck('name')->join(', ');
            default:
                return '-';
        }
    }
}