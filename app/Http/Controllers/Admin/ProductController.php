<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::with([
            'brand',
            'weight',
            'country',
            'category',
            'acidityLevel',
            'sweetnessLevel',
            'bitternessLevel',
            'processingMethod',
        ])->get();

        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    public function create(Request $request): View
    {
        return view('admin.product.create', [
            'brands' => \App\Models\Brand::all(),
            'categories' => \App\Models\Category::all(),
            'countries' => \App\Models\Country::all(),
            'weights' => \App\Models\Weight::all(),
            'acidityLevels' => \App\Models\AcidityLevel::all(),
            'sweetnessLevels' => \App\Models\SweetnessLevel::all(),
            'bitternessLevels' => \App\Models\BitternessLevel::all(),
            'processingMethods' => \App\Models\ProcessingMethod::all(),
        ]);
    }


    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/albums/foto'), $filename);
            $data['image'] = $filename;
        }

        $product = Product::create($data);

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('admin.products.index');
    }

    public function show(Request $request, Product $product): View
    {
        return view('admin.product.show', [
            'product' => $product,
        ]);
    }

    public function edit(Request $request, Product $product): View
    {
        return view('admin.product.edit', [
            'product' => $product,
            'brands' => \App\Models\Brand::all(),
            'categories' => \App\Models\Category::all(),
            'countries' => \App\Models\Country::all(),
            'weights' => \App\Models\Weight::all(),
            'acidityLevels' => \App\Models\AcidityLevel::all(),
            'sweetnessLevels' => \App\Models\SweetnessLevel::all(),
            'bitternessLevels' => \App\Models\BitternessLevel::all(),
            'processingMethods' => \App\Models\ProcessingMethod::all(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Видаляємо старе зображення, якщо є
            if ($product->image && file_exists(public_path('assets/albums/foto/' . $product->image))) {
                unlink(public_path('assets/albums/foto/' . $product->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/albums/foto'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('admin.products.index');
    }


    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index');
    }
}