<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\District;
use App\Models\Driver;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // This controller is only for admins
        if (Auth::user()->role !== 'Admin') {
            abort(404);
        }
    }

    public function index()
    {
        //find count total orders
        $totalOrders = Order::count();
        //find total users count in role by role
        $totalDrivers = User::where('role', 'Driver')->count();
        $totalBuyers = User::where('role', 'Buyer')->count();
        $totalSellers = User::where('role', 'Seller')->count();
        //find total users count  and all data
        $totalUsers = User::count();
        $userDetails = User::all();

        //find this month total orders
        $thisMonthOrders = Order::whereMonth('created_at', date('m'))->count();


        return view('Admin.dashboard', compact('totalOrders', 'totalDrivers', 'totalBuyers', 'totalSellers', 'totalUsers', 'thisMonthOrders', 'userDetails'));
    }

    //VIEW ADMIN PROFILE
    public function profile()
    {
        return view('Admin.profile');
    }


    //VIEW ORDERS LIST
    public function orders()
    {
        //get all orders and buyer details with user district name in district table
        $orders = Order::with('user')->get();
        //find user district name
        foreach ($orders as $order) {
            $district = District::find($order->user->district_id);

            $order->user->district = $district->name ?? '';
        }




        return view('Admin.orders', ['orders' => $orders]);
    }

    //VIEW ORDER DETAILS
    public function orderDetails($order)
    {
        // Get the assigned delivery details, if any
        $delivery = Delivery::where('order_id', $order)->with('driver')->first();



        //get order details sellers and buyer details with user district name in district table
        $order = OrderItem::with('seller', 'order', 'product')->where('order_id', $order)->get();
        //find user district name
        foreach ($order as $orders) {
            $district = District::find($orders->order->user->district_id);
            //find driver according to district
            $drivers = Driver::where('district_id', $orders->order->user->district_id)->get();

            $orders->order->user->district = $district->name ?? '';
        }



        return view('Admin.ordersview', compact('delivery', 'order', 'drivers'));
    }

    //VIEW DRIVERS LIST
    public function drivers()
    {
        // Get all users with the role 'Driver' and eager load the 'district' relationship
        $drivers = User::where('role', 'Driver')->with('district')->get();

        return view('Admin.drivers', ['drivers' => $drivers]);
    }
    public function driversSerach(Request $request)
    {
        $search = $request->input('search');


        // Fetch sellers with the 'Driver' role and filter based on search input
        $drivers = User::where('role', 'Driver')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhereHas('district', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->with('district') // Eager load the district relationship
            ->get();


        return view('Admin.drivers', ['drivers' => $drivers]);

    }

    //DELETE DRIVER
    public function deleteDriver($id)
    {

        $driver = User::find($id);
        $driver->delete();
        return redirect()->back();
    }

    //VIEW SELLERS LIST
    public function sellers()
    {

        // Get all users with the role 'seller' and eager load the 'district' relationship
        $sellers = User::where('role', 'Seller')->with('district')->get();

        return view('Admin.sellers', ['sellers' => $sellers]);
    }
    //SEARCH SELLERS
    public function sellersSerach(Request $request)
    {

        $search = $request->input('search');


        // Fetch sellers with the 'Seller' role and filter based on search input
        $sellers = User::where('role', 'Seller')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhereHas('district', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->with('district') // Eager load the district relationship
            ->get();



        return view('Admin.sellers', ['sellers' => $sellers]);
    }

    //delete seller
    public function deleteSeller($id)
    {
        $seller = User::find($id);
        $seller->delete();
        return redirect()->back();
    }


    //VIEW BUYERS LIST
    public function buyers()
    {
        // Get all users with the role 'Buyer' and eager load the 'district' relationship
        $Buyers = User::where('role', 'Buyer')->with('district')->get();

        return view('Admin.buyers', ['Buyers' => $Buyers]);
    }

    //SEARCH BUYERS
    public function buyersSerach(Request $request)
    {

        $search = $request->input('search');
        // Fetch Buyers with the 'Seller' role and filter based on search input
        $Buyers = User::where('role', 'Buyer')
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhereHas('district', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        });
                });
            })
            ->with('district') // Eager load the district relationship
            ->get();

        return view('Admin.buyers', ['Buyers' => $Buyers]);
    }

    //delete buyer
    public function deleteBuyer($id)
    {
        $buyer = User::find($id);
        $buyer->delete();
        return redirect()->back();
    }

}