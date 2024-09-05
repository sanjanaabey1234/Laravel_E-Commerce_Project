<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function add(Request $request)
    {

        $userId = Auth::id();
        $cart = ShoppingCart::firstOrCreate(['user_id' => $userId]);

        $cartItem = ShoppingCartItem::updateOrCreate(
            [
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id'),
                'seller_id' => $request->input('seller_id')
            ],
            [
                'quantity' => $request->input('quantity'),
                'price' => $request->input('price')
            ]
        );

        return redirect()->route('buyer.cart.view');
    }

    public function viewCart()
    {

        $cart = ShoppingCart::where('user_id', Auth::id())->first();
        $items = ShoppingCartItem::where('cart_id', $cart->id)->get();
        return view('cart.view', compact('items', 'cart'), ['showHeroSection' => false]);
    }
    public function addCart($product_id)
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
        $userId = Auth::id();
        $cart = ShoppingCart::where('user_id', $userId)->first();
        $items = $cart ? ShoppingCartItem::where('cart_id', $cart->id)->get() : [];

        return view('cart', compact('cart'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $cartItem = ShoppingCartItem::findOrFail($id);
        $cartItem->update([
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price') // Optional if price changes with quantity
        ]);

        return redirect()->route('buyer.cart.view');
    }

    public function deleteItem($id)
    {
        $cartItem = ShoppingCartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('buyer.cart.view');
    }

}