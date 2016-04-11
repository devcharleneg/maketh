<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include_once($rootDir . 'includes/config.php');



  $customer = clean_post($_POST,'register');
  $customer['access_type'] = 'customer';
  unset($customer['confirm_password']);

  if($db->insert('user',$customer))
  {
      echo 'inserted';
  }

?>
