<?php
$this_file = "all_loader.php";

if(file_exists("./func/")){
	$files = scandir("./func/");
	
	foreach($files as &$file)
	{
		$temp = explode(".",$file);
		if($temp[count($temp)-1] == "php")
		{
			if($file == "gen_menu.php"){
				if(!file_exists("./cache/menu.html"))
				include("./func/$file");
			}
			else
			if($file != $this_file)
				include("./func/$file");
		}
	}
}

?>