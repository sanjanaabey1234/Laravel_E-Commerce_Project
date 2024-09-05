<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    // public function index()
    // {
    //     $orders = Order::with('orderItems.product')
    //                    ->where('user_id', Auth::id())
    //                    ->orderBy('created_at', 'desc')
    //                    ->get();

    //     return view('Customer.orderHistory', compact('orders'));
    // }

    
}