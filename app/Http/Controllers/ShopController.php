<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $products = collect(ProductCatalog::all())
            ->filter(function (array $product) use ($request): bool {
                $matchesSearch = $request->filled('q')
                    ? str_contains(strtolower($product['name']), strtolower($request->string('q')->toString()))
                        || str_contains(strtolower($product['category']), strtolower($request->string('q')->toString()))
                    : true;
                $matchesCategory = $request->filled('category')
                    ? strtolower($product['category']) === strtolower($request->string('category')->toString())
                    : true;

                return $matchesSearch && $matchesCategory;
            })
            ->values();

        return view('landing.shop', compact('products'));
    }
}
