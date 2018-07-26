<!DOCTYPE html>
<html lang="cs-CZ">
<?php 
// INFORMATIONS
//-------------------------------------------------------------------------------------------------- //
// KyberSoft Simple Website Framework aka. KSSWF
// Version: 0.4.60a
// Made by Nikola Nejedlý | KyberSoft (c) 2017-2018
// Author: http://nejedniko.cz
// Origin: https://github.com/Bunnykillcz/KSSWF
// Last update: 17.07.2018
// License: CC-BY-SA 4.0  (https://creativecommons.org/licenses/by/4.0/legalcode)
//-------------------------------------------------------------------------------------------------- //
// Copy: Nikola Nejedlý
// Purpose: KSSWF 
// Web: http://ksswf.nejedniko.cz
// Commentary: none
//-------------------------------------------------------------------------------------------------- //

include("./func/icons.php");

	//Change these settings:
	//----------------------
	$title   		= "KSSWF";
	$description 	= "KSSWF - KyberSoft Simple Web(site) Framework informative web";
	$tags    		= "framework, fw, wf, KSSWF, KyberSoft, nejedniko"; //default keywords
	$author  		= "Nikola Nejedlý"; 
	$favicon 		= "img/favicon.ico";
	$logo	 		= "img/logo.png";
	$logo_url 		= "index.php";
	$bg_image 		= "img/bg.png";
	$bg_color 		= "#5D5D5D";
	$template 		= "templates/orange";
	//disable default template ?
	$disable_default= false;
	$foot_copyright = "Nikola Nejedlý | KyberSoft © 2017-2018";
	$admin_logon_time = 1800; // = 30min
	$admin_create_backups = true;
	//defualt sub-menu symbol (MENU)
	$def_menu_symbol = icon("dropdown",0);
	//defualt 'open in new tab' symbol (MENU)
	$def_oint_symbol = icon("_new",0);

//-------------------------------------------------------------------------------------------------- //
include("initializers.php");
?>
</body> 	