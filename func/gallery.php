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

function mk_cache_img($source,$target_name,$resize_width) //returns false if failed
{
	
	if(!file_exists($source))
		return false;
	
	if($resize_width <= 0)
		return false;
	
	$saveas = "";
	
	
	$vartype = explode(".",$source)[count(explode(".",$source))-1];
	if($vartype == "png" || $vartype == "jpg" || $vartype == "jpeg" || $vartype == "gif"
	|| $vartype == "PNG" || $vartype == "JPG" ||$vartype == "JPEG" || $vartype == "GIF")
	$saveas = $vartype;
	else
		return false;
	
	if(file_exists("./cache/img/$target_name"))
		return false;
	
	if (!file_exists('./cache/img')) 
		mkdir('./cache/img', 0777, true);		
		
	$imgtp = IMAGETYPE_JPEG;
	
	if($saveas == "jpg" || $saveas == "jpeg" || $saveas == "JPG" || $saveas == "JPEG")
	{
		$imgtp = IMAGETYPE_JPEG;
		$image = imagecreatefromjpeg($source);
	}
	else
	if($saveas == "gif" || $saveas == "GIF")
	{
		$imgtp = IMAGETYPE_GIF;
		$image = imagecreatefromgif($source);
	}	
	else
	if($saveas == "png" || $saveas == "PNG")
	{
		$imgtp = IMAGETYPE_PNG;
		$image = imagecreatefrompng($source);
	}	
	else
	return false;
	
	$ratio = $resize_width / imagesx($image);
	$resize_height = imagesy($image) * $ratio;
	if($resize_height > 3*$resize_width)
		$resize_height = 3*$resize_width;
	
	$new_image = imagecreatetruecolor($resize_width, $resize_height);
	imagecopyresampled($new_image, $image, 0, 0, 0, 0, $resize_width, $resize_height, imagesx($image), imagesy($image));
	$image = $new_image;
	
	img_save($image,"./cache/img/$target_name",$imgtp, 70,null);
	return true;
	
}

function img_save($image, $filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

  if( $image_type == IMAGETYPE_JPEG ) {
	 imagejpeg($image,$filename,$compression);
  } elseif( $image_type == IMAGETYPE_GIF ) {
	 imagegif($image,$filename);
  } elseif( $image_type == IMAGETYPE_PNG ) {
	 imagepng($image,$filename);
  }
  if( $permissions != null) {
	 chmod($filename,$permissions);
  }
}

?>



