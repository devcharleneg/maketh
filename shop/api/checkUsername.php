<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
include_once($rootDir . 'includes/config.php');

$db->where('username',$_GET['username']);
$user = $db->get('user');
echo count($user);
