<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($adminDir . 'nav.php'); 

if(isset($_POST['add_homepage_images']))
{
    if(count($_FILES['homepageImages'])) {
        $target_dir = $rootDir .'shop/uploads/homepage_images/';
        for ($i=0; $i < count($_FILES['homepageImages']['name']) ; $i++) { 
          $imageName = basename($_FILES['homepageImages']['name'][$i]);
          $ext       = pathinfo($imageName, PATHINFO_EXTENSION);
          $file_path = $target_dir . $imageName;

          if(move_uploaded_file($_FILES['homepageImages']['tmp_name'][$i],$file_path))
          {
                $image_url = 'homepage_images/' . $imageName;

                $image = array(
                  'homepage_image' => $image_url,
                );
               
                if($db->insert('homepage_image',$image))
                {

                }
          } // if naupload image

        } //for loop image
    } //if meron image
}

if(isset($_GET['delete']) && isset($_POST['confirm_delete_image']))
{ 
    $homepage_image_no = $_GET['delete'];
    $db->where('homepage_image_no',$homepage_image_no);
    $image = $db->get('homepage_image');
    $image = $image[0];
    $db->where('homepage_image_no',$homepage_image_no);
    if($db->delete('homepage_image'))
    {
        if(unlink($rootDir . 'shop/uploads/' . $image['homepage_image']))
        {
             echo "<script>alert('Successfully deleted image');window.location = 'index.php'</script>";
        } 
       
    }
    
}

$homepage_images = $db->get('homepage_image');



?>


<div class="container container-bg">
  <div class="row">
  <h3>Content Management</h3>
      <form action="index.php" enctype='multipart/form-data' method="POST">
              <div class="col-sm-4">
                    <label for="exampleInputFile">Select Homepage Photos</label>
                    <input type="file" name="homepageImages[]" id="homepageImages"  multiple="" class="btn btn-sm btn-default" accept=".png, .jpg, .jpeg" title="Please select an image">
                    <p class="help-block">Image files are only allowed (jpeg,jpg,png)</p>
              </div>
              <div class="col-sm-3">
                  <div style="margin-bottom: 25px"></div>
                  <button type="submit" class="btn btn-success" name="add_homepage_images" id="addProductBtn"><i class="fa fa-upload"></i> Upload</button>
              </div>
      </form>
  </div>
  <div class="row">
    <div class="col-sm-12">
          <?php foreach ($homepage_images as $homepage): ?>
                <div class="col-xs-6 col-sm-4 col-md-3 thumbnail">

                      <a href='index.php?delete=<?= $homepage['homepage_image_no'] ?>' id='updateProductBtn' class="btn btn-sm btn-danger pull-right"> <i class="fa fa-times"></i></a>

                    <img src="<?= base_url() . 'shop/uploads/' .$homepage['homepage_image'] ?>" class="img-responsive" alt="Image">
                    
                </div>
          <?php endforeach ?>
    </div><!-- PRODUCTS COL -->
  </div><!-- PRODUCTS ROW -->
</div><!-- PRODUCTS CONTAINER -->

<?php include 'delete.php'; ?>
<script>
    meronUpdate = "";
    meronDelete = "";
    meronImgDelete = "<?php if(isset($_GET['delete'] )) echo $_GET['delete']; else ''?>";
    delete_image_id = "<?php if(isset($_GET['delete'] )) echo $_GET['delete']; else ''?>";
</script>
<script src="<?= $adminUrl ?>admin.js"></script>
<?php include($templatesDir . 'footer.php'); ?>

