<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

function gallery($folder, $g_title = "", $order = "abc", $cache_all = false /* (3,4 Optionals) */) //the gallery folder directory --> default = ./img/......? ; g_title = "" - if empty, doesn't show, if filled, h3 ; order --> "abc" || "cba" || "random"
{
	global $gal_id;
	global $actual_link;
	global $after_link;
	global $root_link;
	global $endclude;
	$dir = str_replace("\\","/", dirname($actual_link.$after_link))."/img/".$folder;
	$dir_root = str_replace("\\","/", $root_link)."/img/".$folder;
		
	if(!file_exists($dir_root) && !is_dir($dir_root))
		return -1;
	
	$amount = 0;
	$images = glob("$dir_root/*.{jpg,png,bmp,gif,jpeg,JPG,PNG,BMP,GIF,JPEG}", GLOB_BRACE);
	
	$img_array = array(array());
	
	$i_ = 0;
	foreach($images as $image)
	{
		$img_t = explode("/",$image);
		$img_  = $img_t[count($img_t)-1];
		$img_array[$i_][0] = $image;
		$img_array[$i_][1] = $img_;
		
		$i_++;
	}
	$i_--;

	if($order == "random")
		shuffle($img_array);
	else
	if($order == "cba")
		array_multisort($img_array, SORT_DESC, SORT_REGULAR);
	else
	if($order == "abc")
		array_multisort($img_array, SORT_ASC, SORT_REGULAR);

	
	if(empty($endclude))
		$endclude = "";
	
	$endclude.= "<script>";
	$endclude.= "var Images = new Array();";
	$endclude.= "var ImageCnt = 0;";
	for($i = 0; $i <= $i_; $i++)
		{
			$img_t = explode("/",$img_array[$i][0]);
			$img_ = $img_array[$i][1];
			$endclude.= "Images[".$amount."]='".$dir."/".$img_."';";    
			$amount++;
		}
	$endclude.= "var max_img = ".$amount.";";
	$amount = 0;
	$endclude.= "canvas_close();</script>";

	//cache setup & check
		if (!file_exists('./cache/')) 
			mkdir('./cache/', 0777, true);
	if($cache_all)
		if (file_exists('./cache/gal_'.$gal_id.str_replace("/","_",$dir).".html")) 
		{
			include('./cache/gal_'.$gal_id.str_replace("/","_",$dir).".html");
			return -2;
		}
	//--------------------
	
	$out_ = "<div id='underwrap'></div><div class='img_gallery'>";
	
	$kstrtexts = "<div class='gallery_text'>";
	
	if(!empty($g_title))
	echo "<h3>".$g_title."</h3>";
		 	 
	for($i = 0; $i <= $i_; $i++)
	{/*
		$img_t = explode("/",$image);
		$img_  = $img_t[count($img_t)-1];*/
		
		$img_t = explode("/",$img_array[$i][0]);
		$img_ = $img_array[$i][1];
		
		if (!file_exists('./cache/img/'.$folder.'/')) 
			mkdir('./cache/img/'.$folder.'/', 0777, true);		
		
		mk_cache_img($dir_root."/".$img_,$folder."/".$img_,320);
		//$endclude.= "Images[".$amount."]='".$dir."/".$img_."';";    
		$imgsrctemp = $folder."/".$img_;
		if(file_exists("./cache/img/".$folder."/".$img_))
			$imgsrctemp = "./cache/img/".$folder."/".$img_;
		
		$out_ .= "<div id='wrap'><a href='#' onclick='canvas_goto(".$amount.");return false;'><img src='$imgsrctemp' alt='$img_'></a></div>";
		
		$tmpex = explode('.', $img_)[0];
		$kstradr = $dir_root."/".$tmpex.".kstr";
		
		if(file_exists($kstradr))
		{
			$kstrtxt = file_get_contents($kstradr);
			$kstrtexts .= "<span id='g_text_$amount' name='g_text' class='g_text' style='display:none;'>$kstrtxt</span>";
		}
		
		$amount++;
	}
		
	$kstrtexts .= "</div>";
		
	$out_ .= "</div><a href='#' onclick='canvas_close();return false;'><div id='canvas_bg' style='display:none;'></div></a>	
	<div id='canvas'><span id='a_left'><a href='#' onclick='canvas_prev();return false;'>".icon("left",2)."</a></span><span id='a_right'><a href='#' onclick='canvas_next();return false;'>".icon("right",2)."</a></span><span id='a_close'><a href='#' onclick='canvas_close();return false;'>".icon("close",2)."</a></span>".$kstrtexts."</div>";
	
	if($cache_all)
	{
		file_put_contents('./cache/gal_'.$gal_id.str_replace("/","_",$dir).".html", $out_);
		include('./cache/gal_'.$gal_id.str_replace("/","_",$dir).".html");
	}
	else
		echo $out_;

	$gal_id++;

	return $amount;
}


?>



