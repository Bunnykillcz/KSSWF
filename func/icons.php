<?php 
//simple icon callers -- returns the whole string with icon requested

$ic_callers_list = ["globe","heart","wpforms","dropdown","_new",
					"link","home","user","left","right","up","down"];

function icon($type, $size)
{
	$icon = "";
	switch($type){
		case "globe":
			$icon = "fa-globe";
			break;
		case "heart":
			$icon = "fa-heart-o";
			break;
		case "wpforms":
			$icon = "fa-wpforms";
			break;
		case "dropdown":
			$icon = "fa-angle-down";
			break;
		case "_new":
			$icon = "fa-external-link";
			break;
		case "link":
			$icon = "fa-link";
			break;
		case "home":
			$icon = "fa-home";
			break;
		case "user":
			$icon = "fa-user";
			break;
		case "left":
			$icon = "fa-arrow-left";
			break;
		case "right":
			$icon = "fa-arrow-right";
			break;
		case "up":
			$icon = "fa-arrow-up";
			break;
		case "down":
			$icon = "fa-arrow-down";
			break;

	}
	$s = 0;
	
	switch($size){
		case 0:
			$s = "fa-lg";
			break;
		case 1:
			$s = "fa-2x";
			break;
		case 2:
			$s = "fa-3x";
			break;
		case 3:
			$s = "fa-4x";
			break;
	}
	
	
	return "<i class='fa $icon $s'></i>";
} 
?>




