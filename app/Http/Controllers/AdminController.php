<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\ProductCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(): View
    {
        $products = ProductCatalog::all();

        return view('admin.dashboard', [
            'userCount' => User::query()->count(),
            'newUsers' => User::query()
                ->latest()
                ->limit(5)
                ->get(['id', 'name', 'email', 'created_at']),
            'products' => $products,
            'categoryCount' => collect($products)->pluck('category')->unique()->count(),
        ]);
    }

    public function modals(): View
    {
        return view('admin.component-modals');
    }

    public function formElements(): View
    {
        return view('admin.form-elements');
    }

    public function dataTable(): View
    {
        return view('admin.table-datatable', [
            'users' => User::query()
                ->select(['id', 'name', 'email', 'created_at'])
                ->latest()
                ->limit(100)
                ->get(),
            'products' => ProductCatalog::all(),
        ]);
    }

    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth-basic-login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email atau kata sandi tidak sesuai.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
