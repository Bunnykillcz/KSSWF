<?php
/* Menu generator; Nikola Nejedlý (c) 2017 */

$root = "./pages";

$list_names[0]  = "";
$list_target[0] = "";

function search($folder) //Function that builds the menu according to "this.kstr" in $root folder
{
	global $after_link;
	global $list_target;
	global $list_names;
	global $root;
	
	$files = scandir($folder);
	
	$line = 0;
	$s = 0;
	
	if(file_exists($folder."/this.kstr"))
	{	
		$file = fopen($folder."/this.kstr","r");
		while(! feof($file))
		{
			$temp = fgets($file);
			  
			if($line >= 4)
			{
				if(!empty($temp))
				{
					$skip = false;
					$tmp_list_line = explode(";",$temp);
					
					//if(empty($tmp_list_line[0]) || empty(explode("|",$tmp_list_line[0])[0]) || empty(explode("|",$tmp_list_line[0])[count(explode("|",$tmp_list_line[0]))]) || empty($tmp_list_line[1]))
					//	$skip = true;
					
					//echo "testpoint #0001 - skip01: ".$skip."</br>";
					
					if(!$skip)
					{
						$tmp_address   = str_replace("|","/",$tmp_list_line[0]);
						$tmp_last_adr  = explode("|",$tmp_list_line[0])[count(explode("|",$tmp_list_line[0]))-1];
						$tmp_name 	   = $tmp_list_line[1];
						
						//echo "testpoint #0002 - file exists: ".$tmp_address.".php"." || ".file_exists($tmp_address.".php");
						
						if(!file_exists($root."/".$tmp_address.".php") && $tmp_last_adr != "#")
							$skip = true;
						else
						if(file_exists($root."/".$tmp_address.".php") && $tmp_last_adr != "#")
						{
							$tmp_address = "index.php?w=".str_replace("/","+",$tmp_address);
							
							$skip = false;
						}
						else
						if(!file_exists($root."/".$tmp_address.".php") && file_exists(dirname($root."/".$tmp_address)."/this.kstr") && $tmp_last_adr == "#")
						{
							$readfrom = dirname($root."/".$tmp_address)."/this.kstr";
							$file_2 = fopen($readfrom,"r");
							while(! feof($file_2))
							{
								$tmp_address = fgets($file_2);
							}
							fclose($file_2);
							
							$skip = false;
						}
						
						
						if(!$skip)
						{
							$list_names[$s]  = $tmp_name;
							$list_target[$s] = $tmp_address;
							$s++;
							//echo "<br>testpoint #0003 - final format: ".$tmp_name." || ".$list_target[$s-1];
						}
					}
				}
			}
			$line++;
		}
		fclose($file);
	}
}

search($root);

//Now we get to the building the actual menu in html5 from the prepared lists from above
$j = 0;

$menu_export = "<div class='main_menu'><ul>";
$current_lvl = 0;
$lvl = 0;

foreach($list_names as &$name)
{
	$href = $list_target[$j];
	$lvl = count(explode("/",$href));
	/*
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
	}*/
	
	$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
	
	$j++;
}
$menu_export = $menu_export."</ul></div>";

echo $menu_export;

?>