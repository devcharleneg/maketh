<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include($rootDir . 'templates/header.php');
include($customerDir . 'nav.php'); 

?>


<?php include($shopDir . 'slide.php'); ?>


<script>
  meronUpdate = "<?php if(isset($_GET['update'] )) echo "ITEM-" . sprintf("%06d",$_GET['update']); else ''?>";
  meronDelete = "<?php if(isset($_GET['delete'] )) echo "ITEM-" . sprintf("%06d",$_GET['delete']); else ''?>";
  delete_id = "<?php if(isset($_GET['delete'] )) echo $_GET['delete']; else ''?>"
  update_id = "<?php if(isset($_GET['update'] )) echo $_GET['update']; else ''?>"
</script>
<script src="<?= $customerUrl ?>customer.js"></script>
<?php include($templatesDir . 'footer.php'); ?>

