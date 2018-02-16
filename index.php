<!DOCTYPE html>
<html lang="cs-CZ">
<?php 
// INFORMATIONS
//-------------------------------------------------------------------------------------------------- //
// KyberSoft Simple Website Framework aka. KSSWF
// Version: 0.1.27a
// Made by Nikola Nejedlý | KyberSoft (c) 2017
// Author: http://nejedniko.tk
// Origin: https://github.com/Bunnykillcz/KSSWF
// Last update: 11.02.2018
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
	$description = "This site is abooout...";
	$tags    = "tag, tag, tag"; //default keywords
	$author  = "Nikola Nejedlý"; //web developer = you ?
	$favicon = "img/favicon.ico";
	$logo	 = "img/logo.png";
	$logo_url = "index.php";
	$bg_image = "img/bg.png";
	$bg_color = "#5D5D5D";
	$template = "templates/orange";
	$foot_copyright = "Nikola Nejedlý | KyberSoft © 2017-2018";


//-------------------------------------------------------------------------------------------------- //
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
$after_link  = trim($_SERVER['PHP_SELF']);
$root_link	 = getcwd();
$subtitle 	 = "";
$this_w		 = "";
$endclude 	 = "";
if(!empty($_GET['w']))
$this_w		 = str_replace(" ","+", $_GET['w']);

session_start();
include("./func/all_loader.php"); 
include("./func/setup.php"); 
?>
<head>
<meta charset="UTF-8"/>
<meta name="description" content="<?php echo $description.':'.$subtitle;?>">
<meta name="keywords" content="<?php echo $tags;?>">
<meta name="author" content="<?php echo $author;?>">
<?php
if($responsive)
	include("./func/meta.php");

include("./func/js_load.php");
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
	include("./func/gen_menu.php");
	header('location:'.$addr."?w=home&s=1");
}

get_title(true);
?>
</head>
<body>
<?php 

include("./parts/header.php");
if(file_exists("./cache/menu.html"))
	include("./cache/menu.html");
include("./parts/body.php");

include("./parts/footer.php");

file_put_contents("./cache/endclude.html" , $endclude);
include("./cache/endclude.html");

include("./parts/admin_login.php");
?>
</body> 