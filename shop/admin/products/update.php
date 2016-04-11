<!-- ADD PRODUCT FORM Modal -->
<div class="modal fade" id="updateProductFormModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <form action="" method='POST' enctype='multipart/form-data' role="form" id="updateProductForm">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <legend>Update Existing Product Form</legend>
                   
            
                    <div class="form-group">
                        <div class="row">
                              <!-- <div class="col-sm-4">
                                    <label for="">Item Code</label>
                                    <input type="text" class="form-control" name='item_code' value='<?= 'ITEM-' . sprintf('%06d',$upd_prod['item_code']) ?>' readonly>
                              </div> -->
                              <div class="col-sm-6">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name='item_name' placeholder='Enter product name' value='<?= $upd_prod['item_name'] ?>' required>
                              </div><!-- product name -->
                               <div class="col-sm-6">
                                    <label for="">Brand</label>
                                    <input type="text" class="form-control" name='brand' placeholder='Enter product brand' value='<?= $upd_prod['brand'] ?>' required>
                              </div><!-- brand -->
                        </div><!-- row product name product brand -->
                    </div><!-- product name product brand-->
                    

                    <div class="form-group">
                        <div class="row">
                              <div class="col-sm-6 col-md-4">
                                    <label for="">Product Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>₱</b></div>
                                        <input type='number' class="form-control" min='10' step='any' name='unit_price' placeholder='Price' value='<?= $upd_prod['unit_price'] ?>' required>
                                    </div>
                              </div><!-- product price -->
                              <div class="col-sm-6 col-md-4">
                                    <label for="">Product Qty</label>
                                    <input type='number' class="form-control" min='1' name='qty' placeholder='Qty' value='<?= $upd_prod['qty'] ?>' required>
                              </div><!-- product qty -->
                              <!-- <div class="col-sm-6 col-md-4">
                                    <label for="">Sale Percent</label>
                                    <div class="input-group">
                                        <input type='number' class="form-control" min='0' name='sale_percent' placeholder='Sale %' value='<?= $upd_prod['sale_percent'] ?>'>
                                        <div class="input-group-addon"><b>%</b></div>
                                    </div>
                              </div> -->
                              <!-- sale percent -->                      
                        </div><!-- row price qty percent -->
                    </div><!-- form-group price qty percent -->


                    <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Product Description"><?= $upd_prod['description'] ?></textarea>
                    </div><!-- product description -->

                    

                    <input type="submit" name='update_product' class="btn btn-lg btn-success btn-block" value="Update Product"></input>
            </div><!-- modal -->
            <div class="modal-footer">
              <!-- 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
      </form>
    </div><!-- modal content -->
    
  </div><!-- modal dialog -->
</div><!-- modal -->
