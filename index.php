<!DOCTYPE html>
<html lang="cs-CZ">
<?php 
// INFORMATIONS
//-------------------------------------------------------------------------------------------------- //
// KyberSoft Simple Website Framework aka. KSSWF
// Version: 0.0.30a
// Made by Nikola Nejedlý | KyberSoft (c) 2017
// Author: http://nejedniko.tk
// Origin: https://github.com/Bunnykillcz/KSSWF
// Last update: 22.10.2017
// License: CC-BY-SA 4.0  (https://creativecommons.org/licenses/by/4.0/legalcode)
//-------------------------------------------------------------------------------------------------- //
// Copy: Nikola Nejedlý
// Purpose: KSSWF 
// Web: http://nejedniko.tk
// Commentary: none
//-------------------------------------------------------------------------------------------------- //


	//Change these settings:
	//----------------------
	$title   = "TITLE";
	$tags    = "tag, tag, tag";
	$favicon = "img/favicon.ico";
	$logo	 = "img/logo.png";
	$logo_url = "index.php";
	$bg_image = "img/bg.png";
	$bg_color = "#5D5D5D";
	$template = "templates/orange";
	$foot_copyright = "Nikola Nejedlý | KyberSoft © 2017";


//-------------------------------------------------------------------------------------------------- //
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
$after_link  = trim($_SERVER['PHP_SELF']);
$root_link	 = getcwd();
$subtitle 	 = "";
$this_w		 = "";
if(!empty($_GET['w']))
$this_w		 = str_replace(" ","+", $_GET['w']);

?>
<head>
<meta charset="UTF-8" />
<?php
include("func/all_loader.php"); 
include("func/setup.php"); 
if($responsive)
	include("func/meta.php"); 
?>
<script src="https://use.fontawesome.com/bd3d370837.js"></script>
<style>
body{
	margin: 0;
<?php echo "background-color: $bg_color;";?>
<?php if(file_exists($bg_image)) echo "background-image: url('$bg_image');"; ?>
}
</style>
<?php
if(!file_exists("./cache/menu.html"))
{
	include("func/gen_menu.php");
	header('location:'.$addr."?w=home&s=1");
}

get_title();
?>
</head>
<body>
<?php 

include("parts/header.php");
if(file_exists("./cache/menu.html"))
	include("./cache/menu.html");
include("parts/body.php");

include("parts/footer.php");
include("./func/js_load.php");

include("parts/admin_login.php");
?>
</body> 