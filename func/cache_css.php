<?php
// Function making the main CSS file in cache for easier loadup
// Nejedlý Nikola | 2017-18

function mk_cache_css()
{
	global $template;
	
	if(file_exists($template."/components/"))
	{
		$files = scandir($template."/components/");
		$contents_css = "";
			
		foreach($files as &$file)
			{
				$temp = explode(".",$file);
				if($temp[count($temp)-1] == "css")
				{
					$contents_css .= "\r /* ------------------------------------------------------ |START| ".explode("/",$template)[1]." : $file ------------------------------------------------------  */ \r \r ";
					$contents_css .= file_get_contents("$template/components/$file");
					$contents_css .= "\r \r /* ------------------------------------------------------ | END | ".explode("/",$template)[1]." : $file ------------------------------------------------------  */ \r ";
					//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
				}
			}
			
		file_put_contents("./cache/css-full.css",$contents_css);
		return 1;
	}
	else
	return 0;
}


?>