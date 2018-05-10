<?php
$actual_link 	= (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$after_link  	= trim($_SERVER['PHP_SELF']);
$exploded 		= explode('/',$after_link);
$after_link		= "";
for($i = 0; $i < count($exploded)-1; $i++)
	$after_link = $after_link."/".$exploded[$i];
$after_link[0] = "";
$after_link  	= trim($after_link);
//echo "location:".$actual_link."".$after_link."/admin/index.php";
header("location:".$actual_link."".$after_link."/admin/index.php");
?>