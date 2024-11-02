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
                <p data-bs-toggle="modal" data-bs-target="#modalCreateProduct" class="card-description btn btn-primary ">new product</p>
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
              <tbody class="colors_list">
                 <tr>
                    <td>P001</td>
                    <td>image.jpg</td>
                    <td>I phone 13 promax</td>
                    <td>Phone</td>
                    <td>Apple</td>
                    <td>$450</td>
                    <td>10</td>
                    <td>
                        <span class="badge badge-success p-1">In Stock</span>
                        <span class="badge badge-warning  p-1">Low Stock</span>
                    </td>
                    <th>
                        <span class="badge badge-success p-1">Active</span>
                        <span class="badge badge-danger  p-1">Inactive</span>
                    </th>
                    <td>
                        <button type="button" class=" btn btn-info  btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                 </tr>
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
        
      }
    });
  }
</script>
@endsection