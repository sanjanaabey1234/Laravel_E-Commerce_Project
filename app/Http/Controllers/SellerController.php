<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Clothe;
use App\Models\District;
use App\Models\Fruit;
use App\Models\HandMadeProduct;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Models\Vegitable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Helper\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


class SellerController extends Controller
{
    public function __construct()
    {
        // This controller is only for drivers
        if (Auth::user()->role !== 'Seller') {
            abort(404);
        }
    }

    public function index()
    {

        //find authenticated user fruits vegitables clothes and handmade products
        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();

        $fruits = Fruit::where('seller_id', '=', $sellerId)->get();
        $vegetables = Vegitable::where('seller_id', '=', $sellerId)->get();
        $clothes = Clothe::where('seller_id', '=', $sellerId)->get();
        $handmadeproducts = HandMadeProduct::where('seller_id', '=', $sellerId)->get();


        return view('Seller.dashboard', ['fruits' => $fruits, 'vegetables' => $vegetables, 'clothes' => $clothes, 'handmadeproducts' => $handmadeproducts]);
    }


    public function addShowFruits()
    {
        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();

        $fruits = Fruit::where('seller_id', '=', $sellerId)->get();


        return view('Seller.Products.fruits', ['fruits' => $fruits], ['showHeroSection' => false]);
    }

    public function storeFruits(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'stock_quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        // Create the product and save it to get the ID
        $product = new Product([

            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'stock_quantity' => $request->stock_quantity,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/fruits/');
            $image->move($destinationPath, $name);

            // Save the image name/path in the database
            $imagePath = 'uploads/fruits/' . $name;
            $product->image_path = $imagePath;
        }

        // Save the product 
        $product->save();

        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();



        // Now create the fruit record with the correct product ID
        $fruit = new Fruit([
            'product_id' => $product->product_id,
            'seller_id' => $sellerId,
            'description' => $request->description,
            'price' => $request->price,
            'Amount' => $request->amount,
            'stock_quantity' => $request->stock_quantity,
            'fruit_name' => $request->name,
            'image_path' => $product->image_path, // Use the same image path as the product
        ]);

        $fruit->save();

        return redirect()->back()->with('success', 'Fruit added successfully');
    }
    public function update(Request $request)
    {


        $request->validate([
            'update_p_name' => 'required',
            'update_p_description' => 'required',
            'category' => 'required',
            'update_p_stock_quantity' => 'required',
            'update_p_price' => 'required',
            'update_p_total_price' => 'required',

            'image' => 'image|mimes:jpeg,png,jpg|max:2048',

        ]);

        $productId = Fruit::where('fruit_id', $request->fruit_id)->pluck('product_id')->first();

        $product = Product::find($productId);
        $fruit = Fruit::find($request->fruit_id);

        $product->name = $request->update_p_name;
        $product->description = $request->update_p_description;
        $product->category = $request->category;
        $product->stock_quantity = $request->update_p_stock_quantity;


        if ($request->hasFile('update_p_image')) {


            if ($product->image_path) {

                $image_path_fruit = public_path($product->image_path);

                if (file_exists($image_path_fruit)) {


                    unlink($image_path_fruit);
                }




            }
            if ($fruit->image_path) {
                $image_path = public_path($fruit->image_path);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $image = $request->file('update_p_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/fruits/');
            $image->move($destinationPath, $name);
            $imagePath = 'uploads/fruits/' . $name;
            $product->image_path = $imagePath;
            $fruit->image_path = $imagePath;



        }

        $product->save();

        $fruit->fruit_name = $request->update_p_name;
        $fruit->description = $request->update_p_description;
        $fruit->price = $request->update_p_price;
        $fruit->Amount = $request->update_p_total_price;
        $fruit->stock_quantity = $request->update_p_stock_quantity;

        $fruit->save();

        return redirect()->back()->with('success', 'Fruit updated successfully');


    }
    //** DELETE A SPECIFIC FRUIT VIEW */

    public function deleteView($id)
    {
        return view('Seller.Products.DeletePage.fruit.delete', ['id' => $id]);
    }

    public function delete($id)
    {
        $productId = Fruit::where('fruit_id', $id)->pluck('product_id')->first();

        $productData = Product::find($productId);
        if ($productData->image_path) {

            $image_path = public_path($productData->image_path);

            if (file_exists($image_path)) {

                unlink($image_path);
            }
        }

        $productData->delete();
        return redirect()->back()->with('success', 'Fruit Deleted successfully');

    }


    //** VEGITABLES */


    //** SHOW VEGITABLE */
    public function addShowVegitables()
    {

        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();

        $vegitables = Vegitable::where('seller_id', '=', $sellerId)->get();


        return view('Seller.Products.vegitable', ['vegitables' => $vegitables], ['showHeroSection' => false]);
    }

    //** STORE VEGITABLE */
    public function storeVegitable(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'stock_quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // Create the product and save it to get the ID
        $product = new Product([

            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'stock_quantity' => $request->stock_quantity,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/vegitables/');
            $image->move($destinationPath, $name);

            // Save the image name/path in the database
            $imagePath = 'uploads/vegitables/' . $name;
            $product->image_path = $imagePath;
        }

        // Save the product 
        $product->save();

        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();



        // Now create the fruit record with the correct product ID
        $fruit = new Vegitable([
            'product_id' => $product->product_id,
            'seller_id' => $sellerId,
            'description' => $request->description,
            'price' => $request->price,
            'Amount' => $request->amount,
            'stock_quantity' => $request->stock_quantity,
            'vegitable_name' => $request->name,
            'image_path' => $product->image_path, // Use the same image path as the product
        ]);

        $fruit->save();

        return redirect()->back()->with('success', 'Vegitable added successfully');

    }

    //** UPDATE A SPECIFIC VEGITABLE */
    public function updateVegitable(Request $request)
    {
        $request->validate([
            'update_p_name' => 'required|max:255',
            'update_p_description' => 'required',
            'update_p_price' => 'required',
            'update_p_total_price' => 'required',
            'update_p_stock_quantity' => 'required',
            'update_p_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();

        try {

            $productId = Vegitable::where('vegitable_id', $request->vegetable_id)->pluck('product_id')->first();

            $product = Product::find($productId);
            $vegitable = Vegitable::find($request->vegetable_id);



            $product->name = $request->update_p_name;
            $product->description = $request->update_p_description;
            $product->stock_quantity = $request->update_p_stock_quantity;


            if ($request->hasFile('update_p_image')) {


                if ($product->image_path) {

                    $image_path_vegitable = public_path($product->image_path);

                    if (file_exists($image_path_vegitable)) {


                        unlink($image_path_vegitable);
                    }




                }
                if ($vegitable->image_path) {
                    $image_path = public_path($vegitable->image_path);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $image = $request->file('update_p_image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/vegitables/');
                $image->move($destinationPath, $name);
                $imagePath = 'uploads/vegitables/' . $name;
                $product->image_path = $imagePath;
                $vegitable->image_path = $imagePath;



            }


            $product->save();

            $vegitable->vegitable_name = $request->update_p_name;
            $vegitable->description = $request->update_p_description;
            $vegitable->price = $request->update_p_price;
            $vegitable->Amount = $request->update_p_total_price;
            $vegitable->stock_quantity = $request->update_p_stock_quantity;
            $vegitable->save();


            DB::commit();

            return redirect()->back()->with('success', 'Vegitable updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the vegitable:');

        }

    }


    //** DELETE A SPECIFIC VEGITABLE */
    public function deleteVegetable($id)
    {


        $productId = Vegitable::where('vegitable_id', $id)->pluck('product_id')->first();


        $productData = Product::find($productId);

        if ($productData->image_path) {

            $image_path = public_path($productData->image_path);

            if (file_exists($image_path)) {

                unlink($image_path);
            }
        }

        $productData->delete();
        return redirect()->back()->with('success', 'Vegitable Deleted successfully');
    }

    //** CLOTHES    */

    //** SHOW CLOTHES */
    public function addShowClothes()
    {
        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();

        $clothes = Clothe::where('seller_id', '=', $sellerId)->get();


        return view('Seller.Products.clothes', ['clothes' => $clothes], ['showHeroSection' => false]);
    }

    //** STORE CLOTHES */
    public function storeClothes(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'stock_quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Create the product and save it to get the ID
            $product = new Product([

                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'stock_quantity' => $request->stock_quantity,
            ]);


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/clothes/');
                $image->move($destinationPath, $name);

                // Save the image name/path in the database
                $imagePath = 'uploads/clothes/' . $name;
                $product->image_path = $imagePath;
            }

            // Save the product 
            $product->save();


            // Get the authenticated user's ID
            $userId = Auth::user()->id;

            // Retrieve the matching seller ID for the given user ID
            $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();



            // Now create the fruit record with the correct product ID
            $fruit = new Clothe([
                'product_id' => $product->product_id,
                'seller_id' => $sellerId,
                'description' => $request->description,
                'price' => $request->price,
                'Amount' => $request->amount,
                'stock_quantity' => $request->stock_quantity,
                'cloth_name' => $request->name,
                'image_path' => $product->image_path, // Use the same image path as the product
            ]);

            $fruit->save();

            DB::commit();


            return redirect()->back()->with('success', 'Clothe added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while adding the clothe:');

        }

    }

    //** UPDATE CLOTHES */
    public function updateClothes(Request $request)
    {
        $request->validate([
            'update_p_name' => 'required|max:255',
            'update_p_description' => 'required',
            'update_p_price' => 'required',
            'update_p_total_price' => 'required',
            'update_p_stock_quantity' => 'required',
            'update_p_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);


        DB::beginTransaction();

        try {

            $productId = Clothe::where('cloth_id', $request->cloth_id)->pluck('product_id')->first();

            $product = Product::find($productId);
            $clothe = Clothe::find($request->cloth_id);



            $product->name = $request->update_p_name;
            $product->description = $request->update_p_description;
            $product->stock_quantity = $request->update_p_stock_quantity;


            if ($request->hasFile('update_p_image')) {


                if ($product->image_path) {

                    $image_path_clothe = public_path($product->image_path);

                    if (file_exists($image_path_clothe)) {


                        unlink($image_path_clothe);
                    }




                }
                if ($clothe->image_path) {
                    $image_path = public_path($clothe->image_path);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $image = $request->file('update_p_image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/clothes/');
                $image->move($destinationPath, $name);
                $imagePath = 'uploads/clothes/' . $name;
                $product->image_path = $imagePath;
                $clothe->image_path = $imagePath;



            }


            $product->save();

            $clothe->cloth_name = $request->update_p_name;
            $clothe->description = $request->update_p_description;
            $clothe->price = $request->update_p_price;
            $clothe->Amount = $request->update_p_total_price;
            $clothe->stock_quantity = $request->update_p_stock_quantity;
            $clothe->save();


            DB::commit();

            return redirect()->back()->with('success', 'Clothe updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the clothe:');

        }


    }

    //** DELETE CLOTHES */
    public function deleteClothes($id)
    {

        $productId = Clothe::where('cloth_id', $id)->pluck('product_id')->first();


        $productData = Product::find($productId);

        if ($productData->image_path) {

            $image_path = public_path($productData->image_path);

            if (file_exists($image_path)) {

                unlink($image_path);
            }
        }

        if ($productData->delete()) {
            return redirect()->back()->with('success', 'Clothe Deleted successfully');

        } else {
            return redirect()->back()->with('error', 'An error occurred while deleting the clothe:');
        }
    }


    //** HAND MADE PRODUCTS */

    public function addShowHandmadeProduct()
    {
        // Get the authenticated user's ID
        $userId = Auth::user()->id;

        // Retrieve the matching seller ID for the given user ID
        $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();

        $handmadeproducts = HandMadeProduct::where('seller_id', '=', $sellerId)->get();


        return view('Seller.Products.handmade', ['handmadeproducts' => $handmadeproducts], ['showHeroSection' => false]);
    }

    //** STORE HAND MADE PRODUCTS */
    public function storeHandmadeProduct(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'stock_quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Create the product and save it to get the ID
            $product = new Product([

                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'stock_quantity' => $request->stock_quantity,
            ]);


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/handmadeproducts/');
                $image->move($destinationPath, $name);

                // Save the image name/path in the database
                $imagePath = 'uploads/handmadeproducts/' . $name;
                $product->image_path = $imagePath;
            }

            // Save the product 
            $product->save();


            // Get the authenticated user's ID
            $userId = Auth::user()->id;

            // Retrieve the matching seller ID for the given user ID
            $sellerId = Seller::where('user_id', $userId)->pluck('seller_id')->first();



            // Now create the fruit record with the correct product ID
            $fruit = new HandMadeProduct([
                'product_id' => $product->product_id,
                'seller_id' => $sellerId,
                'description' => $request->description,
                'price' => $request->price,
                'Amount' => $request->amount,
                'stock_quantity' => $request->stock_quantity,
                'handmadeproduct_name' => $request->name,
                'image_path' => $product->image_path, // Use the same image path as the product
            ]);

            $fruit->save();

            DB::commit();


            return redirect()->back()->with('success', 'Handmade product added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while adding the handmade product:');

        }

    }

    //** UPDATE HAND MADE PRODUCTS */
    public function updateHandmadeProduct(Request $request)
    {
        $request->validate([
            'update_p_name' => 'required|max:255',
            'update_p_description' => 'required',
            'update_p_price' => 'required',
            'update_p_total_price' => 'required',
            'update_p_stock_quantity' => 'required',
            'update_p_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);


        DB::beginTransaction();

        try {

            $productId = HandMadeProduct::where('handmadeproduct_id', $request->handmadeproduct_id)->pluck('product_id')->first();

            $product = Product::find($productId);
            $clothe = HandMadeProduct::find($request->handmadeproduct_id);



            $product->name = $request->update_p_name;
            $product->description = $request->update_p_description;
            $product->stock_quantity = $request->update_p_stock_quantity;


            if ($request->hasFile('update_p_image')) {


                if ($product->image_path) {

                    $image_path_clothe = public_path($product->image_path);

                    if (file_exists($image_path_clothe)) {


                        unlink($image_path_clothe);
                    }




                }
                if ($clothe->image_path) {
                    $image_path = public_path($clothe->image_path);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                $image = $request->file('update_p_image');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/handmadeproducts/');
                $image->move($destinationPath, $name);
                $imagePath = 'uploads/handmadeproducts/' . $name;
                $product->image_path = $imagePath;
                $clothe->image_path = $imagePath;



            }


            $product->save();

            $clothe->handmadeproduct_name = $request->update_p_name;
            $clothe->description = $request->update_p_description;
            $clothe->price = $request->update_p_price;
            $clothe->Amount = $request->update_p_total_price;
            $clothe->stock_quantity = $request->update_p_stock_quantity;
            $clothe->save();


            DB::commit();

            return redirect()->back()->with('success', 'Handmade product updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the handmade product:');

        }

    }

    //** DELETE HANDMADE PRODUCTS */
    public function deleteHandmadeProduct($id)
    {

        $productId = HandMadeProduct::where('handmadeproduct_id', $id)->pluck('product_id')->first();


        $productData = Product::find($productId);

        if ($productData->image_path) {

            $image_path = public_path($productData->image_path);

            if (file_exists($image_path)) {

                unlink($image_path);
            }
        }

        if ($productData->delete()) {
            return redirect()->back()->with('success', 'Handmaid product Deleted successfully');

        } else {
            return redirect()->back()->with('error', 'An error occurred while deleting the handmaid product:');
        }
    }

    //**Seller  orders */
    public function orderView($id)
    {
        //find this this user seller id
        $sellerId = Seller::where('user_id', $id)->pluck('seller_id')->first();
        //find this seller orders
        $orders = OrderItem::where('seller_id', $sellerId)->with('order', 'product')->get();


        //order include products name that order total got
        // Fetch order items with associated orders and products
        $orders = OrderItem::where('seller_id', $sellerId)
            ->with('order', 'product')
            ->get()
            ->groupBy('order_id');







        // Return the view with the orders
        return view('Seller.Orders.view', [
            'orders' => $orders,
            'showHeroSection' => false // You can include other variables as needed
        ]);
    }

    //**seller order details */

    public function orderDetails($order_id)
    {
        //find this this user seller id
        $sellerId = Seller::where('user_id', Auth::user()->id)->pluck('seller_id')->first();
        //find this seller orders
        $orders = OrderItem::where('seller_id', $sellerId)
            ->where('order_id', $order_id)
            ->with('order', 'product')->get();





        return view('Seller.Orders.viewDetails', [
            'orders' => $orders,
            'showHeroSection' => false
        ]);
    }

    //**seller about us */

    public function aboutus()
    {

        return view('Seller.aboutus', ['showHeroSection' => false]);
    }

    //**seller profile */
    public function profile()
    {
        //get all district names
        $districts = District::all();


        return view('Seller.profile', ['showHeroSection' => false], ['districts' => $districts]);
    }

    public function updateProfile(Request $request, $id)
    {


        DB::beginTransaction();
        try {
            // Update the user table directly
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'district_id' => $request->district,
            ]);

            // Update the seller table directly
            Seller::where('user_id', $id)->update([
                'seller_name' => $request->name,
                'district_id' => $request->district,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the profile:');

        }
    }

    //one seller ship his order

    public function orderShipped(Request $request, $user_id)
    {

        // Find this user's seller ID
        $sellerId = Seller::where('user_id', $user_id)->pluck('seller_id')->first();

        // Find this order ID for this seller's matching orders
        $orders = OrderItem::where('seller_id', $sellerId)
            ->where('order_id', $request->order_id)
            ->with('order', 'product')->get();

        // Prepare order details for the email
        $orderDetails = [];
        $totalAmount = 0; // Initialize total amount
        foreach ($orders as $orderItem) {
            $subtotal = $orderItem->price * $orderItem->quantity;
            $totalAmount += $subtotal; // Add subtotal to total amount

            $orderDetails[] = [
                'product_name' => $orderItem->product->name,
                'quantity' => $orderItem->quantity,
                'price' => $orderItem->price, // Store as a number
                'subtotal' => $subtotal, // Store as a number
            ];
        }

        // Get unique sellers
        $uniqueSellers = $orders->unique('order.user_id');

        // Seller name
        $seller = Seller::select('seller_name')->where('seller_id', $sellerId)->first();
        $sellerName = $seller->seller_name;

        // Send the email
        Mail::to('kasunviha5@gmail.com')->send(new OrderShipped($orders[0]->order->id, $sellerName, $orderDetails, $totalAmount));

        // Set the current status to "Shipped"
        $currentStatus = 'Shipped';

        // Store the "Shipped" status in the session
        session(['currentStatus[' . $orders[0]->order->id . ']' => $currentStatus]);
        // Return a response or redirect
        return back()->with([
            'success' => 'Order shipped email has been sent.'

        ]);
    }



}