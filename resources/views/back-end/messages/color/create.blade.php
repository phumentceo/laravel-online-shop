<div class="modal fade" id="modalCreateColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:40%;">
      <div class="modal-content">
        <div class="modal-header">
<<<<<<< HEAD
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Brand</h1>
=======
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create Color</h1>
>>>>>>> master
        </div>
        <div class="modal-body">
           <form method="POST" class="formCreateColor" enctype="multipart/form-data">

                <div class="form-group">
                   <label for="">Color Name</label>
                   <input type="text" name="name" class="name form-control" id="">
                   <p></p>
                </div>

                <div class="form-group">
                    <label for="">Color</label>
<<<<<<< HEAD
                    <input type="color" name="color_code" class="color_code form-control" id="">
                 </div>
=======
                    <input type="color" name="color" class="name form-control" id="">
                </div>
                
>>>>>>> master

                <div class="form-group">
                  <label for="">Status</label>
                  <select name="status" class="status form-control">
                     <option value="1">Active</option>
<<<<<<< HEAD
                     <option value="0">Block</option>
=======
                     <option value="0">Inactive</option>
>>>>>>> master
                  </select>
                  <p></p>
                </div>

           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="ColorStore('.formCreateColor')" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
</div>