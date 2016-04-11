<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($templatesDir . 'nav.php');

$db->where('item_code',$_GET['id']);
$products = $db->get('product');

$product = $products[0];
$db->where('item_code',$_GET['id']);
$product_images = $db->get('product_image');
?>

<div class="container-fluid">
    <div class="content-wrapper">	
		<div class="item-container">	
			<div class="container">	
				<div class="col-md-5">
				<div class="row" style="height: 500px">
			        <div class="carousel slide" id="casualCarousel" data-interval="false">
			            <div class="carousel-inner" id="productCarousel">
			                <div class="active item" data-slide-number="0">
			                    <img class="img" src="<?= base_url(); ?>shop/uploads/products/<?= $product['item_thumbnail']; ?>">
			                </div>

			            

			                <?php $i = 1; ?>
				        	<?php for($j = 0; $j < count($product_images);$j++): ?>
				        			<div class="item" data-slide-number="<?= $i ?>">
					                    <img src="<?= base_url(); ?>shop/uploads/products/<?= $product_images[$j]['product_image']; ?>">
					                </div>
						    <?php $i += 1 ?>
				        	<?php endfor ?>
			            </div>
			        </div>
			    </div>
			    <div class="row">
        <ul class="hide-bullets text-center">
        	<li>
		            <a class="thumbnail" data-slide-number="0">
		                    <img class="img" src="<?= base_url(); ?>shop/uploads/products/<?= $product['item_thumbnail']; ?>">
		                </a>
		     </li>
			<?php $i = 1; ?>
        	<?php for($j = 0; $j < count($product_images);$j++): ?>
        			<li>
		                <a class="thumbnail" data-slide-number="<?= $i ?>">
		                    <img src="<?= base_url(); ?>shop/uploads/products/<?= $product_images[$j]['product_image']; ?>">
		                </a>
		            </li>
		            <?php $i += 1 ?>
        	<?php endfor ?>
            
           
        </ul>
    </div>
			
				</div>
					
				<div class="col-md-7">
					<div class="product-title"><?= $product['item_name'] ?></div>
					<div><b>Item Code: </b> <?= 'ITEM-' . sprintf('%06d',$product['item_code']) ?></div>
								
					<div class="product-desc">
								<div><b>Brand: </b> <?= $product['brand'] ?></div>
								<div><b>Size: </b><?= $product['size'] ?></div>
								<div><b>Color: </b><?= $product['color'] ?></div>
								<div><b>Material: </b><?= $product['material'] ?></div>
								<div>
									<b>Description</b>
									<p><?= $product['description'] ?></p>
								</div>
					</div>
				
					<hr>
					<div class="product-price">
						<h4 style="color: red"><b>₱ <?= $product['unit_price'] ?></b></h4>
						<?php if ($product['old_price'] != 0): ?>
								<h5><s>₱ <?= $product['old_price'] ?></s></h5>
						<?php endif ?>
					</div>
					<div class="product-stock">Available Stock: <?= $product['qty'] ?></div>
		
					<a href="register.php" class="btn btn-primary" id="signUpOrder"><i class="fa fa-user-plus"></i> Register to Order</a> or 
					<a href="login.php" class="btn btn-warning" id="signUpOrder"><i class="fa fa-lock"></i>  Login to Order</a> 
					<div class="btn-group cart">
						<form action="" method="POST" class="form-inline" role="form">
						
							<div class="form-group">
								<label class="sr-only" for="">label</label>
								
								<input type="number" name=""  class="form-control" placeholder="Qty" min="1" max="<?= $product['qty'] ?>" step="" required="required"  style="width: 100px">
					

							</div>
						
							
						
							<button type="submit" class="btn btn-success"><i class="fa fa-cart-plus"></i> Add to Cart</button>
						</form>
					</div>
					
				</div>
			</div> 
		</div>
	
	</div>
</div>

<script src="maketh.js"></script>

<?php include($templatesDir . 'footer.php');?>