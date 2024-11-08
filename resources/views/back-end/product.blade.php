@extends('back-end.components.master')
@section('contens')

      {{-- Modal create start --}}
      @include('back-end.messages.product.create')
      {{-- Modal create end --}}

      {{-- Modal edit start --}}
      @include('back-end.messages.product.edit')
      {{-- Modal edit start --}}

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Products</h3>
                <p onclick="handleClickOnButtonNewProduct()" data-bs-toggle="modal" data-bs-target="#modalCreateProduct" class="card-description btn btn-primary ">new product</p>
            </div>
            <table class="table table-striped mb-3">
              <thead>
                <tr> 
                  <th>Product ID</th>
                  <th>Product Image</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Stock</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="products_list">
                 
              </tbody>

            </table>
            <div class="d-flex justify-content-between align-items-center">

                <div class="show-page mt-3">

                </div>

                <button onclick="" class=" btn btn-outline-danger rounded-0 btn-sm">refresh</button>

            </div>
          </div>
        </div>
      </div>
@endsection
@section('scripts')
<script>

  $(document).ready(function () {

      $('#color_add').select2({  
          placeholder: 'Select options',  
          allowClear: true,  
          tags: true, 
      }); 

      $('#color_edit').select2({  
          placeholder: 'Select options',  
          allowClear: true,  
          tags: true, 
      }); 
  });


  const ProductList = () => {
    $.ajax({
      type: "POST",
      url: "{{ route('product.list') }}",
      dataType: "json",
      success: function (response) {
        if(response.status == 200){
          let products = response.products;
          let tr = '';
          $.each(products, function (key, value) {
            tr += `
                <tr>
                    <td>P${value.id}</td>
                    <td>
                       <img src='{{ asset('uploads/product/${value.images[0].image}') }}'/>
                    </td>
                    <td>${value.name}</td>
                    <td>${value.categories.name}</td>
                    <td>${value.brands.name}</td>
                    <td>$${value.price}</td>
                    <td>${value.qty}</td>
                    <td>
                       <span class='p-1 badge ${value.qty > 1 ? 'badge-success' : 'badge-danger'}'>
                         ${value.qty > 1? 'In Stock' : 'Out Stock' }
                       </span> 
                   </td>
                    <td>
                        <span class="badge ${(value.status == 1)  ? 'badge-success' : 'badge-danger' }  p-1">
                          ${(value.status == 1) ? 'Active' : 'Inactive' }
                        </span>
                    </td>
                    <td>
                        <button onclick="edit(${value.id})" type="button" class=" btn btn-info  btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            `;
          })

          $(".products_list").html(tr);
        }
      }
    });
  }

  ProductList();

  const handleClickOnButtonNewProduct = () => {
     $.ajax({
      type: "POST",
      url: "{{ route('product.data') }}",
      dataType: "json",
      success: function (response) {
        if(response.status == 200){

            //Categories start
            let categories = response.data.categories;
            let cate_option = ``;
            $.each(categories, function (key, value) { 
              cate_option += `
                 <option value="${value.id}">${value.name}</option>
              `;
            });

            $('.category_add').html(cate_option);
            //Categories end

            //Brands Start
            let brands = response.data.brands;
            let brand_option = ``;
            $.each(brands, function (key, value) { 
              brand_option += `
                 <option value="${value.id}">${value.name}</option>
              `;
            }); 
            $('.brand_add').html(brand_option);
            //Brands end

            //Colors Start
            let colors = response.data.colors;
            let color_option = ``;
            $.each(colors, function (key, value) { 
              color_option += `
                 <option value="${value.id}">${value.name}</option>
              `;
            }); 

            $('.color_add').html(color_option);


            


            //Colors end
        }
      }
     });
  }


  const ProductUpload = (form) => {
    let payloads = new FormData($(form)[0]);
    $.ajax({
      type: "POST",
      url: "{{ route('product.uploads') }}",
      data: payloads,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
         if(response.status == 200){
             Message(response.message);

             let images = response.images;
             let img = ``;
             $.each(images, function (key, value) { 
                  img = `
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <input type="hidden" name="image_uploads[]" value="${value}">
                        <img class="w-100" src="{{ asset('uploads/temp/${value}') }}">
                        <button onclick="ProductCancelImage(this,'${value}')" type="button" class="btn btn-danger btn-sm ">cancel</button>
                    </div>
                  `;

                $('.show-images').append(img);

             });

             $('#upload_image').val("");


             
             
         }
      }
    });
  }

  const ProductCancelImage = (e,image) => {

    if(confirm("Do you want to cancel ?")){
      $.ajax({
        type: "POST",
        url: "{{ route('product.cancel') }}",
        data: {
          "image" : image
        },
        dataType: "json",
        success: function (response) {
          if(response.status == 200){
            
            Message(response.message);
            $(e).parent().remove();
            
          }
        }
      });
    }
    
  }

  const ProductStore = (form) => {
    let payloads = new FormData($(form)[0]);

    $.ajax({
      type: "POST",
      url: "{{ route('product.store') }}",
      data: payloads,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
         if(response.status == 200){
          $(form).trigger("reset");
          $('.show-images').html(" ");
          $("#modalCreateProduct").modal('hide');
          $('input').removeClass("is-invalid").siblings("p").removeClass('text-danger').text(" ")
          Message(response.message);
          
         }else{ 
            Message(response.message,false);

            if(response.errors.title){
              $('.title_add').addClass("is-invalid").siblings("p").addClass('text-danger').text(response.errors.title)
            }else{
              $('.title_add').removeClass("is-invalid").siblings("p").removeClass('text-danger').text("")
            }

            if(response.errors.price){
              $('.price_add').addClass("is-invalid").siblings("p").addClass('text-danger').text(response.errors.price)
            }else{
              $('.price_add').removeClass("is-invalid").siblings("p").removeClass('text-danger').text("")

            }

            if(response.errors.qty){
              $('.qty_add').addClass("is-invalid").siblings("p").addClass('text-danger').text(response.errors.qty)
            }else{
              $('.qty_add').removeClass("is-invalid").siblings("p").removeClass('text-danger').text("")
            }
         }
      }
    });
  }


  const edit = (id) => {
       $.ajax({
        type: "POST",
        url: "{{ route('product.edit') }}",
        data: {
          'id' : id
        },
        dataType: "json",
        success: function (response) {
          if(response.status == 200){
             
            //categories start
            let categories = response.data.categories;
            let cate_option = ``;
            $.each(categories, function (key, value) { 
              cate_option += `
              <option value="${value.id}" ${(value.id == response.data.product.category_id) ? 'selected' : ''}>
                ${value.name}
              </option>
              `;
            });

            //inner to category edit 
            $('.category_edit').html(cate_option);
            //categories end
          }

          //brands start
          let brands = response.data.brands;
          let brand_option = ``;
          $.each(brands, function (key, value) { 
              brand_option += `
              <option value="${value.id}" ${(value.id == response.data.product.brand_id)? 'selected' : ''}>
                ${value.name}
              </option>
              `;
          }); 
          //inner to brand edit 
          $('.brand_edit').html(brand_option);
          //brands end


          //colors start
          let colors = response.data.colors;
          let color_ids = response.data.product.color; // 4,2,1
         
          //let find  = array.includes(5)  // => true or false => 1
          let color_option = ``;
          $.each(colors, function (key, value) { 
              if(color_ids.includes(String(value.id))){
                color_option += `
                   <option value="${value.id}" selected >${value.name}</option>
                `;
              }else{
                color_option += `
                  <option value="${value.id}">${value.name}</option>
                `;
              }
          }); 
          //inner to color edit 
          $('.color_edit').html(color_option);
          //colors end


          //Images start
          let images = response.data.productImages;
          let img = ``;
          $.each(images, function (key, value) { 
               img = `
                 <div class="col-lg-4 col-md-6 col-12 mb-3">
                     <input type="hidden" name="image_uploads[]" value="${value.image}">
                     <img class="w-100" src="{{ asset('uploads/product/${value.image}') }}">
                     <button onclick="ProductCancelImage(this,'${value.image}')" type="button" class="btn btn-danger btn-sm ">cancel</button>
                 </div>
               `
             $('.show-images-edit').append(img)
          });

          //Images end


        }
       });
  }


</script>
@endsection