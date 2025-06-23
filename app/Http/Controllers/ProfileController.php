<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
            'ordersCount' => $request->user()->orders()->count(),
            'addressesCount' => $request->user()->addresses()->count()
        ]);
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    public function addresses(Request $request): View
    {
        $addresses = $request->user()->addresses()->latest()->get();
        return view('profile.addresses.index', compact('addresses'));
    }

    public function createAddress()
{
    return view('profile.addresses.create');
}

    public function storeAddress(AddressRequest $request): RedirectResponse
    {
        $request->user()->addresses()->create($request->validated());
        return redirect()->route('profile.addresses')->with('success', 'Адресу успішно додано');
    }

    public function editAddress(Address $address): View
    {
        $this->authorize('update', $address);
        return view('profile.addresses.edit', compact('address'));
    }

    public function updateAddress(AddressRequest $request, Address $address): RedirectResponse
    {
        $this->authorize('update', $address);
        $address->update($request->validated());
        return redirect()->route('profile.addresses')->with('success', 'Адресу успішно оновлено');
    }

    public function destroyAddress(Address $address): RedirectResponse
    {
        $this->authorize('delete', $address);
        $address->delete();
        return redirect()->route('profile.addresses')->with('success', 'Адресу успішно видалено');
    }

    public function orders(Request $request): View
    {
        $orders = $request->user()->orders()
            ->with(['items.product', 'status'])
            ->latest()
            ->paginate(10);
            
        return view('profile.orders.index', compact('orders'));
    }
}