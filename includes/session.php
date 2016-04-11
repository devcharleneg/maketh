<?php 

function checkUserAccess($user)
{	
	if(strpos(getcwd(),$user) === false || strpos(getcwd(),$user) == '')
	{
		return -1;
	}
	else
	{
		return strpos(getcwd(),$user);
	}
	
}

session_start();
//if nasa admin page
if(checkUserAccess('admin') > 0)
{
	if(isset($_SESSION['loggedin']))
	{
	  if($_SESSION['loggedin'] == 'customer')
	  {
	    header('location: /maketh/shop/customer/');
	  }
	}
	else
	{
	  header('location: /maketh/shop/'); 
	}
}
//if nasa customer page
elseif(checkUserAccess('customer') > 0)
{
	if(isset($_SESSION['loggedin']))
	{
	  if($_SESSION['loggedin'] == 'admin')
	  {
	    header('location: /maketh/shop/admin');
	  }
	}
	else
	{
	  header('location: /maketh/shop/'); 
	}
}
//if nasa pinakaroot
elseif(checkUserAccess('shop') < 0)
{
	echo 'dito sa labas';
	if(isset($_SESSION['loggedin']))
	{
		if($_SESSION['loggedin'] == 'admin')
		{
			header('location: /maketh/shop/admin/');
		}
		elseif($_SESSION['loggedin'] == 'customer')
		{
			header('location: /maketh/shop/customer/');
		}
	}
	else
	{
	  header('location: /maketh/shop/'); 
	}
}
//if nasa loob ng shop
else
{
	if(isset($_SESSION['loggedin']))
	{
		if($_SESSION['loggedin'] == 'admin')
		{
			header('location: /maketh/shop/admin/');
		}
		elseif($_SESSION['loggedin'] == 'customer')
		{
			header('location: /maketh/shop/customer/');
		}
	}
}


?>