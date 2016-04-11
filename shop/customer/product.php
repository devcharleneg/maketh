<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($customerDir . 'nav.php');

$db->where('item_code',$_GET['id']);
$products = $db->get('product');

$product = $products[0];
$db->where('item_code',$_GET['id']);
$product_images = $db->get('product_image');

if(isset($_POST['add_to_cart']))
{

	$db->where('item_code',$product['item_code']);
	$db->where('username',$_SESSION['username']);
	$in_cart = $db->get('cart');

	//pag meron na sa cart iuupdate na lang niya yun nasa cart table
	if(count($in_cart) > 0)
	{
		$subtotal = $_POST['qty_in_cart'] * $product['unit_price'];
		$item_code = sprintf('%06d',$product['item_code']);
		$data = array(
			'qty_in_cart' => $in_cart[0]['qty_in_cart'] +  $_POST['qty_in_cart'],
			'total_price' => $in_cart[0]['total_price'] + $subtotal
		);
		$data = clean_post($data,'');
		$db->where('item_code',$product['item_code']);
		$db->where('username',$_SESSION['username']);
		if($db->update('cart',$data))
		{
			$data = array(
				'qty' => ($product['qty'] - $_POST['qty_in_cart'])
			);
			$db->where('item_code',$product['item_code']);
			if($db->update('product',$data))
			{
				echo "<script>alert('Successfully added to cart');window.location = './product.php?id={$product['item_code']}'</script>";
			}
		}
	}

	//pag wala pa sa cart
	else
	{	

		$subtotal = $_POST['qty_in_cart'] * $product['unit_price'];
		$item_code = sprintf('%06d',$product['item_code']);
		$data = array(
			'username' 	=> $_SESSION['username'],
			'item_code' => $item_code,
			'qty_in_cart' => $_POST['qty_in_cart'],
			'total_price' => $subtotal
		);

		$data = clean_post($data,'');

		if($db->insert('cart',$data))
		{
			$data = array(
				'qty' => ($product['qty'] - $_POST['qty_in_cart'])
			);
			$db->where('item_code',$product['item_code']);
			if($db->update('product',$data))
			{
				echo "<script>alert('Successfully added to cart');window.location = './product.php?id={$product['item_code']}'</script>";
			}
			
		}
	}




	

}
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
					<?php if ($product['qty'] > 0): ?>
						<div class="product-stock">Available Stock: <?= $product['qty'] ?></div>
						<div class="btn-group cart">
							<form action="product.php?id=<?= $product['item_code'] ?>" method="POST" class="form-inline" role="form">
							
								<div class="form-group">
									<label class="sr-only" for="">label</label>
									
									<input type="number" name="qty_in_cart"  class="form-control" placeholder="Qty" min="1" max="<?= $product['qty'] ?>" step="" required="required"  style="width: 100px">
						

								</div>
							
								
							
								<button type="submit" name="add_to_cart" class="btn btn-success"><i class="fa fa-cart-plus"></i> Add to Cart</button>
							</form>
						</div>
					<?php else: ?>
						<div class="product-stock" style="color: red">Out of Stock</div>
					<?php endif ?>
					
		
					<a href="register.php" class="btn btn-primary" id="signUpOrder">Sign Up to Order</a>
					
					
				</div>
			</div> 
		</div>
	
	</div>
</div>
<script>
	var isloggedIn = <?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo ''; ?>
</script>
<script src="customer.js"></script>

<?php include($templatesDir . 'footer.php');?>