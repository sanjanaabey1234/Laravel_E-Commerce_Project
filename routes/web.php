<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\ChatbotConreoller;
use App\Http\Controllers\ChatBotController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FruitController;
use App\Http\Controllers\HandMadeProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\VegitableController;
use App\Models\HandMadeProduct;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DriverProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/index', function () {
    return view('index2');
});


Route::get('/dashboard', [BuyerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/dashboard', function () {
//     return view('Customer.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Buyer routes
    Route::get('/shop', [BuyerController::class, 'shopView'])->name('buyer.shop');

    // *** GROUP ROUTES FOR Seller ***//
    Route::prefix('seller')->as('seller.')->group(function () {
        //** dashboard */
        Route::get('/dashboard', [SellerController::class, 'index'])->name('dashboard');

        //fruit routes
        Route::get('/addFruits', [SellerController::class, 'addShowFruits'])->name('show.product');
        Route::post('/storeFruits', [SellerController::class, 'storeFruits'])->name('store.Fruits');
        Route::post('seller/update/fruit', [SellerController::class, 'update'])->name('update.Fruit');
        Route::delete('seller/delete/fruit/{id}', [SellerController::class, 'delete'])->name('delete.Fruit');

        //Vegitables Routes
        Route::get('/addVegitable', [SellerController::class, 'addShowVegitables'])->name('show.vegitable');
        Route::post('/storeVegitable', [SellerController::class, 'storeVegitable'])->name('store.vegitable');
        Route::post('/update/vegitable', [SellerController::class, 'updateVegitable'])->name('update.vegitable');
        Route::delete('/delete/vegitable/{id}', [SellerController::class, 'deleteVegetable'])->name('delete.Vegetable');

        //clothes routes
        Route::get('/addClothes', [SellerController::class, 'addShowClothes'])->name('show.clothes');
        Route::post('/storeClothes', [SellerController::class, 'storeClothes'])->name('store.clothes');
        Route::post('/update/clothes', [SellerController::class, 'updateClothes'])->name('update.clothes');
        Route::delete('/delete/clothes/{id}', [SellerController::class, 'deleteClothes'])->name('delete.clothes');

        //hanmade product routes
        Route::get('/addProduct', [SellerController::class, 'addShowHandmadeProduct'])->name('show.handmadeproduct');
        Route::post('/storeProduct', [SellerController::class, 'storeHandmadeProduct'])->name('store.handmadeproduct');
        Route::post('/update/product', [SellerController::class, 'updateHandmadeProduct'])->name('update.handmadeproduct');
        Route::delete('/delete/product/{id}', [SellerController::class, 'deleteHandmadeProduct'])->name('delete.handmadeproductproduct');

        //** seller orders */
        Route::get('orders/{id}', [SellerController::class, 'orderView'])->name('orders');
        Route::get('/order/details/{order}', [SellerController::class, 'orderDetails'])->name('view.order.details');

        //seller shipped order
        Route::post('/order/details/shipped/{user_id}', [SellerController::class, 'orderShipped'])->name('order.shipped');

        //** seller about */
        Route::get('/aboutus', [SellerController::class, 'aboutus'])->name('aboutus');

        //** seller profile */
        Route::get('/profile', [SellerController::class, 'profile'])->name('profile');
        Route::post('/profile/update/{id}', [SellerController::class, 'updateProfile'])->name('profile.update');


    });


    //*** GROUP ROUTES FOR ADMIN */
    Route::prefix('admin')->as('admin.')->group(function () {
        //** admin dashboard */
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        //** admin profile */
        Route::get(('/profile'), [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('profile.update');

        //** admin orders */
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::get('/order/details/{order}', [AdminController::class, 'orderDetails'])->name('view.order.details');

        //** Assign driver for order */
        Route::post('/assign/driver/{order_id}', [DeliveryController::class, 'assignDriver'])->name('assign.driver');
        Route::get('/deliveries/list', [DeliveryController::class, 'deliveriesList'])->name('deliveries.view');

        //** drivers routes */
        Route::get('/drivers/view', [AdminController::class, 'drivers'])->name('view.drivers');
        Route::get('drivers/search', [AdminController::class, 'driversSerach'])->name('drivers.search');
        Route::delete('/driver/{driver_id}', [AdminController::class, 'deleteDriver'])->name('drivers.delete');
        Route::get('/driver/edit/{id}', [AdminController::class, 'editdriversDetails'])->name('edit.driver.details');
        Route::post('/driver/update/{id}', [AdminController::class, 'updateDriverDetails'])->name('update.driver.details');

        //** sellers routes  */
        Route::get('/sellers/view', [AdminController::class, 'sellers'])->name('view.sellers');
        Route::get('sellers/search', [AdminController::class, 'sellersSerach'])->name('sellers.search');
        Route::delete('/seller/{seller_id}', [AdminController::class, 'deleteSeller'])->name('sellers.delete');
        Route::get('/seller/edit/{id}', [AdminController::class, 'editsellerDetails'])->name('edit.seller.details');
        Route::post('/seller/update/{id}', [AdminController::class, 'updatesellerDetails'])->name('update.seller.details');

        //** buyers routes */
        Route::get('/buyers/view', [AdminController::class, 'buyers'])->name('view.buyers');
        Route::get('buyers/search', [AdminController::class, 'buyersSerach'])->name('buyers.search');
        Route::delete('/buyer/{buyer_id}', [AdminController::class, 'deleteBuyer'])->name('buyers.delete');
        Route::get('/buyer/edit/{id}', [AdminController::class, 'editbuyerDetails'])->name('edit.buyer.details');
        Route::post('/buyer/update/{id}', [AdminController::class, 'updatebuyerDetails'])->name('update.buyer.details');






    });

    //*** GROUP ROUTES FOR BUYER */
    Route::prefix('buyer')->as('buyer.')->group(function () {
        //fruits view
        Route::get('/fruits', [FruitController::class, 'fruitsView'])->name('fruits');
        //vegetables view
        Route::get('/vegetables', [VegitableController::class, 'vegetablesView'])->name('vegetables');
        //clothes view
        Route::get('/clothes', [ClotheController::class, 'clothesView'])->name('clothes');
        //handmade product view
        Route::get('/handmade', [HandMadeProductController::class, 'handmadeView'])->name('handmades');

        //cart
        Route::post('/cart/add', [ShoppingCartController::class, 'add'])->name('cart.add');
        Route::get('/cart', [ShoppingCartController::class, 'viewCart'])->name('cart.view');
        Route::patch('/cart/update/{id}', [ShoppingCartController::class, 'updateQuantity'])->name('cart.update');
        Route::delete('/cart/delete/{id}', [ShoppingCartController::class, 'deleteItem'])->name('cart.delete');

        //checkout
        Route::get('/order/checkout/{id}', [OrderController::class, 'processOrder'])->name('order.process');
        Route::post('/order/complete', [OrderController::class, 'store'])->name('order.save');
        Route::get('/order/complete/success', [OrderController::class, 'success'])->name('order.success');


        //** Buyer about us */
        Route::get('/aboutus', [BuyerController::class, 'aboutus'])->name('aboutus');

        //** Buyer Order History */
        Route::get('/order-history', [BuyerController::class, 'orderHistory'])->name('Order.History');

    });

    //*** GROUP ROUTES FOR DRIVER */
    Route::prefix('driver')->as('driver.')->group(function () {
    Route::get('/dashboard2', [DriverController::class, 'index'])->name('dashboard');
    // Route to show the edit profile form
    Route::get('/profile/edit', [DriverController::class, 'editProfile'])->name('profile.edit');

    // Route to handle profile update
    Route::post('/profile/update', [DriverController::class, 'updateProfile'])->name('profile.update');

    Route::get('/delivery/{id}', [DriverController::class, 'showDeliveryDetails'])->name('delivery.details');

    Route::post('/delivery/{deliveryId}/update-status', [DriverController::class, 'updateDeliveryStatus'])->name('delivery.updateStatus');

    // Route::get('/chat', [DriverController::class, 'showChat'])->name('chat.show');
    Route::post('/chat/send', [DriverController::class, 'sendMessage'])->name('chat.send');
    
});

});

Route::get('/chat', [ChatBotController::class, 'index'])->name('chat');
Route::post('/chat/send', [ChatBotController::class, 'sendMessage']);


// //seller
// Route::get('/chatseller', [ChatbotConreoller::class, 'sellerChat'])->name('chat.seller');
// Route::post('/chatseller/send', [ChatbotConreoller::class, 'sellerSendMessage'])->name('chat.seller.send');

//Buyer routes
Route::get('/shop', [BuyerController::class, 'shopView'])->name('buyer.shop');


Route::get('/das', function () {
    return view('Driver.dashboard2');
});


require __DIR__ . '/auth.php';