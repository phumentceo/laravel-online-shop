<div class="modal fade" id="modalUpdateColor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width:40%;">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Update Color</h1>
        </div>
        <div class="modal-body">
           <form method="POST" class="formUpdateColor">

                <div class="form-group">
                    <input type="hidden" id="color_id" name="color_id">
                   <label for="">Brand Name</label>
                   <input type="text" name="name" class="name name_edit form-control" id="">
                   <p></p>
                </div>

                <div class="form-group">
                    <label for="">Color</label>
                    <input type="color" name="color_code" class="color_code_update form-control" id="">
                </div>
            
                <div class="form-group">
                  <label for="">Status</label>
                  <select name="status" class="status form-control">
                     <option value="1">Active</option>
                     <option value="0">Block</option>
                  </select>
                  <p></p>
                </div>

           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" onclick="ColorUpdate('.formUpdateColor')" class="btn btn-primary">Update</button>
        </div>
      </div>
    </div>
</div>