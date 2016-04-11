<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include_once($rootDir . 'includes/config.php');

$db->where('email',$_GET['email']);
$user = $db->get('user');
echo count($user);
