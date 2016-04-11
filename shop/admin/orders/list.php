<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($adminDir . 'nav.php'); 

$db->join('user u','u.username = o.username');


if(isset($_POST['view_sale']))
{
   $db->where ("(o.date_ordered like '{$_POST['date_ordered']}%' )");
}

$orders = $db->get('orders o');
if(isset($_POST['view_sale']))
{
   $db->where ("(o.date_ordered like '{$_POST['date_ordered']}%' )");

}
$sum = $db->get('orders o',null,'SUM(total) as total');
$shippingfee = count($orders) * 200;

?>


<div class="container container-bg">
  <div class="row">
    <div class="col-sm-4">
        <form action="list.php" method="POST">
              <input type="text" class="datepicker form control" name="date_ordered" value="<?php if(isset($_POST['date_ordered'])) echo $_POST['date_ordered'] ?>">
              <button type="submit" class="btn btn-primary" name="view_sale"><i class="fa fa-calendar"></i> View</button>
        </form>
    </div>
  
  </div>
  <div class="row">
    <div class="col-sm-12">
    
         <table class="table table-hover">
          <thead>
            <tr class="active">
                  <th>DATE</th>
                  <th>NAME</th>
                  <th>PRODUCTS</th>
                  <th>QTY </th>
                  <th>TOTAL</th>
                 
            </tr>
          </thead>
          <tbody>
          <?php if (isset($_POST['view_sale'])): ?>
            <?php foreach ($orders as $order): ?>
            <tr>
                  <td><?= substr($order['date_ordered'], 0, 10) ?></td>
                  <td><?= $order['fname'] . ' ' . $order['lname'] ?></td>
                  <td>
                        
                            <?php 
                              $db->join('product p','p.item_code = op.item_code');
                              $db->where('order_no',$order['order_no']);
                              $ordered_products = $db->get('ordered_product op'); 
                            ?>
                            <?php foreach ($ordered_products as $ordered_product): ?>
                              <div><?= $ordered_product['item_name'] ?></div>
                            <?php endforeach ?> 
                      
                  </td>
                  <td>
                         
                          <?php 
                            $db->join('product p','p.item_code = op.item_code');
                            $db->where('order_no',$order['order_no']);
                            $ordered_products = $db->get('ordered_product op'); 
                          ?>
                          <?php foreach ($ordered_products as $ordered_product): ?>
                            <div><?= $ordered_product['ordered_qty'] ?></div>
                          <?php endforeach ?> 
                      
                  </td>
                  <td>
                        
                          <?php 
                            $db->join('product p','p.item_code = op.item_code');
                            $db->where('order_no',$order['order_no']);
                            $ordered_products = $db->get('ordered_product op'); 
                          ?>
                          <?php foreach ($ordered_products as $ordered_product): ?>
                            <div>₱ <?= $ordered_product['total_price'] ?></div>
                          <?php endforeach ?> 
                      
                  </td>
            </tr>
            <?php endforeach ?>
            <?php if (count($orders) == 0): ?>
              <tr>
                <td></td>
                <td></td>
                <td><h5>No Orders on this date</h5></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            <?php endif ?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>Subtotal</td>
              <?php if ($sum[0]['total'] == NULL): ?>
                <td>₱ 0.00</td>
              <?php else: ?>
                <td>₱ <?= $sum[0]['total'] - $shippingfee ?></td>
              <?php endif ?>
            </tr>
            
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>Shipping Fee (200 x <?= count($orders) ?>)</td>
              <td>₱ <?= $shippingfee ?></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><h4><b>Total</b></h4></td>
              <td><h4><b>₱ <?=  $sum[0]['total'] ?></b></h4></td>
            </tr>
            <?php else: ?>
          
              <tr>
                <td></td>
                <td></td>
                <td><h4>Please select date</h4></td>
                <td></td>
                <td></td>
              </tr>
            <?php endif ?>
     
            </tbody>
            
          </table><!-- product list table -->
      

 
    </div><!-- PRODUCTS COL -->
  </div><!-- PRODUCTS ROW -->
</div><!-- PRODUCTS CONTAINER -->



<script>
meronUpdate = '';
meronDelete = '';
meronImgDelete = '';
</script>
<script src="<?= $adminUrl ?>admin.js"></script>
<?php include($templatesDir . 'footer.php'); ?>

