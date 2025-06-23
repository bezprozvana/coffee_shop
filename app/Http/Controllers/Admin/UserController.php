<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::all();

        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    public function show(Request $request, User $user): View
    {
        $user->load(['orders']);

        return view('admin.user.show', [
            'user' => $user,
        ]);
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    // public function create(Request $request): View { ... }
    // public function store(UserStoreRequest $request): RedirectResponse { ... }
    // public function edit(Request $request, User $user): View { ... }
    // public function update(UserUpdateRequest $request, User $user): RedirectResponse { ... }
}
