<?php
function slideshow($identifier, $folder, $show_controls_arrow, $show_controls_dots, $time, $effect) 
{ 	  // slideshow(0,"slideshow001", true, true, 10000, "fade", 0, 0); - time in [ms] (if zero, then doesn't change automatically) - returns -1 if failed
	if(file_exists("./cache/".$identifier."_slideshow$identifier.html"))
	{
		include("./cache/".$identifier."_slideshow$identifier.html");
		return;
	}	
	
	$file_list[0] = ""; 

	global $actual_link;
	global $after_link;
	global $root_link;

	$settings = "";

	
/*	if($size_x > 0 && $size_y > 0)
		$settings = " style='display: block; height: $size_y; width: $size_x;'"; // 0, 0 leaves default
*/
	$dir = str_replace("\\","/", dirname($actual_link.$after_link))."/img/".$folder;
	$dir_root = str_replace("\\","/", $root_link)."/img/".$folder;
	
	if(!file_exists($dir_root) && !is_dir($dir_root))
		return -1;
	
	$amount = 0;
	$images = glob("$dir_root/*.{jpg,png,bmp,gif,jpeg,JPG,PNG,BMP,GIF,JPEG}", GLOB_BRACE);

	$slideshow = "<div class='slideshow-container' ".$settings.">";
	
	foreach($images as $image)
	{
		$img_t = explode("/",$image);
		$img_  = $img_t[count($img_t)-1];
		
		$caption = "";
		$file_insides = "";
		
		//echo $dir_root."/".explode(".",$img_)[0].".kstr";
		
		if(file_exists($dir_root."/".explode(".",$img_)[0].".kstr"))
		{
			$fil = $dir_root."/".explode(".",$img_)[0].".kstr";
			$file_r = fopen($fil,"r");
			while(! feof($file_r))
			{
				$temp = fgets($file_r);
				$file_insides.=$temp;
			}
			fclose($file_r);
			
			$caption = "<div class='text'>".$file_insides."</div>";
		
		}
		$slideshow .= "<div class='thisSlide $effect'><div class='numbertext'> ".($amount+1)." / ".count($images)."</div>";
		$slideshow .= "<img src='$dir/$img_' alt='$img_'>$caption</div>";
		$amount++;
	}
	
	if($amount < 1)
		return -1;
		
	if($amount > 1 && $show_controls_arrow)
		$slideshow .= "<a class='prev' onclick='plusSlides(-1)'>".icon("left",0)."</a><a class='next' onclick='plusSlides(1)'>".icon("right",0)."</a>";
	
	$slideshow .= "</div>";
	
	if($amount > 1 && $show_controls_dots)
	{
		$slideshow .= "<div class='dot-container'>";
		for($j = 1; $j <= $amount; $j++)
			$slideshow .= "<span class='dot' onclick='currentSlide($j)'>$j</span> ";
		$slideshow .= "</div>";
	}
	
	if($time > 0)
		$slideshow .= "<script type='text/javascript' src='./javascript/slideshow_time.js'></script><script>showSlides($time,1);</script>";
	else
	    $slideshow .= "<script type='text/javascript' src='./javascript/slideshow_notime.js'></script>";
	
	//create cache
	if (!file_exists('./cache/')) {
		mkdir('./cache/', 0777, true);
	}
	file_put_contents("./cache/".$identifier."_slideshow$identifier.html" , $slideshow);
	
	include("./cache/".$identifier."_slideshow$identifier.html");
	return;
}
?>