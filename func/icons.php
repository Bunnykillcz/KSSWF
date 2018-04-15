<?php 
//simple icon callers -- returns the whole string with icon requested
//------------------------------------------------//
// 				Nikola Nejedlý - 2017/18		  //
//------------------------------------------------//


$ic_callers_list = ["globe","heart","wpforms","dropdown","_new","link","home","user","left","right","up","down","wclose","wclose-o","close","card-o","user-c","ban","bin","bin-o","sign-in","sign-out","warning","info",
"edit","save","file","folder","car","uber", "bus", "train","ticket","plane","time_h","html5","building","server","battery0","battery1","battery2","battery3",
"battery4","fork", "star", "star-o", "star-half", "star-half-o", "shield", "bed", "food", "error", "letter", "letter-o", "letter-s", "phone", 
"phone-s", "mphone","headphones", "fort", "bill", "camera", "camera2", "music", "video", "briefcase", "suitcase", "medkit", "gamepad", "magic", "like", "dislike", 
"DnD", "windows", "android", "linux", "apple", "scart", "scart-p", "scart-d", "sbag", "sbasket", "stopwatch",
"fb", "fb-s", "twitter", "twitter-s", "google", "google-s", "share", "rot-loading", "spin-loading", "spin-loading1", "spin-loading2", "loading", "config" ];

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
		case "uber":
		case "taxi":
			$icon = "fa-taxi";
			break;
		case "bus":
			$icon = "fa-bus";
			break;
		case "train":
			$icon = "fa-train";
			break;
		case "error":
			$icon = "fa-times-circle";
			break;
		case "letter":
		case "envelope":
			$icon = "fa-envelope";
			break;
		case "letter-o":
		case "envelope-o":
			$icon = "fa-envelope-open";
			break;
		case "letter-s":
		case "envelope-s":
			$icon = "fa-envelope-square";
			break;
		case "phone":
			$icon = "fa-phone";
			break;
		case "phone-s":
			$icon = "fa-phone-square";
			break;
		case "headphones":
			$icon = "fa-headphones";
			break;
		case "mphone":
		case "microphone":
			$icon = "fa-microphone";
			break;
		case "fort":
			$icon = "fa-fort-awesome";
			break;
		case "bill":
		case "cash":
		case "money":
			$icon = "fa-money";
			break;
		case "cam":
		case "camera":
			$icon = "fa-camera";
			break;
		case "cam2":
		case "camera2":
			$icon = "fa-camera-retro";
			break;
		case "briefcase":
			$icon = "fa-briefcase";
			break;
		case "suitcase":
			$icon = "fa-suitcase";
			break;
		case "gamepad":
			$icon = "fa-gamepad";
			break;
		case "medkit":
			$icon = "fa-medkit";
			break;
		case "magic":
		case "wand":
			$icon = "fa-magic";
			break;
		case "like":
		case "tup":
		case "thumbsup":
			$icon = "fa-thumbs-up";
			break;
		case "dislike":
		case "tdown":
		case "thumbsdown":
			$icon = "fa-thumbs-down";
			break;
		case "DnD":
		case "d-and-d":
			$icon = "fab fa-d-and-d";
			break;
		case "windows":
			$icon = "fa-windows";
			break;
		case "android":
			$icon = "fa-android";
			break;
		case "linux":
			$icon = "fa-linux";
			break;
		case "apple":
			$icon = "fa-apple";
			break;
		case "music":
			$icon = "fa-music";
			break;
		case "video":
			$icon = "fa-video";
			break;
		case "scart":
			$icon = "fa-shopping-cart";
			break;
		case "scart-p":
			$icon = "fa-cart-plus";
			break;
		case "scart-d":
			$icon = "fa-cart-arrow-down";
			break;
		case "sbag":
			$icon = "fa-shopping-bag";
			break;
		case "sbasket":
			$icon = "fa-shopping-basket";
			break;
		case "stopwatch":
			$icon = "fa-stopwatch";
			break;
		case "twitter":
			$icon = "fa-twitter";
			break;
		case "twitter-s":
			$icon = "fa-twitter-square";
			break;
		case "fb":
		case "facebook":
			$icon = "fa-facebook";
			break;
		case "fb-s":
		case "facebook-s":
			$icon = "fa-facebook-square";
			break;
		case "google":
			$icon = "fa-google";
			break;
		case "gp-s":
		case "google-plus-s":
		case "google-s":
			$icon = "fa-google-plus-square";
			break;
		case "share":
			$icon = "fa-share-square";
			break;
		case "rot-loading":
			$icon = "fa-spinner fa-pulse";
			break;
		case "spin-loading":
			$icon = "fa-spinner fa-spin";
			break;
		case "spin-loading1":
			$icon = "fa-circle-notch fa-spin";
			break;
		case "spin-loading2":
			$icon = "fa-cog fa-spin";
			break;
		case "loading":
			$icon = "fa-spinner";
			break;
		case "cog":
		case "setup":
		case "config":
			$icon = "fa-cog";
			break;

/*
		case "":
			$icon = "fa-";
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




