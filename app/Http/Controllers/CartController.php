<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        $items = $cart ? $cart->items()->with('product')->get() : collect([]);

        return view('cart.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = $user->cart ?? $user->cart()->create();

        $item = $cart->items()->where('product_id', $request->product_id)->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::findOrFail($id);
        $userCart = Auth::user()->cart;

        // Ensure user owns this item
        if (!$userCart || $item->cart_id !== $userCart->id) {
            abort(403);
        }

        $item->update(['quantity' => $request->quantity]);

        // Refresh item to get updated subtotal
        $item->refresh();
        
        // Calculate new total
        $total = $userCart->items()->with('product')->get()->sum(function($cartItem) {
            return $cartItem->product->harga * $cartItem->quantity;
        });

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'subtotal' => $item->product->harga * $item->quantity,
                'total' => $total
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        
        if ($item->cart_id !== Auth::user()->cart->id) {
            abort(403);
        }

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
