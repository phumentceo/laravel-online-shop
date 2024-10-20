@extends('back-end.components.master')
@section('contens')

      {{-- Modal create start --}}
      @include('back-end.messages.category.create')
      {{-- Modal create end --}}

      {{-- Modal edit start --}}
      @include('back-end.messages.category.edit')
      {{-- Modal edit start --}}

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Category</h3>
                <p data-bs-toggle="modal" data-bs-target="#modalCreateCategory" class="card-description btn btn-primary ">new category</p>
            </div>
            <table class="table table-striped">
              <thead>
                <tr> 
                  <th>Category ID</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="category_list">
                
              </tbody>

            </table>
          </div>
        </div>
      </div>
@endsection
@section('scripts')
    <script>
        const UploadImage = (form) => {
            let payloads = new FormData($(form)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('category.upload') }}",
                data: payloads,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == 200){
                        let img = `
                            <img style="width:400px;" src="{{ asset('uploads/temp/${response.image}') }}" >
                            <button type="button" onclick="CancelImage('${response.image}')" class="btn btn_cancle btn-danger rounded-0 btn-sm">cancel</button>
                        `;

                        $(".show-image-category").html(img);

                        // $(form).trigger("reset");
                        $(".image").val("");
                        $(".image").removeClass("is-invalid").siblings('p').removeClass("text-danger").text(" ");
                    }else{
                        $('.image').addClass("is-invalid").siblings('p').addClass("text-danger").text(response.error.image);
                    }
                }
            });
        }

        const CancelImage = (img) => {
            if(confirm("Do you want to cancel image?")){
                $.ajax({
                    type: "POST",
                    url: "{{ route('category.cancel') }}",
                    data: {
                        "image" : img
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            $(".show-image-category").html("");
                            Message(response.message);
                        }
                    }
                });
            }
        }
    </script>
@endsection