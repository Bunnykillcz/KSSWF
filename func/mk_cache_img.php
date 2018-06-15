<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

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