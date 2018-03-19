<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

function gallery($folder, $g_title) //the gallery folder directory --> default = ./img/......? ; g_title = "" - if empty, doesn't show, if filled, h3
{
	global $actual_link;
	global $after_link;
	global $root_link;
	global $endclude;
	$dir = str_replace("\\","/", dirname($actual_link.$after_link))."/img/".$folder;
	$dir_root = str_replace("\\","/", $root_link)."/img/".$folder;
	
	//cache setup & check
		if (!file_exists('./cache/')) 
			mkdir('./cache/', 0777, true);		
	//--------------------
	
	if(!file_exists($dir_root) && !is_dir($dir_root))
		return -1;
	
	$amount = 0;
	$images = glob("$dir_root/*.{jpg,png,bmp,gif,jpeg,JPG,PNG,BMP,GIF,JPEG}", GLOB_BRACE);
	
	if(empty($endclude))
		$endclude = "";
	
	$endclude.= "<script>";
	$endclude.= "var Images = new Array();";
	$endclude.= "var ImageCnt = 0;";
		foreach($images as $image)
		{
			$img_t = explode("/",$image);
			$img_  = $img_t[count($img_t)-1];
			$endclude.= "Images[".$amount."]='".$dir."/".$img_."';";    
			$amount++;
		}
	$endclude.= "var max_img = ".$amount.";";
		
	$amount = 0;
	$endclude.= "canvas_close();</script>";
	//$endclude.= "<script type='text/javascript' src='./javascript/gallery_fc.js'>";

	echo "<div id='underwrap'></div><div class='img_gallery'>";
	
	if(!empty($g_title))
	echo "<h3>".$g_title."</h3>";
		 
		foreach($images as $image)
		{
			$img_t = explode("/",$image);
			$img_  = $img_t[count($img_t)-1];
			
			if (!file_exists('./cache/img/'.$folder.'/')) 
				mkdir('./cache/img/'.$folder.'/', 0777, true);		
			
			mk_cache_img($dir_root."/".$img_,$folder."/".$img_,320);
			//$endclude.= "Images[".$amount."]='".$dir."/".$img_."';";    
			$imgsrctemp = $folder."/".$img_;
			if(file_exists("./cache/img/".$folder."/".$img_))
				$imgsrctemp = "./cache/img/".$folder."/".$img_;
			echo "<div id='wrap'><a href='#' onclick='canvas_goto(".$amount.");return false;'><img src='$imgsrctemp' alt='$img_'></a></div>";
			
			$amount++;
		}
		
	echo "</div><a href='#' onclick='canvas_close();return false;'><div id='canvas_bg'></div></a>
	<div id='canvas'>
	<span id='a_left'><a href='#' onclick='canvas_prev();return false;'>".icon("left",2)."</a></span>
	<span id='a_right'><a href='#' onclick='canvas_next();return false;'>".icon("right",2)."</a></span>
	<span id='a_close'><a href='#' onclick='canvas_close();return false;'>".icon("close",2)."</a></span></div>";

	return $amount;
}


?>



