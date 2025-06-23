<?php

namespace App\Http\Controllers;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        $product->load([
            'brand', 
            'weight', 
            'country', 
            'category', 
            'acidityLevel', 
            'sweetnessLevel', 
            'bitternessLevel', 
            'processingMethod',
            'flavorProfiles',
            'brewingMethods'
        ]);
        
        return view('product.show', compact('product'));
    }
}