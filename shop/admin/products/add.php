<!-- ADD PRODUCT FORM Modal -->
<div class="modal fade" id="addProductFormModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <form action="list.php" method='POST' enctype='multipart/form-data' role="form">
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <legend>Add New Product Form</legend>
                    <div class="form-group">
                        <div class="row">
                              <div class="col-sm-6">
                                    <label for="exampleInputFile">Select Main Photo</label>
                                      <input type="file" name="item_thumbnail" class="btn btn-sm btn-default" accept=".png, .jpg, .jpeg" title="Please select an image" required>
                                      <p class="help-block">Image files are only allowed (jpeg,jpg,png)</p>
                              </div>
                              <div class="col-sm-6">
                                    <label for="exampleInputFile">Select Item Photos</label>
                                      <input type="file" name="productImages[]" id="productImages"  multiple="" class="btn btn-sm btn-default" accept=".png, .jpg, .jpeg" title="Please select an image">
                                      <p class="help-block">Image files are only allowed (jpeg,jpg,png)</p>
                              </div>
                        </div>
                    </div><!-- product photo -->
                 

                    <div class="form-group">
                        <div class="row">
                              <div class="col-sm-6">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name='item_name' placeholder='Enter product name' value='' required>
                              </div><!-- product name -->
                               <div class="col-sm-6">
                                    <label for="">Brand</label>
                                    <input type="text" class="form-control" name='brand' placeholder='Enter product brand' value='' required>
                              </div><!-- brand -->
                        </div><!-- row product name product brand -->
                    </div><!-- product name product brand-->
                    

                    <div class="form-group">
                        <div class="row">
                              <div class="col-sm-6 col-md-4">
                                    <label for="">Product Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>₱</b></div>
                                        <input type='number' class="form-control" min='10' step='any' name='unit_price' placeholder='Price' value='' required>
                                    </div>
                              </div><!-- product price -->
                              <div class="col-sm-6 col-md-4">
                                    <label for="">Product Qty</label>
                                    <input type='number' class="form-control" min='1' name='qty' placeholder='Qty' value='' required>
                              </div><!-- product qty -->
                              <!-- <div class="col-sm-6 col-md-4">
                                    <label for="">Sale Percent</label>
                                    <div class="input-group">
                                        <input type='number' class="form-control" min='0' name='sale_percent' placeholder='Quantity' value=''>
                                        <div class="input-group-addon"><b>%</b></div>
                                    </div>
                              </div> -->
                              <!-- sale percent -->                      
                        </div><!-- row price qty percent -->
                    </div><!-- form-group price qty percent -->

                    <div class="form-group">
                      <div class="row">
                             <div class="col-sm-6 col-md-3">
                                <label for="">Size </label>
                                <select name="size" class="form-control" required>
                                      <option value="XS">XS</option>
                                      <option value="S">S</option>
                                      <option value="M">M</option>
                                      <option value="L">L</option>
                                      <option value="XL">XL</option>
                                      <option value="XXL">XXL</option>
                                </select>
                            </div><!-- col size -->
                            <div class="col-sm-6 col-md-4">
                                <label for="">Color </label>
                                <input type="text" class="form-control" name='color' placeholder='Enter product color' value='' required>
                            </div><!-- col color -->
                            <div class="col-sm-6 col-md-5">
                                <label for="">Material </label>
                                <select name="material" class="form-control" required>
                                      <option value="Fabric">Fabric</option>
                                      <option value="Denim">Denim</option>
                                      <option value="Leather">Leather</option>
                                      <option value="Fur">Fur</option>

                                </select>
                            </div><!-- col material -->
                      </div><!-- row size color material -->
                    </div><!-- form-group size color material -->

                    <div class="form-group">
                      <div class="row">
                          <div class="col-sm-6 col-md-4">
                                <label for="">For </label>
                                <select name="sex" id="sex" class="form-control" required>
                                      <option value="Men">Men</option>
                                      <option value="Women">Women</option>
                                </select>
                          </div><!-- col sex -->

                          <div class="col-sm-6 col-md-4">
                                <label for="">Category</label>
                                <select name="category" class="form-control" id="category" required>
                                      <option value="Top">Top</option>
                                      <option value="Bottom">Bottom</option>
                                      <option value="Bag">Bag</option>
                                </select>
                          </div><!-- col category -->

                          <div class="col-sm-6 col-md-4">
                                <label for="">Sub-Category</label>
                                <select name="sub_category" id="sub-category" class="form-control" required>
                                      <option value="T-Shirts">T-Shirts</option>
                                      <option value="Polo">Polo</option>
                                      <option value="Longsleeves">Longsleeves</option>
                                </select>
                          </div><!-- col sub-category -->
                      </div><!-- row sex category sub-category -->
                    </div><!-- form-group sex category sub-category -->
        
                    <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Product Description"></textarea>
                    </div><!-- product description -->

                    

                    <input type="submit" name='add_new_product' class="btn btn-lg btn-success btn-block" value="Add Product"></input>
            </div><!-- modal -->
            <div class="modal-footer">
              <!-- 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
      </form>
    </div><!-- modal content -->
    
  </div><!-- modal dialog -->
</div><!-- modal -->
