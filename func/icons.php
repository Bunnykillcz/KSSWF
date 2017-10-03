<?php 
//simple icon callers -- returns the whole string with icon requested

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




