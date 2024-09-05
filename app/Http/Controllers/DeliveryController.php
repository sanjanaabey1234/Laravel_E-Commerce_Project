<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function assignDriver(Request $request, $order_id)
    {
        try {
            if ($delivery = Delivery::where('order_id', $order_id)->first()) {
                return redirect()->back()->with('error', 'Driver Already Assigned');
            }

            if ($request->driver_id == null) {
                return redirect()->back()->with('error', 'Please Select Driver');
            }


            //store details in delivery table
            $delivery = Delivery::create([
                'order_id' => $order_id,
                'driver_id' => $request->driver_id,
                'delivery_status' => 'pending'
            ]);

            return redirect()->back()->with('success', 'Driver Assigned Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    public function deliveriesList()
    {
        try {
            $deliveries = Delivery::with('driver')->get();


            return view('Admin.delivery', compact('deliveries'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function index()
    {
        // Fetch all deliveries assigned to the logged-in driver
        $deliveries = Delivery::with('order', 'order.orderItems.product')
            ->where('driver_id', Auth::user()->id)
            ->get();

        return view('driver.index', compact('deliveries'));
    }

    //  public function show($id)
    //  {
    //      // Fetch specific delivery details
    //      $delivery = Delivery::with('order', 'order.orderItems.product')
    //          ->where('id', $id)
    //          ->where('driver_id', Auth::user()->id)
    //          ->firstOrFail();

    //      return view('driver.show', compact('delivery'));
    //  }

    public function update(Request $request, $id)
    {
        $request->validate([
            'delivery_status' => 'required|in:Pending,In Transit,Delivered,Cancelled',
            'delivery_date' => 'nullable|date',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->delivery_status = $request->input('delivery_status');
        $delivery->delivery_date = $request->input('delivery_date');
        $delivery->save();

        return redirect()->route('driver.show', $delivery->id)->with('success', 'Delivery details updated successfully.');
    }

    public function show($deliveryId)
    {
        $delivery = Delivery::with(['order', 'order.orderItems.product', 'order.orderItems.seller', 'driver'])
            ->findOrFail($deliveryId);

        return view('layouts.delivery', compact('delivery'));
    }
}