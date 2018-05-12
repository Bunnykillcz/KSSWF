<?php
//Function that returns short string with the firmware version that you're using

function get_ver() 
{
	$version = "";
	$ver_out = "";
	
	$fil = "./index.php";
	$i = 0;

	if(file_exists($fil))
	{
		$file_r = fopen($fil,"r");
		while(! feof($file_r))
		{
			$temp = fgets($file_r);
			
			if($i == 6)
			{ 
				if(substr($temp,0,2) == "//")
				{
					$version = $temp;
					break; 
				}
				else
				{
					break;
				}
			}
			
			$i++;
		}
		fclose($file_r);
	}
	
	$version = str_replace("Version:","",$version);
	$ver_out = trim(str_replace(array('/', ' ', "\n", "\t", "\r"), '', $version));
	
	echo $ver_out;
}
?>