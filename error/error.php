<!DOCTYPE html>
<!--
Nejedlý Nikola - TUL - [TWS] - 2017
-->
<html lang="cs-CZ">
<head>
<link rel = "stylesheet" type = "text/css" href = "http://nejedniko.wz.cz/TWS/06/web.css" >
<?php
$addr = trim($_SERVER['PHP_SELF']);
$title = "Neznámá chyba!";
$text = "Neznámá chyba.";
$getmypath = $_SERVER['DOCUMENT_ROOT']." -- ".$_SERVER['PHP_SELF'];
$erget = 404;
if(!empty($_GET['er']))
{
	$erget = $_GET['er'];
	if($erget == 404){
	$title = "ERROR 404";
	$text = "Page not found! || Stránka nenalezena!";
	}
	else 
	if($erget == 403){
	$title = "ERROR 403";
	$text = "Forbidden! || Přístup odmítnut!";
	}
	else
	if($erget == 401){
	$title = "ERROR 401";
	$text = "Unauthorized Access! || Neoprávněný přístup!";
	}

}else
{
	header('location:'.$addr."?er=404");
}
?>
<title><?php echo $title; ?></title>
<meta charset='UTF-8'/>
</head>
<body>
<div class="main">
<h1><?php echo $title; ?></h1>
<p><?php echo $text; ?></p>
<?php //echo $getmypath; ?>
<br><br><br>
<a href="http://nejedniko.wz.cz/TWS/06/index.html"><b>index.html</b></a><br>

</div>
</body></html>