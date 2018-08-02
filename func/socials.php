<?php
//social icon & SHARE LINK generator
//------------------------------------------------------------//
// 				Nikola Nejedlý & Matěj Kománek - 2018		  //
//------------------------------------------------------------//



	function socials($input) 
	{
		$final_output = "";
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url_google = "http%3A//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$text = "";
		$tgt = "target='_blank' ";
		
		if($input == "all")
		{
			$final_output = "<div class='socials'>";
			
			$final_output .= "<a $tgt href='https://www.facebook.com/sharer.php?u=".$url."'>";
			$final_output .= icon("fb-s",0);
			$final_output .= "</a>";	
			
			$final_output .= "<a $tgt href='https://plus.google.com/share?url=".$url_google."'>";
			$final_output .= icon("google-s",0);
			$final_output .= "</a>";
			
			$final_output .= "<a $tgt href='https://www.twitter.com/intent/tweet?url=".$url."&text=".$text."'>";
			$final_output .= icon("twitter-s",0);
			$final_output .= "</a>";
		}
		else
		if($input == "facebook") 
		{
			$final_output .= "<a $tgt href='https://www.facebook.com/sharer.php?u=".$url."'>";
			$final_output .= icon("fb-s",0);
			$final_output .= "</a>";	
		}
		else
		if($input == "google") 
		{
			$final_output .= "<a $tgt href='https://plus.google.com/share?url=".$url_google."'>";
			$final_output .= icon("google-s",0);
			$final_output .= "</a>";
		}
		else
		if($input == "twitter") 
		{
			$final_output .= "<a $tgt href='https://www.twitter.com/intent/tweet?url=".$url."&text=".$text."'>";
			$final_output .= icon("twitter-s",0);
			$final_output .= "</a>";
		}
		else
			return false;

		if($input == "all")
			$final_output .= "</div>";
		
		echo $final_output;
		
		return true;
	}
?>