<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Показати сторінку входу.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Обробити запит на автентифікацію.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Перевірка на адміністратора
        if (Auth::user()?->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        // Звичайний користувач -> редірект на головну
        return redirect('/');
    }

    /**
     * Вийти з системи (знищити сесію).
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Вихід користувача
        Auth::guard('web')->logout();

        // Інвалідуємо сесію
        $request->session()->invalidate();

        // Генеруємо новий токен безпеки
        $request->session()->regenerateToken();

        // Редірект на головну
        return redirect('/');
    }
}
