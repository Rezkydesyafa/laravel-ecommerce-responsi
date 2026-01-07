<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = $cart->items;
        $total = $items->sum(function($item) {
            return $item->product->harga * $item->quantity;
        });

        return view('checkout.index', compact('items', 'total', 'user'));
    }
}