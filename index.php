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
// Version: 0.0.1 
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
$template = "templates/default";  //used for styling web

//----------------------



echo "<title>$title</title>"; 
include("func/icons.php");
include("func/links.php");
?>
<style>
body{
<?php echo "background-color: $bg_color;";?>
<?php if(file_exists($bg_image)) echo "background-image: url('$bg_image');"; ?>
}
</style>
</head>
<body>
<?php 
/* TESTING START
icon("globe", 0);
// TESTING END */


#include("parts/header.php");
#include("parts/body.php");

?>
</body>
<footer>
<?php
#include("parts/footer.php");
?>
</footer>