<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with(['user', 'status'])->latest()->get();

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, Order $order): View
    {
        $order->load([
            'user',
            'status',
            'items.product',
            'delivery.method',
            'delivery.address'
        ]);

        return view('admin.order.show', [
            'order' => $order,
        ]);
    }

    public function edit(Request $request, Order $order): View
    {
        $statuses = OrderStatus::all();

        return view('admin.order.edit', [
            'order' => $order,
            'statuses' => $statuses,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Статус замовлення оновлено успішно!');
    }

    public function destroy(Request $request, Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Замовлення видалено успішно!');
    }
}