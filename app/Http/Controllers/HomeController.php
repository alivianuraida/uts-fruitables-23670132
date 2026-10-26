<?php

namespace App\Http\Controllers;

use App\Support\ProductCatalog;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('landing.home', [
            'products' => array_slice(ProductCatalog::all(), 0, 4, true),
        ]);
    }
}
