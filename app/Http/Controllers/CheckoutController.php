<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $items = collect($request->session()->get('cart', []))
            ->map(function (int $quantity, string $productId): ?array {
                $product = ProductCatalog::find($productId);

                if ($product === null) {
                    return null;
                }

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $product['price'] * $quantity,
                ];
            })
            ->filter()
            ->values();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'Keranjang Anda masih kosong.');
        }

        return view('landing.checkout', [
            'items' => $items,
            'subtotal' => $items->sum('total'),
            'shipping' => 3,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (empty($request->session()->get('cart', []))) {
            return redirect()->route('cart.index')->with('status', 'Keranjang Anda masih kosong.');
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'postcode' => ['required', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $request->session()->forget('cart');

        return redirect()->route('home')->with('status', 'Checkout demo berhasil. Pembayaran belum diproses.');
    }
}
