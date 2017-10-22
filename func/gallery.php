<?php
function gallery($folder) //the gallery folder directory --> default = ./img/......?
{
	global $actual_link;
	global $after_link;
	global $root_link;
	$dir = str_replace("\\","/", dirname($actual_link.$after_link))."/img/".$folder;
	$dir_root = str_replace("\\","/", $root_link)."/img/".$folder;
	
	if(!file_exists($dir_root) && !is_dir($dir_root))
		return -1;
	
	$amount = 0;
	$images = glob("$dir_root/*.{jpg,png,bmp,gif,jpeg,JPG,PNG,BMP,GIF,JPEG}", GLOB_BRACE);

	echo "<div id='underwrap'></div><div class='img_gallery'>";
		
		foreach($images as $image)
		{
			$img_t = explode("/",$image);
			$img_  = $img_t[count($img_t)-1];
			
			echo "<div id='wrap'><img src='$dir/$img_' alt='$img_'></div>";
			$amount++;
		}
		
	echo "</div>";

	return $amount;
}
?>