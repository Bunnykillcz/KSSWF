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
	
	$files = scandir($folder);
	$level = 0;
	
	$s = 0;
	$type = "URL";
	if(file_exists("this.kstr"))
	{	
		$file = fopen("this.kstr","r");
		while(! feof($file))
		  {
			  $temp = fgets($file);
			  
			if($s == 0 && $temp == "MENU")
				$type = "MENU";
			else 
			if($s == 0 && $temp == "URL")
				$type = "URL";

			if($type == "MENU" && !empty($temp))
			{
			$list_names[$i]  = $temp;
			$list_target[$i] = $folder."/".$temp;
			$list_level[$i]  = $getlevel($list_target[$i]);
			$i++;
			}else
			if($type == "URL" && !empty($temp) && $temp!=" " && $temp!="")
			{
				$list_names[$i]  = basename($folder);
				$list_target[$i] = $temp;
				$list_level[$i]  = $getlevel($folder);
				$i++;
				break;
			}
			$s++;
		  }
		fclose($file);
	}
	
	foreach ($files as &$value) 
	{
		$ftype = substr($value, strlen($value)-4 , strlen($value) );
		
		if($value!="." && $value!="..")
		if($value == "this.kstr")
		{ /*do nothing here*/ }
		else if($ftype == ".php")
		{
			$fname = substr($value, 0 , strlen($value)-4 );
			$list_target[$i] = dirname($after_link)."/index.php?w=".substr(str_replace('/', '_', $folder),2,strlen($folder))."_".$fname;
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