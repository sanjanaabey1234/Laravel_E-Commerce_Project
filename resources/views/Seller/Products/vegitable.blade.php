@extends('layouts.user')
@section('showHeroSection', false)

@section('content')

<div class="container">

   <section class="add-product">
      <form action="{{ route('seller.store.vegitable') }}" method="post" class="add-product-form" enctype="multipart/form-data">
         @csrf
         <h3>Add a New Vegetable</h3>
         <input type="text" name="name" placeholder="Enter the product name" class="box" required>
         <input type="text" name="description" placeholder="Enter the product description" class="box" required>
         <input type="text" name="category" value="Vegetables" class="box" readonly>
         <div style="display: flex; align-items: center;">
            <input type="number" id="quantity" name="stock_quantity" min="0" placeholder="Enter quantity" class="box" required style="flex: 1;">
            <input type="text" name="unit" id="unit" class="box" style="margin-left: 6px; width: 70px;" value="kg" readonly>
                
               
        </div>
        
         <input type="number" id="unitPrice" name="price" min="0" placeholder="Enter the product  price" class="box" required>
         <input type="number" id="totalPrice" name="amount" min="0" placeholder="Total amount" class="box" readonly>
         <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" class="box" required>
         <button class="btn-addproduct" type="submit">
            Add Product
         </button>
      </form>
   </section>

   <section class="display-product-table mt-5">
      <h4 class="mb-4 text-center text-primary">Available Fruits</h4>
      <!-- Search Input -->
      <div class="mb-4">
         <input type="text" id="search-input" class="form-control" placeholder="Search fruits by name, description, or other details...">
     </div>
      <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped align-middle shadow-sm">
              <thead class="bg-primary text-white">
                  <tr class="text-center">
                      <th scope="col" class="p-3">Image</th>
                      <th scope="col" class="p-3">Name</th>
                      <th scope="col" class="p-3">Description</th>
                      <th scope="col" class="p-3">Quantity</th>
                      <th scope="col" class="p-3">Unit Price</th>
                      <th scope="col" class="p-3">Total Amount</th>
                      <th scope="col" class="p-3">Date</th>
                      <th scope="col" class="p-3">Actions</th>
                  </tr>
              </thead>
         <tbody id="product-table-body">
            @foreach ($vegitables as $vegetable)
            <tr data-id="{{ $vegetable->vegitable_id }}">
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="product-image"><img src="{{ asset($vegetable->image_path) }}" height="100" alt=""></td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="product-name">{{ $vegetable->vegitable_name }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="product-description">{{ $vegetable->description }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="stock-quantity">{{ $vegetable->stock_quantity }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="product-price">{{ $vegetable->price }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="total-amount">{{ $vegetable->Amount }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;" id="created_at">{{ $vegetable->created_at }}</td>
               <td style="padding: 10px; text-align: center; background-color: #e9ecef; border: 1px solid #dee2e6;">
                  <a href="#" class="fas fa-edit">Edit</a><br><br>
                  <form id="delete-form-{{ $vegetable->vegitable_id }}" action="{{ route('seller.delete.Vegetable', $vegetable->vegitable_id) }}" method="POST" style="display:inline;">
                     @csrf
                     @method('DELETE')
                     <button type="button" class="delete-btn" onclick="confirmDelete({{ $vegetable->vegitable_id }})">Delete</button>
                 </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </section>
   
   <!-- Edit Form Container -->
   <section class="edit-form-container" id="edit-form-container">
   
     
      <form action="{{ route('seller.update.vegitable') }}" method="post" enctype="multipart/form-data">
         
         @csrf
         <h5>Edit Vegetable</h3>
         <input type="hidden" name="vegetable_id" value="">
         <input type="text" name="update_p_name" placeholder="Enter the product name" class="box" required>
         <input type="text" name="update_p_description" placeholder="Enter the product description" class="box" required>
         <input type="text" name="category" value="Vegetables" class="box" readonly>
         <div style="display: flex; align-items: center;">
            <input type="number" id="update_quantity" name="update_p_stock_quantity" min="0" placeholder="Enter the product quantity" class="box" required style="flex: 1;">
            <input type="text" name="unit" id="unit" class="box" style="margin-left: 6px; width: 70px;" value="kg" readonly>
         </div>
         
         <input type="number" id="update_unitPrice" name="update_p_price" min="0" placeholder="Enter the product price" class="box" required>
         <input type="number" id="update_totalPrice" name="update_p_total_price" min="0" placeholder="Total amount" class="box" readonly>
         
         <img src="" height="50" weight="50" alt="" class="product-image-preview">
         <input type="file" name="update_p_image" accept="image/png, image/jpg, image/jpeg" class="box">
         <button type="submit">Update Product</button>
         <button type="button" id="close-edit">Close</button>
      </form>
   </section>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <!-- Toastr Notifications -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   <!-- Custom JS File Link -->
   <script src="{{asset('assets/seller/js/script.js')}}"></script>
   <script>
      // Confirm Delete
       function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "you want to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }
    
   </script>
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         const quantityInput = document.getElementById('quantity');
         const unitPriceInput = document.getElementById('unitPrice');
         const totalPriceInput = document.getElementById('totalPrice');

         function calculateTotalPrice() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            const totalPrice = quantity * unitPrice;
            totalPriceInput.value = totalPrice.toFixed(2);
         }

         quantityInput.addEventListener('input', calculateTotalPrice);
         unitPriceInput.addEventListener('input', calculateTotalPrice);

         const editButtons = document.querySelectorAll('.fas.fa-edit');
         const editFormContainer = document.getElementById('edit-form-container');
         const vegetableIdUpdate = document.querySelector('input[name="vegetable_id"]');
         const updatePName = document.querySelector('input[name="update_p_name"]');
         const updatePDescription = document.querySelector('input[name="update_p_description"]');
         const updatePStockQuantity = document.querySelector('input[name="update_p_stock_quantity"]');
         const updatePPrice = document.querySelector('input[name="update_p_price"]');
         const updatePTotalPrice = document.querySelector('input[name="update_p_total_price"]');
         const updatePImage = document.querySelector('input[name="update_p_image"]');
         const productImagePreview = document.querySelector('.product-image-preview');

         

         function calculateUpdateTotalPrice() {
            const quantity = parseFloat(updatePStockQuantity.value) || 0;
            const unitPrice = parseFloat(updatePPrice.value) || 0;
            const totalPrice = quantity * unitPrice;
            updatePTotalPrice.value = totalPrice.toFixed(2);
         }

         updatePStockQuantity.addEventListener('input', calculateUpdateTotalPrice);
         updatePPrice.addEventListener('input', calculateUpdateTotalPrice);

         // Add event listener to each edit button
         editButtons.forEach(button => {
            button.addEventListener('click', function(event) {
               const row = event.target.closest('tr');
               const vegetableId = row.dataset.id;
               const productName = row.querySelector('#product-name').textContent;
               const productDescription = row.querySelector('#product-description').textContent;
               const productStockQuantity = row.querySelector('#stock-quantity').textContent;
               const productPrice = row.querySelector('#product-price').textContent;
               const productTotalPrice = row.querySelector('#total-amount').textContent;
               const productImage = row.querySelector('#product-image img').src;

               vegetableIdUpdate.value = vegetableId;
               updatePName.value = productName;
               updatePDescription.value = productDescription;
               updatePStockQuantity.value = productStockQuantity;
               updatePPrice.value = productPrice;
               updatePTotalPrice.value = productTotalPrice;
               productImagePreview.src = productImage;

               editFormContainer.style.display = 'flex';
            });
         });

         document.getElementById('close-edit').addEventListener('click', function() {
            editFormContainer.style.display = 'none';
         });
      });
   </script>
   <script>
    // Search functionality
    document.getElementById('search-input').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#product-table-body tr');

        rows.forEach(row => {
            const name = row.querySelector('#product-name').textContent.toLowerCase();
            const description = row.querySelector('#product-description').textContent.toLowerCase();
            const quantity = row.querySelector('#stock-quantity').textContent.toLowerCase();
            const price = row.querySelector('#product-price').textContent.toLowerCase();
            const created_at = row.querySelector('#created_at').textContent.toLowerCase();
            const totalAmount = row.querySelector('#total-amount').textContent.toLowerCase();
            
            if (name.includes(filter) || description.includes(filter) || quantity.includes(filter) || price.includes(filter) || created_at.includes(filter) || totalAmount.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
 </script>


@endsection
