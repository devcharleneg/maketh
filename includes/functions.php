<?php 



function clean_post($post,$post_btn)
{
	global $db;
	$data = [];
	foreach ($post as $key => $value) {
		if($key != $post_btn)
		{	
			$data[$key] = $db->escape($value);
		}
     
    }
   	return $data;
}


function remove_dir($path) {
	$files = glob($path . '/*');
	foreach ($files as $file) {
		is_dir($file) ? removeDirectory($file) : unlink($file);
	}
	rmdir($path);
	return;
}