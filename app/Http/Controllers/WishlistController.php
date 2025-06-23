<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Auth::user()->wishlist()
            ->with(['product' => function($query) {
                $query->with(['brand', 'country', 'weight']);
            }])
            ->get();
            
        return view('wishlist.index', [
            'wishlistItems' => $wishlistItems,
            'wishlistCount' => $wishlistItems->count()
        ]);
    }

    public function toggle(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id'
    ]);

    $user = auth()->user();
    $productId = $request->product_id;
    $existing = $user->wishlist()->where('product_id', $productId)->first();

    if ($existing) {
        $existing->delete();
        $inWishlist = false;
        $message = 'Товар видалено зі списку бажаного';
    } else {
        $user->wishlist()->create(['product_id' => $productId]);
        $inWishlist = true;
        $message = 'Товар додано до списку бажаного';
    }

    if ($request->wantsJson()) {
        return response()->json([
            'success' => true,
            'inWishlist' => $inWishlist,
            'message' => $message,
            'wishlistCount' => $user->wishlist()->count()
        ]);
    }

    return back()->with('success', $message);
}

    public function remove(Product $product)
    {
        Auth::user()->wishlist()
            ->where('product_id', $product->id)
            ->delete();
        
        return back()->with('success', 'Товар видалено зі списку бажаного');
    }
}