<?php

if(!file_exists("./cache/c_font_init.php"))
if(file_exists("./fonts/"))
{
	$output  = "<link href='https://fonts.googleapis.com/css?family=Open+Sans|Roboto|Monofett|Cormorant+SC|Alegreya+Sans+SC|Montserrat|Lobster|Modak|Concert+One|Passion+One|Poiret+One|Playball' rel='stylesheet' />";
	$output .= "<style type='text/css'>";
	$output .= get_fonts("fonts/","");
	$output .= "</style>";
	
	file_put_contents("./cache/c_font_init.php",$output);
}

function get_fonts($addr, $forcename)
{
	$files_  = scandir($addr);
	$out = "";
	$format  = "";
	
	foreach($files_ as &$file)
	{
		$temp = explode(".",$file);
		
		if(count($temp) == 1)
		{
			if(empty($forcename))
			if(file_exists($addr."/".$temp[0]))
				$out .= get_fonts($addr."/".$temp[0], $temp[0]);
		}		
		else
		if($temp[count($temp)-1] == "ttf" || $temp[count($temp)-1] == "woff" || $temp[count($temp)-1] == "svg")
		{
			switch($temp[count($temp)-1])
			{
				default:
				case "ttf":
					$format = "truetype";
				break;
				case "svg":
					$format = "svg";
				break;
				case "woff":
					$format = "woff";
				break;
			}
			
			if(!empty($forcename))
				$temp[0] = $forcename;
			
			$out .= "@font-face { font-family: '".$temp[0]."'; src: url('$addr/$file') format('$format');	}";
		}
	}
	return $out;
}


?>