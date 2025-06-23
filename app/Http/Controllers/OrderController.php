<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\DeliveryMethod;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Кошик порожній');
        }

        $deliveryMethods = DeliveryMethod::all();
        $addresses = $user->addresses;

        return view('orders.checkout', [
            'cartItems' => $cartItems,
            'deliveryMethods' => $deliveryMethods,
            'addresses' => $addresses,
            'subtotal' => $cartItems->sum('total_amount')
        ]);
    }

    public function store(Request $request)
{
    $user = Auth::user();
    $cartItems = $user->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Кошик порожній');
    }

    $request->validate([
        'delivery_method_id' => 'required|exists:delivery_methods,id',
        'address_id' => 'nullable|exists:addresses,id',
        'full_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'region' => 'required|string|max:255',
        'address_line' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10', 
    ]);

    // Перевірка наявності товарів
    foreach ($cartItems as $item) {
        if ($item->product->stock_quantity < $item->quantity) {
            return redirect()->route('cart.index')->with('error', 
                'Товар "' . $item->product->name . '" закінчився на складі');
        }
    }

    $order = null;

    DB::transaction(function () use ($user, $cartItems, $request, &$order) {
        // Створення замовлення
        $order = $user->orders()->create([
            'total_amount' => $cartItems->sum('total_amount'),
            'order_status_id' => OrderStatus::where('name', 'Очікує')->first()->id,
        ]);
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_order_time' => $item->product->price,
            ]);

            $item->product->decrement('stock_quantity', $item->quantity);
        }

        // Створення нової адреси (навіть якщо була обрана існуюча)
        $address = $user->addresses()->create([
            'full_name' => $request->full_name,
            'city' => $request->city,
            'region' => $request->region,
            'address_line' => $request->address_line,
            'postal_code' => $request->postal_code,
            'is_default' => false,
        ]);

        // Створення доставки
        $order->delivery()->create([
            'address_id' => $address->id,
            'delivery_method_id' => $request->delivery_method_id,
        ]);

        $user->cartItems()->delete();
    });

    return redirect()->route('orders.show', $order)->with('success', 'Замовлення успішно оформлено! Оплата при отриманні.');
}

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load(['items.product', 'status', 'delivery.method', 'delivery.address']);
        
        return view('orders.show', compact('order'));
    }
}