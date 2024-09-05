<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Clothe;
use App\Models\Fruit;
use App\Models\HandMadeProduct;
use App\Models\Order;
use App\Models\Vegitable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fruits = Fruit::all();
        $vegetables = Vegitable::all();
        $handmadeProducts = HandMadeProduct::all();
        $clothes = Clothe::all();

        return view('customer.dashboard', compact('fruits', 'vegetables', 'handmadeProducts', 'clothes'));
    }

    /**
     * create buyer
     */
    public function aboutus()
    {
        return view('Customer.aboutus', ['showHeroSection' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function orderHistory(Request $request)
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

            return view('Customer.orderHistory', compact('orders'));

        // return view('Customer.orderHistory', compact('orders'), ['showHeroSection' => false]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buyer $buyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}