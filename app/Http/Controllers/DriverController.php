<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Driver;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use App\Models\Buyer;
use App\Models\Seller;
use App\Models\Product;
use App\Models\User;
use App\Models\Chat;




class DriverController extends Controller
{
    public function __construct()
    {
        // This controller is only for drivers
        if (Auth::user()->role !== 'Driver') {
            abort(404);
        }
    }



    public function index()
    {
       
        $productCount = Product::count();
        $sellerCount = Seller::count();
        $buyerCount = Buyer::count();
        $orderCount = Order::count();
        $deliveryCount = Delivery::count();
        $driver = Driver::where('user_id', Auth::id())->with('district')->first(); // Fetch the logged-in driver
        
        $deliveries = Delivery::where('driver_id', $driver->driver_id)->with('order.orderItems.product')->get();
    
        
        $userId = Auth::id();
        $admin = User::where('role', 'Admin')->first();

        $messages = Chat::where(function($query) use ($userId, $admin) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $admin->id);
        })->orWhere(function($query) use ($userId, $admin) {
            $query->where('sender_id', $admin->id)
                  ->where('receiver_id', $userId);
        })->get();
        
        
        return view('layouts.driver', compact('driver','deliveries', 'productCount', 'sellerCount', 'buyerCount', 'orderCount', 'deliveryCount','messages', 'admin'));
    }

    

    public function count()
    {
        // Get counts for each table
        $buyersCount = DB::table('buyers')->count();
        $productsCount = DB::table('products')->count();
        $sellersCount = DB::table('sellers')->count();

        // Pass counts to the view
        return view('layouts.driver', compact('buyersCount', 'productsCount', 'sellersCount'));
    }

    public function editProfile()
    {
        $driver = Driver::where('user_id', Auth::id())->firstOrFail();
        $districts = District::all();
        return view('layouts.edit_profile', compact('driver', 'districts'));
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string|max:255',
            'Phone_no' => 'required|string|max:15',
            'vehicle_info' => 'nullable|string|max:255',
            'district_id' => 'required|exists:districts,district_id',
        ]);

        $driver = Driver::where('user_id', Auth::id())->firstOrFail();
        $driver->driver_name = $request->input('driver_name');
        $driver->Phone_no = $request->input('Phone_no');
        $driver->vehicle_info = $request->input('vehicle_info');
        $driver->district_id = $request->input('district_id');
        $driver->save();

        return redirect()->route('driver.profile.edit')->with('success', 'Profile updated successfully');
    }




public function showDeliveryDetails($id)
{
    // Fetch the delivery details by ID
    $delivery = Delivery::where('delivery_id', $id)
                        ->with('order.orderItems.product')
                        ->firstOrFail();

    // Pass the delivery details to the view
    return view('layouts.delivery_details', compact('delivery'));
}

public function updateDeliveryStatus(Request $request, $deliveryId)
{
    $request->validate([
        'delivery_status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
    ]);

    $delivery = Delivery::findOrFail($deliveryId);
    $delivery->delivery_status = $request->input('delivery_status');
    $delivery->save();

    return redirect()->back()->with('success', 'Delivery status updated successfully');
}



public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $userId = Auth::id();
    $admin = User::where('role', 'Admin')->first();

    Chat::create([
        'sender_id' => $userId,
        'receiver_id' => $admin->id,
        'message' => $request->message,
    ]);

    return redirect()->route('driver.dashboard');
}

}