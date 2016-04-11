<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($templatesDir . 'nav.php');



//search product
if(isset($_GET['q']))
{
      $q = $_GET['q'];
      $db->where ("(qty > 0 )");
      $db->where ("(item_name like '%{$q}%' )");
      
      $db->orWhere ("((item_code = '{$q}' )");
      $db->orWhere ("(brand like '%{$q}%' )");
      $db->orWhere("(category = '{$q}')");
      $db->orWhere("(sub_category = '{$q}'))");
      $db->where ("(qty > 0 )");
	  $products = $db->get('product');
	  $search = $_GET['q'];
}
elseif(isset($_GET['sex']) && empty($_GET['cat']) && empty($_GET['subcat']) )
{
	$sex = $_GET['sex'];
	$db->where ("(qty > 0 )");
	$db->where("(sex='{$sex}')");	
    $products = $db->get('product');
}
//sex -> cat  for example men -> top
elseif(isset($_GET['sex']) && isset($_GET['cat']))
{
	$sex = $_GET['sex'];
	$cat = $_GET['cat'];
	$db->where ("(qty > 0 )");
	$db->where("(sex='{$sex}')");
    $db->where("(category='{$cat}')");
    $products = $db->get('product');
}
//sex -> subcat for example men -> T-Shirts
elseif(isset($_GET['sex']) && isset($_GET['subcat']))
{
	$sex = $_GET['sex'];
	$subcat = $_GET['subcat'];
	$db->where ("(qty > 0 )");
	$db->where("(sex='{$sex}')");
    $db->where("(sub_category='{$subcat}')");
    $products = $db->get('product');
}

else
{
	$db->where ("(qty > 0 )");
    $products = $db->get('product');
}


?>

<div class="container">
	<?php include($templatesDir . 'left_nav.php'); ?>
	<div class="col-sm-9 product-list">
			<div class="row">
				<?php foreach ($products as $product): ?>
						<a href="product.php?id=<?= $product['item_code'] ?>" style="color: black !important">
								<div class="col-sm-6 col-md-4 well productThumb">
									<div class="row text-center">
										<div class="col-sm-12">
											<img  class="thumbnail" src="<?= base_url(); ?>shop/uploads/products/<?= $product['item_thumbnail']; ?>" width="250px" height="280px" alt="">
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<h4><?= $product['item_name'] ?></h4>
					                        <h6><?= $product['sex'] . '\'s ' ?>
					                         <?=$product['sub_category'] ?></h6>
										</div>
									</div>

									<div class="row pull-right">
										<div class="col-sm-12">
											<h4 style="color: red"><b>₱ <?= $product['unit_price'] ?></b></h4>
											<?php if ($product['old_price'] != 0): ?>
												<h5><s>₱ <?= $product['old_price'] ?></s></h5>
											<?php endif ?>
										</div>
									</div>
								</div>
						</a>
				<?php endforeach ?>

				<?php if (count($products) == 0): ?>
						<div class="text-center">
								<h3>No Results</h3>
						</div>
				<?php endif ?>


			
				
			</div>
	</div>
</div>

<script src="maketh.js"></script>

<?php include($templatesDir . 'footer.php');?>