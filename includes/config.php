<?php 
//==================URL includes/HELPERS===========================//
$rootDir = $_SERVER['DOCUMENT_ROOT'] . '/maketh/';
define('HOST',$_SERVER['HTTP_HOST']);
function base_url()
{
	$host_upper = strtolower(HOST . '/maketh/');
	return 'http://' . $host_upper;
}

$adminUrl 		= base_url() . 'shop/admin/';
$customerUrl 	= base_url() . 'shop/customer/';
$shopUrl		= base_url() . 'shop/';

$adminDir		= $rootDir . 'shop/admin/';
$customerDir	= $rootDir . 'shop/customer/';
$shopDir		= $rootDir . 'shop/';
$templatesDir	= $rootDir . 'templates/';

//==================URL includes/HELPERS===========================//	



//include all the other config file
include_once($rootDir . 'includes/db.php');
include_once($rootDir . 'includes/functions.php');
include_once($rootDir . 'includes/session.php');











?>