<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\View\View;

class ShopDetailController extends Controller
{
    public function show(string $product): View
    {
        $product = ProductCatalog::find($product);
        abort_if($product === null, 404);

        return view('landing.shopdetail', compact('product'));
    }
}
