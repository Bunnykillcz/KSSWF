<?php
function cache_clear()
{
	if(file_exists("./cache/menu.html"))
		unlink("./cache/menu.html");
	
	$files_ = scandir("./cache/");
	
	foreach($files_ as &$file)
	{
		$temp = explode("_",$file);
		if(count($temp) > 1)
		{
			unlink("./cache/$file");
		}
	}
	
}

if(!empty($_GET['c']))
if($_GET['c'] == "1")
	{
	cache_clear();
	//$addr = $after_link;
	//$content = "home";
	//header('location:'.$addr."?w=".$content);
	}
?>