<?php
$this_file = "all_loader.php";

if(file_exists("./func/")){
	$files_ = scandir("./func/");
	
	foreach($files_ as &$file)
	{
			//echo $file;
		$temp = explode(".",$file);
		if($temp[count($temp)-1] == "php")
		{
			if($file != "gen_menu.php")
			if($file != $this_file)
				include("./func/$file");
		}
	}
}

?>