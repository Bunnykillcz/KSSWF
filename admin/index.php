<?php
/*
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER['HTTP_HOST']";
$after_link = trim($_SERVER['PHP_SELF']);
$exploded = explode('/',$after_link);
$after_link	= "";
for($i = 0; $i < count($exploded)-2; $i++)
	$after_link = $after_link."/".$exploded[$i];
$after_link[0] = "";
$after_link  	= trim($after_link);

function redirect($url, $CodeStatus = 303)
{
	header("Location:".$url, true, $CodeStatus);
	die();
}

if(isset($_GET["er"]))
{
	$err = $_GET["er"];
	redirect($actual_link."".$after_link."/index.php?er=$err", true);
}

//echo "location:".$actual_link."".$after_link."/admin/index.php";
redirect($actual_link."".$after_link."/index.php?w=home&a=1", true);*/
?>