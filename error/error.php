<?php
//---------------------------//
//-- Nejedlý Nikola - 2018 --//
//---------------------------//

//$addr = trim($_SERVER['PHP_SELF']);

$title = "Neznámá chyba!";
$text = "Neznámá chyba.";
$erget = 404;
if(!empty($_GET['er']))
{
	$erget = $_GET['er'];
	if($erget == 404){
	$title = "ERROR 404";
	$text = "Page not found! || Stránka nenalezena!";
	$text .= "<br/><img class='error_img' src='./error/404.png' alt='err404'/>";
	
	}
	else 
	if($erget == 403){
	$title = "ERROR 403";
	$text = "Forbidden! || Přístup odmítnut!";
	$text .= "<br/><img class='error_img' src='./error/403.png' alt='err403'/>";
	
	}
	else
	if($erget == 401){
	$title = "ERROR 401";
	$text = "Unauthorized Access! || Neoprávněný přístup!";
	$text .= "<br/><img class='error_img' src='./error/401.png' alt='err401'/>";
	
	}
	else
	if($erget == 500){
	$title = "ERROR 500";
	$text = "Internal Server Error! || Chyba serveru!";
	$text .= "<br/><img class='error_img' src='./error/500.png' alt='err500'/>";
	
	}

}else
{
	global $actual_link;
	header('location:'.$actual_link."/index.php?er=404");
}
?>
<h1><?php echo $title; ?></h1>
<p><?php echo $text; ?></p>
<br>
<br>
<br>