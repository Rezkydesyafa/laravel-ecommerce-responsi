<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display the shop homepage with products.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(12);
        
        return view('shop.index', compact('products'));
    }

    /**
     * Display a single product detail.
     */
    public function show(Product $product): View
    {
        return view('shop.show', compact('product'));
    }
}
