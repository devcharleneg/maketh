<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($customerDir . 'nav.php');


$db->join('product p','p.item_code = c.item_code');
$db->where('username',$_SESSION['username']);
$cart_items = $db->get('cart c',null,'*');

$subtotal = $db->rawQueryOne('SELECT SUM(`total_price`) as subtotal FROM cart WHERE username = "' . $_SESSION['username']. '"');
$subtotal = $subtotal['subtotal'];



if(isset($_GET['delete']) && isset($_POST['confirm_delete']) && isset($_GET['qty_in_cart']))
{ 
    $item_code = $_GET['delete'];
    $db->where('item_code',$item_code);
    $db->where('username', $_SESSION['username']);
    if($db->delete('cart'))
    {
    	//fetch the item data in product to get the current no of stock
    	$db->where('item_code',$item_code);
    	$product = $db->get('product');
    	$product_qty = $product[0]['qty'];

    	$data = array(
    		'qty' => $product_qty + $_GET['qty_in_cart']
    	);
    	$db->where('item_code',$item_code);
    	if($db->update('product',$data))
    	{
    		 echo "<script>alert('Successfully remove ITEM-". sprintf("%06d",$item_code) ."');window.location = 'cart.php'</script>";
    	}
       
    }    
}

if(isset($_POST['updateItemCart']) && isset($_GET['id']) && isset($_GET['stock_qty']) && isset($_GET['dating_order']))
{

	$item_code = $_GET['id'];
	$data = array(
		'qty_in_cart' => $_POST['qty_cart'],
		'total_price' => $_POST['qty_cart'] * $_GET['unit_price']
	);
	$db->where('item_code',$item_code);
	//update muna si cart
	if($db->update('cart',$data))
	{
		//kunin yun total no of stock. 
    	$total_no_stock = $_GET['dating_order'] + $_GET['stock_qty'];
    	//total no of stock - un bagong order
    	$current_stock_after_update = $total_no_stock - $_POST['qty_cart'];
    	$data = array(
    		'qty' => $current_stock_after_update
    	);
    	$db->where('item_code',$item_code);
    	if($db->update('product',$data))
    	{
    		 echo "<script>alert('Successfully updated order');window.location = 'cart.php'</script>";
    	}	
	}
}
?>

<div class="container-fluid">
<h2>Cart</h2>
    <?php if (count($cart_items) > 0): ?>
    		<div class="table-responsive">
		    	<table class="table table-hover">
		    		<thead>
		    			<tr>
		    				<th>Image</th>
		    				<th>Name</th>
		    				<th>Brand</th>
		    				<th>Unit Price</th>
		    				<th>Qty</th>
		    				<th>Total Price</th>
		    				<th>Option</th>
		    			</tr>
		    		</thead>
		    		<tbody>
		    		<?php foreach ($cart_items as $cart_item): ?>
		    			<tr>
		    				<td><img src="<?= base_url(); ?>shop/uploads/products/<?= $cart_item['item_thumbnail']; ?>" class="img-responsive" width="50px" alt="Image not found"></td>
		    				<td><?= $cart_item['item_name']?></td>
		    				<td><?= $cart_item['brand']?></td>
		    				<td><?= $cart_item['unit_price']?></td>
		    				<td>
								<?php 
									$db->where('item_code',$cart_item['item_code']);
									$stock = $db->get('product');
								 ?>
								<form action="cart.php?id=<?=$cart_item['item_code'] ?>&stock_qty=<?= $stock[0]['qty'] ?>&dating_order=<?= $cart_item['qty_in_cart'] ?>&unit_price=<?= $stock[0]['unit_price'] ?>" method="POST">
		    						<input type="number" name="qty_cart"  class="form-control" placeholder="Qty" min="1" max="<?= $stock[0]['qty'] + $cart_item['qty_in_cart'] ?>" value="<?= $cart_item['qty_in_cart'] ?>"step="" required="required"  style="width: 100px">

		    				</td>
		    				<td>₱ <?= $cart_item['total_price']?></td>
		    				<td>
		    					 <button type="submit" name="updateItemCart" id='updateProductBtn' class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i></button>
		    					 </form>


		                  		<a href='cart.php?delete=<?= $cart_item['item_code'] ?>&qty_in_cart=<?= $cart_item['qty_in_cart'] ?>' id='updateProductBtn' class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
		    				</td>
		    			</tr>
		    		<?php endforeach ?>
		    			
		    
						<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h6>SubTotal</h6></td>
			    			<td><h6>₱ <?= $subtotal ?></h6></td>
			    			<td></td>
			    		</tr>
						<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h6>Shipping Fee</h6></td>
			    			<td><h6>+ ₱ 200</h6></td>
			    			<td></td>
			    		</tr>

			    		<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h4><b>Total</b></h4></td>
			    			<td><h4><b>₱ <?= $subtotal + 200; ?></b></h4></td>
			    			<td></td>
			    		</tr>

		    		


		    		</tbody>
		    	</table>



		    </div>
		     <div class="row">
		    	<div class="col-sm-12">
		    		<div class="pull-left">
		    			<a href="index.php" class="btn btn-primary">Continue Shopping</a>
		    		</div>
		    		<div class="pull-right">
		    			<a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
		    		</div>
		    	</div>
		    </div>
	<?php else: ?>
		<h5>Your cart is currently empty</h5>
		<a href="index.php" class="btn btn-primary">Continue Shopping</a>
    <?php endif ?>
   
</div>



<?php include 'delete_item_cart.php'; ?>
<script>
	meronUpdate = "<?php if(isset($_GET['update'] )) echo "ITEM-" . sprintf("%06d",$_GET['update']); else ''?>";
	meronDelete = "<?php if(isset($_GET['delete'] )) echo "ITEM-" . sprintf("%06d",$_GET['delete']); else ''?>";
	delete_id = "<?php if(isset($_GET['delete'] )) echo $_GET['delete']; else ''?>"
	qty_in_cart = "<?php if(isset($_GET['qty_in_cart'] )) echo $_GET['qty_in_cart']; else ''?>"
	update_id = "<?php if(isset($_GET['update'] )) echo $_GET['update']; else ''?>"
</script>

<script src="customer.js"></script>

<?php include($templatesDir . 'footer.php');?>