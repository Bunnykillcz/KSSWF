<!DOCTYPE html>
<html lang="cs-CZ">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.8">
<script src="https://use.fontawesome.com/bd3d370837.js"></script>
<?php 
// INFORMATIONS
//-------------------------------------------------------------------------------------------------- //
// KyberSoft Simple Website Framework aka. KSSWF
// Version: 0.0.6 
// Made by Nikola Nejedlý | KyberSoft (c) 2017
// Author: http://nejedniko.tk
// Origin: https://github.com/Bunnykillcz/KSSWF
// Last update: 25.09.2017
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
$bg_image = "img/bg.png";
$bg_color = "#5D5D5D";
$template = "templates/default";
$foot_copyright = "Nikola Nejedlý | KyberSoft © 2017";

//----------------------
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
$after_link  = trim($_SERVER['PHP_SELF']);
$root_link	 = getcwd();

echo "<title>$title</title>";
include("func/icons.php");
include("func/links.php");
include("func/rules.php");
include("func/reload_cache.php");
if(!file_exists("./cache/menu.html"))
	include("func/gen_menu.php");
?>
<style>
body{
	margin: 0;
<?php echo "background-color: $bg_color;";?>
<?php if(file_exists($bg_image)) echo "background-image: url('$bg_image');"; ?>
}
.text_area{
	min-height: Calc( 100vh - 120px - 32px - 12px - 3px - 3px );
}
footer{
	posit
	display:block;
	left: 0;
	right: 0;
	bottom: 0;
	width: 100%;
	height: 18px;
	color: white;
	background: linear-gradient(rgba(255,0,0,0), black);
	text-decoration: none;
	padding: 3px 0 0 0;
	margin: 0;
	font-size: 10px;
}
.footing{
	display: inline-block;
	text-align: left;
	width: Calc( 50% - 5% - 5% );
	top: 0;
	float: left;
	padding-left: 5%;
	padding-top: 3px;
}
.KSSWF{
	display: inline-block;
	text-align: right;
	width: Calc( 50% - 5% - 5% );
	top: 0;
	padding-right: 5%;
	padding-top: 3px;
	float: right;
}
.KSSWF a{color: #84D3FF;}
</style>
</head>
<body>
<?php 
/* TESTING START
icon("globe", 0);
// TESTING END */

include("parts/header.php");
if(file_exists("./cache/menu.html"))
	include("./cache/menu.html");
include("parts/body.php");

?>
</body>
<?php
include("parts/footer.php");
?>