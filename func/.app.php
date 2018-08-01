<?php
//------------------------------------------------//
// 				Nikola Nejedlý - 2018	    	  //
//------------------------------------------------//
//General necessary functions

//------------------------------------------------------------------------------------------------//
// Redirecting function
// Nejedlý Nikola | 2018

function redirect($url, $CodeStatus = 303)
{
	header("Location:".$url, true, $CodeStatus);
	die();
}

//------------------------------------------------------------------------------------------------//
// Some specific string-cleaning functions
// Nejedlý Nikola | 2017

function clean($string) 
{
   $string = str_replace(' ', '-', $string); 

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}
function cleanx($string) 
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^A-Za-z0-9\#\ß\_]/', '', $string); 
}
function cleannum($string) 
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^0-9\.]/', '', $string); 
}
function cleandotcom($string)
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^A-Za-z0-9\,\#\ß\_\.\;]/', '', $string); 
}

//------------------------------------------------------------------------------------------------//
// Function that returns short string with the firmware version that you're using
// Nejedlý Nikola | 2018
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

//------------------------------------------------------------------------------------------------//
// Function making the main CSS file in cache for easier loadup
// Nejedlý Nikola | 2017-18

function mk_cache_css()
{
	global $template;
	global $disable_default;
	
	
	if(file_exists($template."/components/"))
	{
		$contents_css = "";
		
		if(!$disable_default)
		if(file_exists("./templates/default/components/"))
		{		
			$files = scandir("./templates/default/components/");
			$contents_css .= "\r /* ------------------------------------------------------ < COMPONENTS DEF > ------------------------------------------------------  */ \r \r ";
			
			foreach($files as &$file)
			{
				$temp = explode(".",$file);
				if($temp[count($temp)-1] == "css")
				if(!file_exists($template."/components/$file"))
				{
					$contents_css .= "\r /* ------------------------------------------------------ |START| default : $file ------------------------------------------------------  */ \r \r ";
					$contents_css .= file_get_contents("./templates/default/components/$file");
					$contents_css .= "\r \r /* ------------------------------------------------------ | END | default : $file ------------------------------------------------------  */ \r ";
					//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
				}
			}
				
		}
		$contents_css .= "\r /* ------------------------------------------------------ < COMPONENTS > ------------------------------------------------------  */ \r \r ";
		$files = scandir($template."/components/");
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
		
		if(!$disable_default)
		if(file_exists("./templates/default/media/"))
		{
			$contents_css .= "\r /* ------------------------------------------------------ < MEDIA DEF > ------------------------------------------------------  */ \r \r ";
				
			$directories = glob("./templates/default/media".'/*' , GLOB_ONLYDIR);
			$files = scandir("./templates/default/media/");
			foreach($files as &$file)
			{
				$temp = explode(".",$file);
				if($temp[count($temp)-1] == "css")
				if(!file_exists($template."/media/$file"))
				{
					$contents_css .= "\r /* ------------------------------------------------------ |START| default : $file ------------------------------------------------------  */ \r \r ";
					$contents_css .= file_get_contents("./templates/default/media/$file");
					$contents_css .= "\r \r /* ------------------------------------------------------ | END | default : $file ------------------------------------------------------  */ \r ";
					//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
				}
			}
				
			if(count($directories) > 0 && $directories != null && !empty($directories))
			foreach($directories as &$dirz)
			{
				if($dirz != null && !empty($dirz) && file_exists($dirz))
					$files = scandir($dirz);
				if(count($files) > 0 && $files != null && !empty($files))
					foreach($files as &$file)
					{
						$temp = explode(".",$file);
						if($temp[count($temp)-1] == "css")
						if(!file_exists($template."/media/".explode('/',$dirz)[count(explode('/',$dirz))-1]."/".$file))
						{
							$contents_css .= "\r /* ------------------------------------------------------ |START| default - media : $file ------------------------------------------------------  */ \r \r ";
							$contents_css .= file_get_contents("$dirz/$file");
							$contents_css .= "\r \r /* ------------------------------------------------------ | END | default - media: $file ------------------------------------------------------  */ \r ";
							//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
						}
					}
			}
		}
		$directories = null;
		
		if(file_exists($template."/media/"))
		{
			$contents_css .= "\r /* ------------------------------------------------------ < MEDIA > ------------------------------------------------------  */ \r \r ";
			$files = scandir($template."/media/");
			$directories = glob($template."/media"."/*" , GLOB_ONLYDIR);
				
			foreach($files as &$file)
			{
				$temp = explode(".",$file);
				if($temp[count($temp)-1] == "css")
				{
					$contents_css .= "\r /* ------------------------------------------------------ |START| ".explode("/",$template)[1]." - media : $file ------------------------------------------------------  */ \r \r ";
					$contents_css .= file_get_contents("$template/components/$file");
					$contents_css .= "\r \r /* ------------------------------------------------------ | END | ".explode("/",$template)[1]." - media : $file ------------------------------------------------------  */ \r ";
					//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
				}
			}
		}
		if($directories != null)
		if(count($directories) > 0 && $directories != null && !empty($directories))
		foreach($directories as &$dirz)
		{
			if($dirz != null && !empty($dirz) && file_exists($dirz))
				$files = scandir($dirz);
			
			if(count($files) > 0 && $files != null && !empty($files))
				foreach($files as &$file)
				{
					$temp = explode(".",$file);
					if($temp[count($temp)-1] == "css")
					{
						$contents_css .= "\r /* ------------------------------------------------------ |START| ".explode("/",$template)[1]." - media : $file ------------------------------------------------------  */ \r \r ";
						$contents_css .= file_get_contents("$dirz/$file");
						$contents_css .= "\r \r /* ------------------------------------------------------ | END | ".explode("/",$template)[1]." - media : $file ------------------------------------------------------  */ \r ";
						//$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
					}
				}
		}
		
		
		file_put_contents("./cache/css-full.css",$contents_css);
		if(file_exists("./addons/CKEditor4"))
			file_put_contents("./addons/CKEditor4/css-full.cache.css",$contents_css);
		return 1;
	}
	else
	return 0;

}

//------------------------------------------------------------------------------------------------//
// Functions of basic Caesar encrypting/decrypting
// Nejedlý Nikola | 2018

function encrypt_caesar($inp_string, $key_num)
{
	$key_num = abs($key_num);
	$out = "";
	$asciimax = 256;
	for($i = 0; $i < strlen($inp_string); $i++)
		$out .= chr((ord($inp_string[$i])+$key_num)%$asciimax);
	
	return $out;
}
function decrypt_caesar($inp_string, $key_num)
{
	$key_num = abs($key_num);
	$out = "";
	$asciimax = 256;
	for($i = 0; $i < strlen($inp_string); $i++)
		$out .= chr((ord($inp_string[$i])-$key_num)%$asciimax);
	
	return $out;
}


?>