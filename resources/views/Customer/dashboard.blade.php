@extends('layouts.user')

@section('content')

        

        <!-- Features Section Start -->
<div class="container-fluid featurs py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-car-side fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Free Shipping</h5>
                        <p class="mb-0">Free on orders over RS.5000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-user-shield fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Security Payment</h5>
                        <p class="mb-0">100% secure payment</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fa fa-phone-alt fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>24/7 Support</h5>
                        <p class="mb-0">Support available anytime</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="featurs-item text-center rounded bg-light p-4">
                    <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                        <i class="fas fa-tags fa-3x text-white"></i>
                    </div>
                    <div class="featurs-content text-center">
                        <h5>Voucher & Discounts</h5>
                        <p class="mb-0">Special offers and discounts for you</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features Section End -->



        <!-- Fruits Shop Start--> 
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Our Organic Products</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">All Products</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">Vegetables</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Fruits</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Handmade</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                        <span class="text-dark" style="width: 130px;">Clothes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        @foreach($vegetables as $vegetable)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($vegetable->image_path) }}" alt="{{ $vegetable->vegetable_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Vegetables</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $vegetable->vegetable_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($vegetable->description, 50) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($vegetable->price, 2) }} / Quantity: {{ $vegetable->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $vegetable->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $vegetable->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $vegetable->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $vegetable->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $vegetable->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @foreach($fruits as $fruit)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($fruit->image_path) }}" alt="{{ $fruit->fruit_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Fruits</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $fruit->fruit_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($fruit->description, 15) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($fruit->price, 2) }} / Quantity: {{ $fruit->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $fruit->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $fruit->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $fruit->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $fruit->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $fruit->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @foreach($handmadeProducts as $product)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->handmadeproduct_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Handmade Product</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $product->handmadeproduct_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($product->price, 2) }} / Quantity: {{ $product->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $product->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $product->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    @foreach($clothes as $cloth)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($cloth->image_path) }}" alt="{{ $cloth->cloth_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Clothes</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $cloth->cloth_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($cloth->description, 50) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($cloth->price, 2) }} / Quantity: {{ $cloth->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $cloth->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $cloth->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $cloth->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $cloth->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $cloth->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @foreach($vegetables as $vegetable)
                                <div class="col-md-3">
                                    <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                        <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                            <img src="{{ asset($vegetable->image_path) }}" alt="{{ $vegetable->vegetable_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                        </div>
                                        <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Vegetables</div>
                                        <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                            <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $vegetable->vegetable_name }}</h5>
                                            <p class="mb-1">{{ \Illuminate\Support\Str::limit($vegetable->description, 50) }}</p>
                                            <p class="text-dark fw-bold mb-1">Rs:{{ number_format($vegetable->price, 2) }} / Quantity: {{ $vegetable->stock_quantity }}</p>
                                            <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $vegetable->created_at->format('d M Y') }}</p>
                                            <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $vegetable->product_id }}">
                                                <input type="hidden" name="seller_id" value="{{ $vegetable->seller_id }}">
                                                <input type="hidden" name="price" value="{{ $vegetable->price }}">
                                                <input type="number" name="quantity" value="1" min="1" max="{{ $vegetable->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                           
                            <div class="row g-4">
                                @foreach($fruits as $fruit)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($fruit->image_path) }}" alt="{{ $fruit->fruit_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Fruits</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $fruit->fruit_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($fruit->description, 15) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($fruit->price, 2) }} / Quantity: {{ $fruit->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $fruit->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $fruit->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $fruit->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $fruit->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $fruit->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                         
                        </div>
                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @foreach($handmadeProducts as $product)
                                        <div class="col-md-3">
                                            <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                                <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                                    <img src="{{ asset($product->image_path) }}" alt="{{ $product->handmadeproduct_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                                </div>
                                                <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Handmade Product</div>
                                                <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                                    <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $product->handmadeproduct_name }}</h5>
                                                    <p class="mb-1">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</p>
                                                    <p class="text-dark fw-bold mb-1">Rs:{{ number_format($product->price, 2) }} / Quantity: {{ $product->stock_quantity }}</p>
                                                    <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $product->created_at->format('d M Y') }}</p>
                                                    <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                                        <input type="hidden" name="seller_id" value="{{ $product->seller_id }}">
                                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                        <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @foreach($clothes as $cloth)
                                <div class="col-md-3">
                                    <div class="rounded position-relative fruite-item" style="height: 8cm; width: 5cm; background-color: #f8f9fa; overflow: hidden;">
                                        <div class="fruite-img position-relative" style="height: 5cm; width: 5cm; overflow: hidden; margin: 0 auto;">
                                            <img src="{{ asset($cloth->image_path) }}" alt="{{ $cloth->cloth_name }}" class="img-fluid w-100 h-100 position-absolute top-0 start-0 object-fit-cover rounded">
                                        </div>
                                        <div class="text-white bg-secondary px-2 py-1 rounded position-absolute" style="top: 0.5cm; left: 0.5cm; font-size: 0.7em;">Clothes</div>
                                        <div class="px-2 py-1 border border-secondary border-top-0 rounded-bottom" style="font-size: 0.8em;">
                                            <h5 class="fw-bold mb-1" style="font-size: 1em;">{{ $cloth->cloth_name }}</h5>
                                            <p class="mb-1">{{ \Illuminate\Support\Str::limit($cloth->description, 50) }}</p>
                                            <p class="text-dark fw-bold mb-1">Rs:{{ number_format($cloth->price, 2) }} / Quantity: {{ $cloth->stock_quantity }}</p>
                                            <p class="text-muted mb-1" style="font-size: 0.7em;">Created at: {{ $cloth->created_at->format('d M Y') }}</p>
                                            <form action="{{ route('buyer.cart.add') }}" method="POST" style="text-align: center;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cloth->product_id }}">
                                                <input type="hidden" name="seller_id" value="{{ $cloth->seller_id }}">
                                                <input type="hidden" name="price" value="{{ $cloth->price }}">
                                                <input type="number" name="quantity" value="1" min="1" max="{{ $cloth->stock_quantity }}" required style="width: 2cm; margin-bottom: 0.2cm;">
                                                <button type="submit" class="btn border border-secondary rounded-pill px-2 py-1 text-primary" style="font-size: 0.8em;"><i class="fa fa-shopping-bag me-1 text-primary"></i>Add to Cart</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
            </div>
        </div>
        <!-- Fruits Shop End-->
      

        <!-- Featurs Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="{{asset('assets/img/hero-img-1.png')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Fruits</h5>
                                        <h6>Freh Fruits</h6>
                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="{{asset('assets/img/hero-img-2.jpg')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Fresh Vegetables</h5>
                                        <h6>Fresh Vegetables</h6>
                                       
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="{{asset('assets/img/hero-img3.png')}}" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Clothes & Handmade Products</h5>
                                        <h6>Good Quality Products</h6>
                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->


        <!-- Fact Start -->
        <div class="container-fluid py-5">
            <div class="container">
                <div class="bg-light p-5 rounded">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>customers</h4>
                                <h1>1000</h1>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>quality of service</h4>
                                <h1>99%</h1>
                            </div>
                        </div>                     
                        <div class="col-md-6 col-lg-6 col-xl-3">
                            <div class="counter bg-white rounded p-5">
                                <i class="fa fa-users text-secondary"></i>
                                <h4>Available Products</h4>
                                <h1>789</h1>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact Start -->


   



@endsection