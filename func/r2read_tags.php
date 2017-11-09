<?php
/*-----------------------------------------------------------------------------------*/
/* Read tags and description from page file (line 2,4);      Nikola Nejedlý (c) 2017 */
/*-----------------------------------------------------------------------------------*/
$content_ = "";
if(!empty($_GET['w']))
	$content_ = $_GET['w'];

if($content_ == "index" )
$content_ = "home";

if(!empty($content_))
{
	$fil = "./pages/".$content_.".php";
	$i = 0;

		if(file_exists($fil))
		{
			$file_r = fopen($fil,"r");
			while(! feof($file_r))
			{
				$temp = fgets($file_r);
				  
				if($i == 1)
				{ 
					if(substr($temp,0,2) == "//" || substr($temp,0,2) == "/*")
					{
						$tags = cleandotcom($temp);
					}
				}
				if($i == 3)
				{ 
					if(substr($temp,0,2) == "//" || substr($temp,0,2) == "/*")
					{
						$description = substr($temp,2,strlen($temp));
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
}
?>