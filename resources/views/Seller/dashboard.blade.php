@extends('layouts.user')

@section('content')
 <!-- Hero Section -->
 <div class="info-section text-center">
    <h2 class="info-title">Get Started Sale Your Products</h2>
    <p class="info-description">Discover the tools and features available to help you succeed.</p>
    <div class="info-cards">
        <div class="info-card">
            <i class="fas fa-box"></i>
            <h3>Manage Products</h3>
            <p>Organize your inventory and update product details with ease.</p>
        </div>
        <div class="info-card ">
            <i class="fas fa-chart-line"></i>
            <h3>Track Sales</h3>
            <p>Monitor your sales performance and generate detailed reports.</p>
        </div>
        <div class="info-card">
            <i class="fas fa-users"></i>
            <h3>Customer Insights</h3>
            <p>Understand your customers' behavior and preferences to improve your strategy.</p>
        </div>
    </div>
</div>

   <!-- Fruits Shop Start--> 
   <div class="container-fluid fruite py-5">
      <div class="container py-5">
          <div class="tab-class text-center">
              <div class="row g-4">
                  <div class="col-lg-4 text-start">
                      <h1>My Products</h1>
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
                                  <span class="text-dark" style="width: 130px;">Clothes</span>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                  <span class="text-dark" style="width: 130px;">Handmade Products</span>
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
                               <!-- Search Input -->
<div class="mb-4">
    <input type="text" id="productsSearch" class="form-control" placeholder="Search items by name, description, price, or date...">
</div>

<div class="row g-4">
    <!-- Loop through each vegetable -->
    @foreach ($vegetables as $vegetable)
    <div class="col-md-6 col-lg-4 col-xl-3 vegetable-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Vegetable Image -->
                <img src="{{ asset($vegetable->image_path) }}" class="img-fluid rounded-top" alt="{{ $vegetable->vegitable_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
                <!-- Category Label -->
                <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Vegetables</div>
            </div>
            <!-- Vegetable Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h5 class="vegitable-name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $vegetable->vegitable_name }}</h5>
                <p class="vegitable-description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $vegetable->description }}</p>
                <p class="text-success fs-6 fw-bold mb-0 vegitable-price">RS.{{ $vegetable->price }} / {{ $vegetable->stock_quantity }} Kg</p>
                <p class="vegitable-created-at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $vegetable->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Loop through each fruit -->
    @foreach ($fruits as $fruit)
    <div class="col-md-6 col-lg-4 col-xl-3 fruit-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Fruit Image -->
                <img src="{{ asset($fruit->image_path) }}" class="img-fluid rounded-top" alt="{{ $fruit->fruit_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
            </div>
            <!-- Category Label -->
            <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Fruits</div>
            <!-- Fruit Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h4 class="fruit_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $fruit->fruit_name }}</h4>
                <p class="fruit_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $fruit->description }}</p>
                <p class="text-success fs-6 fw-bold mb-0 fruit_price">RS.{{ $fruit->price }} / {{ $fruit->stock_quantity }} Kg</p>
                <p class="fruit_created_at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $fruit->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Loop through each cloth -->
    @foreach ($clothes as $cloth)
    <div class="col-md-6 col-lg-4 col-xl-3 cloth-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Cloth Image -->
                <img src="{{ asset($cloth->image_path) }}" class="img-fluid rounded-top" alt="{{ $cloth->cloth_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
            </div>
            <!-- Category Label -->
            <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Clothes</div>
            <!-- Cloth Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h4 class="cloth_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $cloth->cloth_name }}</h4>
                <p class="cloth_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $cloth->description }}</p>
                <p class="text-success fs-6 fw-bold mb-0 cloth_price">RS.{{ $cloth->price }} / {{ $cloth->stock_quantity }}</p>
                <p class="cloth_created_at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $cloth->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Loop through each handmade product -->
    @foreach ($handmadeproducts as $handmadeproduct)
    <div class="col-md-6 col-lg-4 col-xl-3 handmade-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Handmade Product Image -->
                <img src="{{ asset($handmadeproduct->image_path) }}" class="img-fluid rounded-top" alt="{{ $handmadeproduct->handmadeproduct_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
            </div>
            <!-- Category Label -->
            <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Handmade Products</div>
            <!-- Handmade Product Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h4 class="handmade_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $handmadeproduct->handmadeproduct_name }}</h4>
                <p class="handmade_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $handmadeproduct->description }}</p>
                <p class="text-success fs-6 fw-bold mb-0 handmade_price">RS.{{ $handmadeproduct->price }}</p>
                <p class="handmade_created_at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $handmadeproduct->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

                                
                            </div>
                        </div>
                    </div>

                      
                  </div>
                  {{-- VEGETABLES --}}
                  <div id="tab-2" class="tab-pane fade show p-0">
                     <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                 <!-- Search Input -->
    <div class="mb-4">
        <input type="text" id="search-input" class="form-control" placeholder="Search vegetables by name, description, or price...">
    </div>
    @foreach ($vegetables as $vegetable)
    <div class="col-md-6 col-lg-4 col-xl-3 vegetable-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Vegetable Image -->
                <img src="{{ asset($vegetable->image_path) }}" class="img-fluid rounded-top" alt="{{ $vegetable->vegitable_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
                <!-- Category Label -->
                <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Vegetables</div>
            </div>
            <!-- Vegetable Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h5 class="vegitable-name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $vegetable->vegitable_name }}</h5>
                <p class="vegitable-description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $vegetable->description }}</p>
               
                <p class="text-success fs-6 fw-bold mb-0 vegitable-price">RS.{{ $vegetable->price }} / {{ $vegetable->stock_quantity }} Kg</p>
            
                <p class="vegitable-created-at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $vegetable->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach
    
                                
                            </div>
                        </div>
                    </div>
                  </div>
                  {{-- FRUITS --}}
                  
                  <div id="tab-3" class="tab-pane fade show p-0">
                     <div class="row g-4">
                         <div class="col-lg-12">
                             <div class="row g-4">
 <!-- Search Input -->
<div class="mb-4">
    <input type="text" id="fruitSearch" class="form-control" placeholder="Search fruits by name, description, price, or date...">
</div>

<!-- Fruit Display Section -->
<div class="row g-4" id="fruitContainer">
    @foreach ($fruits as $fruit)
    <div class="col-md-6 col-lg-4 col-xl-3 fruit-item mb-3">
        <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
            <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                <!-- Fruit Image -->
                <img src="{{ asset($fruit->image_path) }}" class="img-fluid rounded-top" alt="{{ $fruit->fruit_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
            </div>
            <!-- Category Label -->
            <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Fruits</div>
            <!-- Fruit Details -->
            <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                <h4 class="fruit_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $fruit->fruit_name }}</h4>
                <p class="fruit_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $fruit->description }}</p>
                <p class="text-success fs-6 fw-bold mb-0 fruit_price">RS.{{ $fruit->price }} / {{ $fruit->stock_quantity }} Kg</p>
                <p class="fruit_created_at mb-1 text-muted" style="font-size: 0.75rem;">Added on: {{ $fruit->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>



                             </div>
                         </div>
                     </div>
                 </div>
                 
                 
                 
                 
                 {{-- cloths --}}
                  <div id="tab-4" class="tab-pane fade show p-0">
                     <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <!-- Search Input -->
<div class="mb-4">
    <input type="text" id="clothSearch" class="form-control" placeholder="Search fruits by name, description, price, or date...">
</div>
                                <!-- Loop through each cloths -->
                                @foreach ($clothes as $cloth)
                                <div class="col-md-6 col-lg-4 col-xl-3 cloth-item mb-3">
                                    <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
                                        <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                                            <!-- cloth Image -->
                                            <img src="{{ asset($cloth->image_path) }}" class="img-fluid rounded-top" alt="{{ $cloth->cloth_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
                                        </div>
                                        <!-- Category Label -->
                                        <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Clothes</div>
                                        <!-- clothes Details -->
                                        <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                                            <h4 class="cloth_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $cloth->cloth_name }}</h4>
                                            <p class="cloth_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $cloth->description }}</p>
                                            <p class="text-success fs-6 fw-bold mb-0 cloth_price">RS.{{ $cloth->price }} / {{ $cloth->stock_quantity }}</p>
                                            <p class="cloth_created_at mb-1 text-muted" style="font-size: 0.75rem;">Add on: {{ $cloth->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    
                      </div>
                  </div>

                  {{-- hanmade products --}}
                  <div id="tab-5" class="tab-pane fade show p-0">
                     <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <div class="mb-4">
                                    <input type="text" id="handmadeSearch" class="form-control" placeholder="Search fruits by name, description, price, or date...">
                                </div>
                                <!-- Loop through each vegetable -->
                                @foreach ($handmadeproducts as $handmadeproduct)
                                <div class="col-md-6 col-lg-4 col-xl-3 handmade-item mb-3">
                                    <div class="rounded position-relative fruite-item shadow-sm" style="border: none; overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
                                        <div class="fruite-img position-relative" style="width: 100%; height: 180px; overflow: hidden; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                                            <!-- vegetable Image -->
                                            <img src="{{ asset($handmadeproduct->image_path) }}" class="img-fluid w-100 rounded-top" alt="{{ $handmadeproduct->handmadeproduct_name }}" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
                                        </div>
                                        <!-- Category Label -->
                                        <div class="text-white bg-success px-2 py-1 rounded position-absolute" style="top: 8px; left: 8px; font-size: 0.75rem; font-weight: bold;">Handmade Products</div>
                                        <!-- vegetable Details -->
                                        <div class="p-2 bg-white text-center" style="height: 150px; overflow: hidden;">
                                            <h4 class="handmade_name mb-1" style="font-size: 1.15rem; font-weight: bold; color: #343a40;">{{ $handmadeproduct->handmadeproduct_name }}</h4>
                                            <p class="handmade_description mb-1 text-muted" style="font-size: 0.85rem; height: 40px; overflow: hidden; text-overflow: ellipsis;">{{ $handmadeproduct->description }}</p>
                                            <p class="text-success fs-6 fw-bold mb-0 handmade_price">RS.{{ $handmadeproduct->price }}</p>
                                            <p class="handmade_created_at mb-1 text-muted" style="font-size: 0.75rem;">Add on: {{ $handmadeproduct->created_at }}</p>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                      </div>
                  </div>
              </div>
          </div>      
      </div>
  </div>
  <!-- handmade Shop End-->

 <!-- JavaScript for Search Functionality -->
<script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const vegetables = document.querySelectorAll('.vegetable-item');

        vegetables.forEach(vegetable => {
            const name = vegetable.querySelector('.vegitable-name').textContent.toLowerCase();
            const description = vegetable.querySelector('.vegitable-description').textContent.toLowerCase();
            const price = vegetable.querySelector('.vegitable-price').textContent.toLowerCase();
            const created_at = vegetable.querySelector('.vegitable-created-at').textContent.toLowerCase();
            if (name.includes(filter) || description.includes(filter) || price.includes(filter) || created_at.includes(filter)) {
                vegetable.style.display = '';
            } else {
                vegetable.style.display = 'none';
            }
        });
    });
</script>
<!-- Search Functionality Script -->
<script>
    document.getElementById('fruitSearch').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const fruits = document.querySelectorAll('.fruit-item');

        fruits.forEach(fruit => {
            const fruitname = fruit.querySelector('.fruit_name').textContent.toLowerCase();
            const fruitdescription = fruit.querySelector('.fruit_description').textContent.toLowerCase();
            const fruitprice = fruit.querySelector('.fruit_price').textContent.toLowerCase();
            const fruitcreated = fruit.querySelector('.fruit_created_at').textContent.toLowerCase();

            if (fruitname.includes(filter) || fruitdescription.includes(filter) || fruitprice.includes(filter) || fruitcreated.includes(filter)) {
                fruit.style.display = 'block';
            } else {
                fruit.style.display = 'none';
            }
        });
    });
</script>

<script>
    document.getElementById('clothSearch').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const clothes = document.querySelectorAll('.cloth-item');

        clothes.forEach(cloth => {
            const clothname = cloth.querySelector('.cloth_name').textContent.toLowerCase();
            const clothdescription = cloth.querySelector('.cloth_description').textContent.toLowerCase();
            const clothprice = cloth.querySelector('.cloth_price').textContent.toLowerCase();
            const clothcreated = cloth.querySelector('.cloth_created_at').textContent.toLowerCase();

            if (clothname.includes(filter) || clothdescription.includes(filter) || clothprice.includes(filter) || clothcreated.includes(filter)) {
                cloth.style.display = 'block';
            } else {
                cloth.style.display = 'none';
            }
        });
    });
</script>

<script>
    document.getElementById('handmadeSearch').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const handmades = document.querySelectorAll('.handmade-item');

        handmades.forEach(handmade => {
            const handmadeName = handmade.querySelector('.handmade_name').textContent.toLowerCase();
            const handmadeDescription = handmade.querySelector('.handmade_description').textContent.toLowerCase();
            const handmadePrice = handmade.querySelector('.handmade_price').textContent.toLowerCase();
            const handmadeCreated = handmade.querySelector('.handmade_created_at').textContent.toLowerCase();

            if (handmadeName.includes(filter) || handmadeDescription.includes(filter) || handmadePrice.includes(filter) || handmadeCreated.includes(filter)) {
                handmade.style.display = 'block';
            } else {
                handmade.style.display = 'none';
            }
        });
    });
</script>


<script>
    document.getElementById('productsSearch').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const items = document.querySelectorAll('.vegetable-item, .fruit-item, .cloth-item, .handmade-item');
        
        items.forEach(item => {
            const name = item.querySelector('.vegitable-name, .fruit_name, .cloth_name, .handmade_name')?.textContent.toLowerCase() || '';
            const description = item.querySelector('.vegitable-description, .fruit_description, .cloth_description, .handmade_description')?.textContent.toLowerCase() || '';
            const price = item.querySelector('.vegitable-price, .fruit_price, .cloth_price, .handmade_price')?.textContent.toLowerCase() || '';
            const createdAt = item.querySelector('.vegitable-created-at, .fruit_created_at, .cloth_created_at, .handmade_created_at')?.textContent.toLowerCase() || '';
            
            if (name.includes(filter) || description.includes(filter) || price.includes(filter) || createdAt.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

@endsection