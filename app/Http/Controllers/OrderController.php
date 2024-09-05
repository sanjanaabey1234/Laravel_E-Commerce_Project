<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function processOrder(Request $request, $cart_id)
    {

        //This cart include items subtotal and total amount
        $cart = ShoppingCart::where('id', $cart_id)->first();
        $items = ShoppingCartItem::where('cart_id', $cart->id)->get();

        $totalAmount = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });


        return view('cart.checkout', ['showHeroSection' => false], compact('cart', 'items', 'totalAmount'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $cart = ShoppingCart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->route('cart.show')->with('error', 'Cart is empty.');
        }

        $items = ShoppingCartItem::where('cart_id', $cart->id)->get();
        $totalAmount = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'status' => 'Pending',
            'shipping_address' => $request->input('address'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'town_city' => $request->input('town_city'),
            'postcode_zip' => $request->input('postcode_zip'),
            'mobile' => $request->input('mobile'),
            'email_address' => $request->input('email_address'),
            'order_notes' => $request->input('order_notes')
        ]);

        foreach ($items as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'seller_id' => $item->seller_id,
                'quantity' => $item->quantity,
                'price' => $item->price
            ]);
        }

        // Clear the cart
        $cart->delete();

        return redirect()->route('buyer.order.success');
    }

    public function success()
    {
        return view('cart.success', ['showHeroSection' => false]);
    }
}