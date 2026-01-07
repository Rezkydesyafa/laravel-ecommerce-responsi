<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

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

    public function process(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('shop.index')->with('error', 'Cart is empty');
        }

        // Calculate total
        $total = $cart->items->sum(function($item) {
            return $item->product->harga * $item->quantity;
        });

        // Create Transaction
        $transaction = Transaction::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'status' => 'pending',
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
        ]);

        // Create Transaction Items
        foreach ($cart->items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->harga,
            ]);
        }

        // Configure Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $transaction->id . '-' . time(),
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $request->phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            
            $transaction->update([
                'snap_token' => $snapToken,
            ]);

            // Clear Cart (Optional: can calculate total again or just clear here)
            // $cart->items()->delete(); 
            // Better to clear cart AFTER payment success or just leave it for now until callback.
            // Common pattern: keep in cart until paid? Or move to pending order?
            // User requirement didn't specify. I'll NOT clear cart yet to avoid valid items loss if payment fails/cancels immediately.
            // Or I can clear it because now it's in Transaction.
            // Let's clear it to prevent double order of same items if they go back.
            $cart->items()->delete();

            return redirect()->route('checkout.payment', $transaction);

        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return back()->with('error', 'Payment generation failed: ' . $e->getMessage());
        }
    }

    public function payment(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }
        return view('checkout.payment', compact('transaction'));
    }

    public function success(Request $request)
    {
        $payload = $request->all();
        // Log::info('Payment Success Payload', $payload);

        // Midtrans "result" object structure depends on payment type
        // Usually: order_id, transaction_status, payment_type
        
        $orderIdParts = explode('-', $payload['order_id']);
        $transactionId = $orderIdParts[1];

        $transaction = Transaction::find($transactionId);

        if ($transaction) {
            $transaction->update([
                'status' => 'success', // We assume success because this endpoint is called on onSuccess
                'payment_type' => $payload['payment_type'] ?? 'unknown',
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $status = 'success';
            } elseif ($request->transaction_status == 'expire') {
                $status = 'expired';
            } elseif ($request->transaction_status == 'cancel') {
                $status = 'failed';
            } else {
                $status = 'pending';
            }

            // Extract ID from ORDER-ID-TIMESTAMP
            $orderIdParts = explode('-', $request->order_id);
            $transactionId = $orderIdParts[1];

            $transaction = Transaction::find($transactionId);
            if ($transaction) {
                $transaction->update([
                    'status' => $status,
                    'payment_type' => $request->payment_type ?? $transaction->payment_type,
                ]);
            }
        }
        
        return response()->json(['status' => 'ok']);
    }
}