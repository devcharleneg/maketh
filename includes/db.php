<?php 

require_once($rootDir . 'libraries/MysqliDb.php');
$db_config = array(
		'name' => 'u949314442_maket',		
		'host' => 'mysql.hostinger.ph',
		'user' => 'u949314442_root',
		'pass' => 'maketh'
);

if($_SERVER['HTTP_HOST'] == 'localhost')
{
	$mysqli=mysqli_connect("localhost","root","","maketh");
	$db = new MysqliDb ($mysqli);
	if(!$db){
		die("Database Connection FAILED:".mysqli_error());
	}
}
else
{

	$mysqli=mysqli_connect($db_config['host'],$db_config['user'],$db_config['pass'],$db_config['name']);
	$db = new MysqliDb ($mysqli);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to mysqli: " . mysqli_connect_error();
	  }
}

