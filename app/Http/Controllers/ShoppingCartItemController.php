<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShoppingCartItemController extends Controller
{
    public function addToCart($product_id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($product_id);

        // Find or create a cart for the user
        $cart = ShoppingCart::firstOrCreate(['user_id' => $user->id]);

        // Check if the item already exists in the cart
        $cartItem = ShoppingCartItem::where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Update quantity if item already exists
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Add new item to the cart
            ShoppingCartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => 1,
                'price' => $product->price
            ]);
        }

        return redirect()->route('cart.show')->with('success', 'Item added to cart!');
    }

    public function showCart()
    {
        $user = Auth::user();
        $cart = ShoppingCart::where('user_id', $user->id)->with('items.product')->first();
        return view('cart', compact('cart'));
    }

}