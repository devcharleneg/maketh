<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($customerDir . 'nav.php');


$db->join('product p','p.item_code = c.item_code');
$db->where('username',$_SESSION['username']);
$cart_items = $db->get('cart c',null,'*');

$subtotal = $db->rawQueryOne('SELECT SUM(`total_price`) as subtotal FROM cart WHERE username = "' . $_SESSION['username']. '"');
$subtotal = $subtotal['subtotal'];

$db->where('username',$_SESSION['username']);
$customer = $db->get('user');
$customer = $customer[0];
$fullname = $customer['fname'] . ' ' . $customer['mname'] . ' ' . $customer['lname'];


if(isset($_POST['submitOrder']))
{

	$data = clean_post($_POST,'submitOrder');
	if(empty($data['pin_no']) || $data['mode_of_payment'] == 'Cash on Delivery')
	{
		$credit_card_no = '';
		$pin_no = '';
	}
	else
	{
		$credit_card_no = $data['first_digit'] . '-' . $data['second_digit'] . '-' . $data['third_digit'] . '-' . $data['fourth_digit'];
		$pin_no = $data['pin_no'];
	}
	$data = array(
		'delivery_address' => $data['delivery_address'],
		'mode_of_payment' => $data['mode_of_payment'],
		'credit_card_no' => $credit_card_no,
		'pin_no' => $pin_no,
		'total' => $subtotal + 200,
		'username' => $_SESSION['username']
	);
	$order_no = $db->insert('orders',$data);
	$cart_items_count = count($cart_items);
	$order_items_count = 0;
	if($order_no)
	{
		foreach ($cart_items as $ordered_product) {
			$order = array(
				'order_no' => $order_no,
				'item_code' => $ordered_product['item_code'],
				'ordered_qty' => $ordered_product['qty_in_cart'],
				'total_price' => $ordered_product['total_price']
			);
			if($db->insert('ordered_product',$order))
			{
				$order_items_count += 1;
			}
		}


		if($cart_items_count == $order_items_count)
		{
			$db->where('username',$_SESSION['username']);
			if($db->delete('cart'))
			{	
				echo "<script>alert('Successfully placed your orders. Thank you for shopping!');window.location = 'index.php'</script>";

			}

		}


	}
	// $db->insert('order',$data);
}
?>

<div class="container-fluid">
<h2>Checkout</h2>
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
		    			</tr>
		    		</thead>
		    		<tbody>
		    		<?php foreach ($cart_items as $cart_item): ?>
		    			<tr>
		    				<td><img src="<?= base_url(); ?>shop/uploads/products/<?= $cart_item['item_thumbnail']; ?>" class="img-responsive" width="50px" alt="Image not found"></td>
		    				<td><?= $cart_item['item_name']?></td>
		    				<td><?= $cart_item['brand']?></td>
		    				<td><?= $cart_item['unit_price']?></td>
		    				<td><?= $cart_item['qty_in_cart']?></td>
		    				<td>₱ <?= $cart_item['total_price']?></td>
		    				
		    			</tr>
		    		<?php endforeach ?>
		    			
		    
						<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h6>SubTotal</h6></td>
			    			<td><h6>₱ <?= $subtotal ?></h6></td>
			    		</tr>
						<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h6>Shipping Fee</h6></td>
			    			<td><h6>+ ₱ 200</h6></td>
			    		</tr>

			    		<tr class="total-tr">
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td></td>
			    			<td><h4><b>Total</b></h4></td>
			    			<td><h4><b>₱ <?= $subtotal + 200; ?></b></h4></td>
			    		</tr>

		    		


		    		</tbody>
		    	</table>



		    </div>
		     <div class="row">
		    	<div class="col-xs-8 col-xs-offset-2">
				<form action="checkout.php" method="POST" role="form">
					<legend>Billing Details</legend>
				
					<div class="form-group">
						<label for="">Full Name</label>
						<input type="text" class="form-control" id="" value="<?= $fullname ?>" readonly>
					</div>
					
					<div class="row">
						<div class="col-sm-4">
								<div class="form-group">
			                      <label for="">Contact No</label>
			                      <input type="text" class="form-control" name='contact_no' placeholder='Contact No' value='<?= $customer['contact_no'] ?>' maxlength="20" readonly>
			                  	</div>
						</div>

						<div class="col-sm-8">
								<div class="form-group">
									<label for="">Delivery Address</label>
									<input type="text" name="delivery_address" class="form-control" id="" placeholder="Enter Delivery Address" required>
								</div>	
						</div>
					</div>

					
					<div class="row">
						<div class="col-sm-4">
								<div class="form-group">
									<label for="">Mode of Payment</label>
									<select name="mode_of_payment" id="mode_of_payment" class="form-control" required="required">
										<option value="Cash on Delivery">Cash on Delivery</option>
										<option value="Credit Card">Credit Card</option>
									</select>
								</div>
						</div>
					</div>
				

					<div class="row" id="creditCardForm">
					
						<div class="col-sm-8">
						<label for="">Credit Card Number </label>
							<div class="form-group">

										<div class="col-sm-3">
											<div style="margin-bottom: 0px"></div>
											<input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" placeholder="1234" title="First four digits" id="first_digit" name="first_digit">
										</div>
										<div class="col-sm-3">
											<div style="margin-bottom: 0px"></div>
											<input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" placeholder="5678" title="Second four digits" id="second_digit" name="second_digit">
										</div>
										<div class="col-sm-3">
											<div style="margin-bottom: 0px"></div>
											<input type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" placeholder="5555" title="Third four digits" id="third_digit" name="third_digit">
										</div>
										<div class="col-sm-3">
											<div style="margin-bottom: 0px"></div>
											<input type="password" class="form-control" autocomplete="off" maxlength="4" pattern="\d{4}" placeholder="8888" title="Fourth four digits" id="fourth_digit" name="fourth_digit">

										</div>
							</div>	
						</div>

						<div class="col-sm-4">
								<div class="form-group">
									<label for="">PIN #</label>
									<input type="password" class="form-control" name="pin_no" id="pin_no" placeholder="Enter PIN No" autocomplete="off" maxlength="4" pattern="\d{4}">
								</div>
						</div>
					</div>

					
					<br>
				
					<button type="submit" class="btn btn-success" name="submitOrder">Submit Order</button>
					<a href="cart.php" class="btn btn-danger" name="submitOrder"><i class="fa fa-shopping-cart"></i> Back to Cart</a>
				</form>
		    	
		    	</div>
		    </div>
	<?php else: ?>
		<h5>Your cart is currently empty</h5>
		<a href="index.php" class="btn btn-primary">Return to Shop</a>
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