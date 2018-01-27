<?php 
//simple icon callers -- returns the whole string with icon requested

$ic_callers_list = ["globe","heart","wpforms","dropdown","_new","link","home","user","left","right","up","down","wclose","wclose-o","close","card-o","user-c","ban","bin","bin-o","sign-in","sign-out","warning","info",
"edit","save","file","folder","car","ticket","plane","time_h","html5","building","server","battery0","battery1","battery2","battery3",
"battery4","fork", "star", "star-o", "star-half", "star-half-o", "shield", "bed", "food"];

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
		case "wclose":
			$icon = "fa-window-close";
			break;
		case "wclose-o":
			$icon = "fa-window-close-o";
			break;
		case "close":
			$icon = "fa-times";
			break;
		case "card-o":
			$icon = "fa-address-card-o";
			break;
		case "user-c":
			$icon = "fa-user-circle";
			break;
		case "ban":
			$icon = "fa-ban";
			break;
		case "bin-o":
			$icon = "fa-trash-o";
			break;
		case "bin":
			$icon = "fa-trash";
			break;
		case "sign-in":
			$icon = "fa-sign-in";
			break;
		case "sign-out":
			$icon = "fa-sign-out";
			break;
		case "log-out":
			$icon = "fa-sign-out";
			break;
		case "warning":
			$icon = "fa-exclamation-triangle";
			break;
		case "info":
			$icon = "fa-info-circle";
			break;
		case "edit":
			$icon = "fa-pencil-square";
			break;
		case "save":
			$icon = "fa-floppy-o";
			break;
		case "file":
			$icon = "fa-file";
			break;
		case "folder":
			$icon = "fa-folder";
			break; 
		case "car":
			$icon = "fa-car";
			break;
		case "ticket":
			$icon = "fa-ticket";
			break;
		case "plane":
			$icon = "fa-plane";
			break;
		case "time_h":
			$icon = "fa-hourglass-half";
			break;
		case "html5":
			$icon = "fa-html5";
			break;
		case "building":
			$icon = "fa-building-o";
			break;
		case "server":
			$icon = "fa-server";
			break;
		case "battery0":
			$icon = "fa-battery-empty";
			break;
		case "battery1":
			$icon = "fa-battery-quarter";
			break;
		case "battery2":
			$icon = "fa-battery-half";
			break;
		case "battery3":
			$icon = "fa-battery-three-quarters";
			break;
		case "battery4":
			$icon = "fa-battery-full";
			break;
		case "fork":
			$icon = "fa-code-fork";
			break;
		case "star":
			$icon = "fa-star";
			break;
		case "star-o":
			$icon = "fa-star-o";
			break;
		case "star-half":
			$icon = "fa-star-half";
			break;
		case "star-half-o":
			$icon = "fa-star-half-o";
			break;
		case "shield":
			$icon = "fa-shield";
			break;
		case "bed":
			$icon = "fa-bed";
			break;
		case "food":
			$icon = "fa-cutlery";
			break;
/*
		case "":
			$icon = "";
			break;
*/
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




