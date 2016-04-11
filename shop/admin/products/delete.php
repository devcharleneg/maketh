<div class="modal fade"  id="deleteProductModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body">
       
        <div class="row">
            <div class="col-12-xs text-center">
             <p>Are you sure you want to delete <span id="item"></span>?</p>
          
               <form action="" method="POST" id="deleteForm">
                 
                    <button type="submit" class="btn btn-success btn-md" name="confirm_delete">Yes</button>
                    <button class="btn btn-danger btn-md" data-dismiss="modal">No</button>

               </form>
                
            </div>
        </div>
      </div>
   
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->