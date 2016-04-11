<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($adminDir . 'nav.php'); 

$search = "";
if(isset($_GET['q']))
{
    if($_GET['q'] != '')
    {
      $q = $_GET['q'];
      $db->where ("(item_name like '%{$q}%' )");
      $db->orWhere ("(item_code = '{$q}' )");
      $db->orWhere ("(brand like '%{$q}%' )");
    }
    
    $products = $db->get('product');
    $search = $_GET['q'];
}
else
{
    $products = $db->get('product');
}



if(isset($_POST['add_new_product']))
{ 
      $success = 0;
      $data = clean_post($_POST,'add_new_product');
      $product_insert_id = $db->insert('product', $data);
      if($product_insert_id > 0)
      {
            $item_code = sprintf("%06d",$product_insert_id );
            $target_dir = $rootDir . "shop/uploads/products/" . $item_code . '/';
            if(!file_exists($target_dir))
            {
                mkdir($target_dir,0777,true);
            }// if wala pang folder un product na yun

            //upload the main/thumbnail of item
            if(count($_FILES['item_thumbnail']))
            {   
                    $imageName = basename($_FILES['item_thumbnail']['name']);
                    $ext       = pathinfo($imageName, PATHINFO_EXTENSION);
                    $file_path = $target_dir . 'thumbnail' . '.' . $ext;
                    
                    if(move_uploaded_file($_FILES['item_thumbnail']['tmp_name'],$file_path))
                    {     
                          $image_url = $item_code . '/' . 'thumbnail' . '.' . $ext;
                          echo 'item thumbnail have been uploaded';
                          $thumbnail = array(
                            'item_thumbnail' => $image_url
                          );
                          $db->where('item_code',$item_code);
                          if($db->update('product',$thumbnail))
                          {
                              $success += 1;
                          }
                    } // if naupload image

            } 

            //upload other image of item
            if(count($_FILES['productImages'])) {
              $j = 1;
                  for ($i=0; $i < count($_FILES['productImages']['name']) ; $i++) { 
                    $imageName = basename($_FILES['productImages']['name'][$i]);
                    $ext       = pathinfo($imageName, PATHINFO_EXTENSION);
                    $file_path = $target_dir . $j . '.' . $ext;

                    if(move_uploaded_file($_FILES['productImages']['tmp_name'][$i],$file_path))
                    {
                          $image_url = $item_code . '/' . $j . '.' . $ext;
                          echo 'file have been uploaded';
                          $image = array(
                            'product_image' => $image_url,
                            'item_code' => $item_code
                          );
                         
                          if($db->insert('product_image',$image))
                          {
                            $success += 1;
                            $j += 1;
                          }
                    } // if naupload image

                  } //for loop image
            } //if meron image
            if($success >= 1)
            {
                echo "<script>alert('Successfully deleted product');</script>";
                header('location: /maketh/shop/admin/products/list.php');
            }
      } //if success ang pag insert ng product
}


if(isset($_GET['delete']) && isset($_POST['confirm_delete']))
{ 
    $item_code = $_GET['delete'];
    $db->where('item_code',$item_code);
    if($db->delete('product'))
    {
        remove_dir($rootDir . 'shop/uploads/products/' . sprintf("%06d",$item_code));
        echo "<script>alert('Successfully deleted ITEM-". sprintf("%06d",$item_code) ."');window.location = 'list.php'</script>";
    }
    
}


if(isset($_GET['update']))
{
    $item_code = $_GET['update'];
    $db->where('item_code',$item_code);
    $update_prod = $db->get('product');
    $upd_prod = $update_prod[0];
}


if(isset($_GET['update']) && isset($_POST['update_product']))
{ 
    $item_code = $_GET['update'];
    $data = clean_post($_POST,'update_product');
    if($_GET['old_price'] != $data['unit_price'])
    {
       $data['old_price'] = $_GET['old_price'];
    }
   
    $db->where('item_code',$item_code);
    if($db->update('product',$data))
    {
        echo "<script>alert('Successfully updated ITEM-". sprintf("%06d",$item_code) ."');window.location = 'list.php'</script>";
    }

}


?>


<div class="container container-bg">
  <div class="row">
    <div class="col-sm-12">
      <div class="row" style="margin-bottom:5px;margin-top:5px;">
        <div class="col-sm-5">
              <button type="button" class="btn btn-success" id="addProductBtn"><i class="fa fa-plus"></i> Add New Product</button>
        </div>
        <form action="list.php">
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
              <input type="search" name="q" id="input" class="form-control" placeholder="Search Product" value="<?= $search ?>" required>  
            </div>
            
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">
                  <i class="glyphicon glyphicon-search"></i> 
                </button>
                <button type="submit" class="btn btn-danger" name="q">
                  <i class="fa fa-times"></i> 
                </button>
            </div>
        </form>
      </div><!-- add btn search btn row -->

      <table class="table table-condensed table-hover table-striped">
        <thead>
          <tr class="active">
                <th>IMAGE</th>
                <th>ITEM CODE</th>
                <th>NAME</th>
                <th>BRAND</th>
                <th>SEX</th>
                <th>COLOR</th>
                <th>SIZE</th>
                <th>SUB CATEGORY</th>
                <th>MATERIAL</th>
                <th>QTY</th>
                <th>CURRENT PRICE</th>
                <th>OLD PRICE</th>
                <th>OPTION</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($products as $product): ?>
          <tr>
                <td><img src="<?= base_url(); ?>shop/uploads/products/<?= $product['item_thumbnail']; ?>" class="img-responsive" width="50px" alt="Image not found"></td>
                <td>ITEM-<?= sprintf("%06d",$product['item_code'] ) ?></td>
                <td><?= $product['item_name'] ?></td>
                <td><?= $product['brand'] ?></td>
                <td><?= $product['sex'] ?></td>
                <td><?= $product['color'] ?></td>
                <td><?= $product['size'] ?></td>
                <td><?= $product['sub_category'] ?></td>
                <td><?= $product['material'] ?></td>
                <td><?= $product['qty'] ?></td>
                <td>₱ <?= $product['unit_price'] ?></td>
                <?php if ($product['old_price'] != 0): ?>
                  <td>₱ <?= $product['old_price'] ?></td>
                <?php else: ?>
                  <td>N/A</td>
                <?php endif ?>
                
                <td>
                  <a href='list.php?update=<?= $product['item_code'] ?>&old_price=<?= $product['unit_price'] ?>' id='updateProductBtn' class="btn btn-sm btn-warning"> <i class="fa fa-pencil"></i></a>
                  <a href='list.php?delete=<?= $product['item_code'] ?>' id='updateProductBtn' class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i></a>
                </td>
          </tr>
          <?php endforeach ?>
          <?php if (count($products) == 0): ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><h5>No Result</h5></td>
                <td></td>
                <td></td>
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



<?php include 'add.php'; ?>
<?php include 'update.php'; ?>
<?php include 'delete.php'; ?>
<script>
  meronUpdate = "<?php if(isset($_GET['update'] )) echo "ITEM-" . sprintf("%06d",$_GET['update']); else ''?>";
  meronDelete = "<?php if(isset($_GET['delete'] )) echo "ITEM-" . sprintf("%06d",$_GET['delete']); else ''?>";
  delete_id = "<?php if(isset($_GET['delete'] )) echo $_GET['delete']; else ''?>"
  update_id = "<?php if(isset($_GET['update'] )) echo $_GET['update']; else ''?>"
  old_price = "<?php if(isset($_GET['old_price'] )) echo $_GET['old_price']; else ''?>"
</script>
<script src="<?= $adminUrl ?>admin.js"></script>
<?php include($templatesDir . 'footer.php'); ?>

