<?php 
// session_start();
// if(isset($_SESSION['loggedin']))
// {
//   if($_SESSION['loggedin'] == 'manager')
//   {
//     header('location: /sims/manager/');
//   }
//   elseif($_SESSION['loggedin'] == 'cashier')
//   {
//     header('location: /sims/cashier/');
//   } 
// }
// else
// {
//   header('location: /sims/index.php'); 
// }
?>
<?php include '../../config.php'; ?>
<?php include '../../templates/header.php'; ?>
<?php include 'nav.php'; ?>

<?php 
$search = "";
$q = mysqli_query($db,"SELECT * FROM product");
?>


<div class="container container-bg">
	<div class="row">
		<div class="col-sm-12">
			<div class="row" style="margin-bottom:5px;margin-top:5px;">
        <div class="col-sm-5">
              <button type="button" class="btn btn-success" id="addProductBtn"><i class="fa fa-plus"></i> Add New Product</button>
        </div>
				<form action="products.php" method="POST">
						<div class="col-sm-5">
							<input type="search" name="searchQuery" id="input" class="form-control" placeholder="Search Product" value="<?= $search ?>">	
						</div>
					
						<div class="col-sm-2">
								<button type="submit" class="btn btn-danger" name="searchItem">
									<i class="glyphicon glyphicon-search"></i> Search
								</button>
						</div>
				</form>
			</div><!-- add btn search btn row -->

			<table class="table table-condensed table-hover table-striped">
				<thead>
					<tr class="active">
    						<th>ITEM CODE</th>
    						<th>NAME</th>
    						<th>BRAND</th>
    						<th>COLOR</th>
    						<th>SIZE</th>
    						<th>QTY</th>
    						<th>PRICE</th>
    						<th>OPTION</th>
					</tr>
				</thead>
				<tbody>
					<?php while($product = mysqli_fetch_assoc($q)): ?>
					<tr>
    						<td>ITEM-<?= $product['item_code'] ?></td>
    					<!-- 	<td><img src="<?= base_url(); ?>uploads/<?= $product['Filename']; ?>" class="img-responsive" width="50px" alt="Image"></td> -->
    						<td><?= $product['item_name'] ?></td>
    						<td><?= $product['brand'] ?></td>
    						<td><?= $product['color'] ?></td>
    						<td><?= $product['size'] ?></td>
    						<td><?= $product['qty'] ?></td>
    						<td>₱ <?= $product['unit_price'] ?></td>
    						<td>
                  <a href='products.php?update=<?= $product['ProdNo']; ?>&updateitemn=<?= $product['ProdName']; ?>' id='updateProductBtn' class="btn btn-sm btn-primary"> <i class="fa fa-pencil"></i></a>
                  <a href='products.php?delete=<?= $product['item_code'] ?>' id='updateProductBtn' class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
                </td>
					</tr>
					<?php endwhile ?>
					<?php if (mysqli_num_rows($q) == 0): ?>
						<tr>
  							<td></td>
  							<td></td>
  							<td></td>
  							<td></td>
  							<td><h5>No Result</h5></td>
  							<td></td>
  							<td></td>
  							<td></td>
  							<td></td>
						</tr>
					<?php endif ?>
				</tbody>
				
			</table><!-- product list table -->
		</div><!-- PRODUCTS COL -->
	</div><!-- PRODUCTS ROW -->
</div><!-- PRODUCTS CONTAINER -->


<!-- ADD PRODUCT FORM Modal -->
<div class="modal fade" id="addProductFormModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <!-- <div class="modal-header">
        
        <h4 class="modal-title">Add New Product</h4>
      </div> -->
      <form action="products.php" method='POST' enctype='multipart/form-data' role="form">

            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <legend>Add New Product Form</legend>
                    
                    <div class="form-group">
                        <label for="exampleInputFile">Select Photo</label>
                        <input type="file" name="file" id="file" class="btn btn-sm btn-default" required title="Please select an image">
                        <p class="help-block">Image files are only allowed (jpeg,jpg,png)</p>
                    </div><!-- product photo -->

                    <div class="form-group">
                        <div class="row">
                              <div class="col-sm-4">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name='itemn' placeholder='Enter product name' value='' required>
                              </div>
                              <div class="col-sm-4">
                                    <label for="">Product Price</label>
                                    <div class="input-group">
                                      <div class="input-group-addon"><b>₱</b></div>
                                      <input type='number' class="form-control" min='10' step='any' name='itemp' placeholder='Price' value='' required>
                                      <!-- <div class="input-group-addon">.00</div> -->
                                    </div>
                              </div>
                              <div class="col-sm-4">
                                    <label for="">Product Qty</label>
                                    <input type='number' class="form-control" min='10' name='itemq' placeholder='Quantity' value='' required>
                              </div>
                        </div>
                    </div><!-- product name -->
                    
                    <div class="form-group">
                      <div class="row">
                          
                          <div class="col-sm-4">
                                <label for="">Product Category</label>
                                <select name="cat" class="form-control" required>
                                      <option value="Makeup">Makeup</option>
                                      <option value="Hair">Hair</option>
                                      <option value="Bath">Bath</option>
                                      <option value="Fragrance">Fragrance</option>
                                      <option value="Others">Others</option>
                                </select>
                          </div>
                      </div><!-- row price qty category -->
                    </div><!-- product price qty category -->
        
                    <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="desc" class="form-control" rows="3" placeholder="Product Description" required></textarea>
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


<!-- UPDATE PRODUCT FORM Modal -->
<div class="modal fade" id="updateProductFormModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <!-- <div class="modal-header">
        
        <h4 class="modal-title">Add New Product</h4>
      </div> -->
      <form action="products.php" method='POST' enctype='multipart/form-data' role="form">

            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <legend>Update Product Form</legend>
                    <div class="form-group">
                        <label for="">Product ID</label>
                        <input type="text" class="form-control" name='pno' value='<?= $pno ?>' readonly>
                    </div><!-- product id-->

                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" name='itemn' placeholder='Enter product name' value='<?= $itemn ?>' required>
                    </div><!-- product name -->
                    
                    <div class="form-group">
                      <div class="row">
                          <div class="col-sm-4">
                                <label for="">Product Price</label>
                                <div class="input-group">
                                  <div class="input-group-addon"><b>₱</b></div>
                                  <input type='number' class="form-control" min='10' step='any' name='itemp' placeholder='Price' value='<?= $itemp ?>' required>
                                  <!-- <div class="input-group-addon">.00</div> -->
                                </div>
                          </div>
                          <div class="col-sm-4">
                                <label for="">Product Qty</label>
                                <input type='number' class="form-control" min='10' name='itemq' value="<?= $itemq ?>" placeholder='Quantity' value='' readonly>
                          </div>
                          <div class="col-sm-4">
                                <label for="">Product Category</label>
                                <select name="cat" class="form-control" required>
                                      <option <?php if($cat == 'Makeup'){ echo "selected"; } ?> value="Makeup">Makeup</option>
                                      <option <?php if($cat == 'Hair'){ echo "selected"; } ?> value="Hair">Hair</option>
                                      <option <?php if($cat == 'Bath'){ echo "selected"; } ?> value="Bath">Bath</option>
                                      <option <?php if($cat == 'Fragrance'){ echo "selected"; } ?> value="Fragrance">Fragrance</option>
                                      <option <?php if($cat == 'Others'){ echo "selected"; } ?> value="Others">Others</option>
                                </select>
                          </div>
                      </div><!-- row price qty category -->
                    </div><!-- product price qty category -->
        
                    <div class="form-group">
                                <label for="">Product Description</label>
                                <textarea name="desc" class="form-control" rows="3" placeholder="Product Description" required><?= $desc ?></textarea>
                    </div><!-- product description -->

                    <div class="form-group">
                          <div class="row">
                                <div class="col-sm-6">
                                      <label for="">Expiration Date</label>
                                      <input type="text" class='datepicker' name='expirationDate' value='<?= $uexpDate ?>' placeholder='Select Expiration Date' required />
                                </div><!-- expiration date -->
                                <div class="col-sm-6">
                                      <label for="">Supplier</label>
                                      <select name='supplier' class="form-control" required>
                                      <?php $res = mysqli_query($db,"SELECT * FROM supplier"); ?>
                                      <?php while($suplr = mysqli_fetch_assoc($res)): ?>
                                           <option <?php if($suplrID == $suplr['SupplierID']){ echo "selected"; } ?> value="<?= $suplr['SupplierID']; ?>"><?= $suplr['SuplrName'] ?></option>
                                      <?php endwhile ?>
                                      </select>
                         
                                </div><!-- supplier -->
                          </div>
                    </div><!-- exp date supplier -->

                    <input type="submit" name='update_product' class="btn btn-lg btn-primary btn-block" value="Update Product"></input>
            </div><!-- modal -->
            <div class="modal-footer">
              <!-- 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
      </form>
    </div><!-- modal content -->
    
  </div><!-- modal dialog -->
</div><!-- modal -->



























<script src="<?= $adminUrl ?>admin.js"></script>
<?php include '../../templates/footer.php' ?>

