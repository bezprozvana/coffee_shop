<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'totalItems' => $cartItems->sum('quantity')
        ]);
    }

    // Додати товар до кошика
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:'.$product->stock_quantity
        ]);

        if ($product->stock_quantity < $request->quantity) {
            return back()->with('error', 'На складі недостатньо товару');
        }

        $cartItem = Auth::user()->cartItems()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($product->stock_quantity < $newQuantity) {
                return back()->with('error', 'На складі недостатньо товару для додавання');
            }

            $cartItem->update([
                'quantity' => $newQuantity,
                'total_amount' => $newQuantity * $product->price
            ]);
        } else {
            Auth::user()->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'total_amount' => $request->quantity * $product->price
            ]);
        }

        return back()->with('success', 'Товар додано до кошика');
    }

    // Оновити кількість товару в кошику
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if ($cart->product->stock_quantity < $request->quantity) {
            return redirect()->back()->with('error', 'На складі недостатньо товару');
        }

        $cart->update([
            'quantity' => $request->quantity,
            'total_amount' => $request->quantity * $cart->product->price
        ]);

        return redirect()->route('cart.index')->with('success', 'Кількість оновлено');
    }

    // Видалити товар з кошика
    public function remove(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Товар видалено з кошика');
    }

    // Очистити кошик
    public function clear()
    {
        Auth::user()->cartItems()->delete();
        return redirect()->route('cart.index')->with('success', 'Кошик очищено');
    }

    // Збільшити кількість товару на 1
    public function increment(Cart $cart)
    {
        if ($cart->quantity >= 10) {
            return redirect()->back()->with('error', 'Максимальна кількість - 10');
        }

        if ($cart->product->stock_quantity <= $cart->quantity) {
            return redirect()->back()->with('error', 'На складі недостатньо товару');
        }

        $cart->update([
            'quantity' => $cart->quantity + 1,
            'total_amount' => ($cart->quantity + 1) * $cart->product->price
        ]);

        return redirect()->route('cart.index');
    }

    // Зменшити кількість товару на 1
    public function decrement(Cart $cart)
    {
        if ($cart->quantity <= 1) {
            $cart->delete();
            return redirect()->route('cart.index')->with('success', 'Товар видалено з кошика');
        }

        $cart->update([
            'quantity' => $cart->quantity - 1,
            'total_amount' => ($cart->quantity - 1) * $cart->product->price
        ]);

        return redirect()->route('cart.index');
    }

    // Оформити замовлення
    // app/Http/Controllers/CartController.php
    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Кошик порожній');
        }

        // Перевірка наявності товарів
        foreach ($cartItems as $item) {
            if ($item->product->stock_quantity < $item->quantity) {
                return redirect()->route('cart.index')->with('error', 
                    'Товар "' . $item->product->name . '" закінчився на складі');
            }
        }

        return redirect()->route('orders.checkout');
    }
}