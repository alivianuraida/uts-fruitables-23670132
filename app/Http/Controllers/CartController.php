<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $items = collect($cart)
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

        return view('landing.cart', [
            'items' => $items,
            'subtotal' => $items->sum('total'),
            'shipping' => $items->isEmpty() ? 0 : 3,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'string', 'in:'.implode(',', array_keys(ProductCatalog::all()))],
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = $request->session()->get('cart', []);
        $productId = $validated['product_id'];
        $cart[$productId] = min(99, ($cart[$productId] ?? 0) + $validated['quantity']);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, string $productId): RedirectResponse
    {
        abort_unless(ProductCatalog::find($productId) !== null, 404);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            $cart[$productId] = $validated['quantity'];
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('status', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(Request $request, string $productId): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$productId]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Produk berhasil dihapus dari keranjang.');
    }
}
