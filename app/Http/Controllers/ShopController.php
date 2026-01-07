<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display the shop homepage with products.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(12);
        $categories = Category::all();
        
        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Display a single product detail.
     */
    public function show(Product $product): View
    {
        return view('shop.show', compact('product'));
    }
}
