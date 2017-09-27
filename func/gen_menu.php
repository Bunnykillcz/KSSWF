<?php
/* Menu generator; Nikola Nejedlý (c) 2017 */

$root = "./pages";

function getlevel($addr)
{
	$lvl[0] = "";
	$lvl = explode("/",$addr);	
	$amount = 0;

	foreach($lvl as &$x)
	$amount++;

	return $amount-2;
}


$list_target[0] = ""; // item targets (a href)
$list_names[0] = "";  // item names (..>name</a>)
$list_level[0] = 0;

function search($folder, $i) //Brutal recurrent function building all the needed sctructure according to setup of folders and kstr files  (This builds the menu structure) 
{
	global $after_link;
	global $list_target;
	global $list_names;
	global $list_level;
	global $root;
	
	$files = scandir($folder);
	$level = 0;
	
	$list_target_tmp[0] = "";
	$list_names_tmp[0]  = "";
	$list_level_tmp[0]  = 0;
	
	$s = 0; 
	$line = 0;
	$type = "unknown";
	if(file_exists($folder."/this.kstr"))
	{	
		$file = fopen($folder."/this.kstr","r");
		while(! feof($file))
		  {
			  $temp = fgets($file);
			  
			if($line == 0 && clean($temp) == "MENU")
				$type = "MENU";
			else 
			if($line == 0 && clean($temp) == "URL")
				$type = "URL";

			if($line >= 2)
			{
				if($type == "MENU" && !empty($temp))
				{
					$list_names_tmp[$s]  = $temp;
					$list_target_tmp[$s] = $folder."/".$temp;
					$list_level_tmp[$s]  = getlevel($list_target[$i]);
					$s++;
				}
				else
				if($type == "URL" && !empty($temp))
				{
					$list_names_tmp[$s]  = basename($folder);
					$list_target_tmp[$s]] = $temp;
					$list_level_tmp[$s]  = $getlevel($folder);
					$s++;
					echo "URL";
				}
			}
			$line++;
		  }
		fclose($file);
	}
	
	if($type != "URL")
	foreach ($files as &$value) 
	{
		$ftype = substr($value, strlen($value)-4 , strlen($value) );
		$add_this = true; //přidej kontrolu oproti KSTR!!!
		
		if($value!="." && $value!="..")
		if($value == "this.kstr")
		{ /*do nothing here*/ }
		else if($ftype == ".php")
		{
			$fname = substr($value, 0 , strlen($value)-4 );
			$subtmp = substr(str_replace('/', '+', $folder),strlen($root),strlen($folder))."+".$fname;
			if(substr($subtmp,0,1) == "+")
				$subtmp = substr($subtmp,1,strlen($subtmp));
			$list_target[$i] = dirname($after_link)."/index.php?w=".$subtmp;
			$list_names[$i]  = $fname;
			$list_level[$i]  = getlevel($list_target[$i]);
			$i++;
		}
		else if(is_dir($value))// && getlevel($value) < 10)
		{
			echo $value."</br>";
			$i = search($value,$i);
		}
	}
	
	return $i;
}

search($root,0);

//Now we get to building the actual menu in html5 from the prepared lists from above
$j = 0;

$menu_export = "<div class='main_menu'><ul>";
$current_lvl = 0;

foreach($list_names as &$name)
{
	$href = $list_target[$j];
	$lvl  = $list_level[$j];
	if($lvl > $current_lvl)
	{
		for($i = 0; $i< ($lvl - $current_lvl); $i++)
			$menu_export = $menu_export."<ul>";
		
		$current_lvl = $lvl;
	}else
	if($lvl < $current_lvl)
	{
		for($i = 0; $i< ($current_lvl - $lvl); $i++)
			$menu_export = $menu_export."</ul>";
		
		$current_lvl = $lvl;
	}
	
	$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
	
	$j++;
}
$menu_export = $menu_export."</ul></div>";

echo $menu_export;

?>