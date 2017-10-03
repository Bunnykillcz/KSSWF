<?php
/* Menu generator (from a directory tree); Nikola Nejedlý (c) 2017 */

$root = "./pages";

$list_names[0]  = "";
$list_target[0] = "";
$list_origin[0] = "";

function search($folder) //Function that builds the menu according to "this.kstr" in $root folder
{
	global $after_link;
	global $list_target;
	global $list_names;
	global $list_origin;
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
						$tmp_orig	   = $tmp_address;
						
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
							$list_origin[$s] = $tmp_orig;
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

	//Now we get to the buildimg part of the actual menu in html/5 from the prepared lists from above
	$j = 0;

	$menu_export = "<nav id='nav_wrap'><div class='mainmenu'><ul>";

	foreach($list_names as &$name)
	{
		$href = $list_target[$j];
		$orig_parts = explode("/",$list_origin[$j]);
		$lvl = 0;
		$lvl_current = 0;
		$ip = 0;
		//echo "testpoint #0004 - origin: ".$list_origin[$j]."</br>";
		$ul_sign = 0;
		$nextpart = false;
		
		foreach($orig_parts as &$part)
			if(!empty($part) && $part!="." && $part!=".." && $lvl < count($orig_parts)-1)
			{
				$same = false;
				
				if($j == 0)
					$same = true;
				
				if(dirname($list_origin[$j-1]) == dirname($list_origin[$j]))
					$same = true;
				else
				{
					$same = true;
				
				$tmp = explode("/",dirname($list_origin[$j-1]));
				$tmp2 = explode("/",dirname($list_origin[$j]));
				$tmpmax = max(count($tmp)-1,count($tmp2)-1,$ip);
				
				for($i = 0; $i < $tmpmax; $i++)
					if($i <= count($tmp)-1 && $i <= count($tmp2)-1)
					{
						if($tmp[$i] != $tmp2[$i])
							$same = false;
					}
					else
						if(count($tmp) < count($tmp2))
							$same = false;
				}
				
				$ul_sign = count(explode("/",dirname($list_origin[$j-1]))) - count(explode("/",dirname($list_origin[$j])));
				
				if($ul_sign > 0)
				{
					$same = true;
					
					for($i = 0; $i < $ul_sign; $i++)
						$menu_export = $menu_export."</ul>";
					
					$lvl_current = $lvl-$ul_sign;
				}
				
				if(!$same)
				{
					$menu_export = $menu_export."<li><a href='#'>$part ".icon("dropdown",0)."</a></li><ul>";
					$lvl++;
					$nextpart = false;
				}
				$ip++;
			}
		
		$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
		
		for($i = 0; $i < $lvl_current; $i++)
			$menu_export = $menu_export."</ul>";
			
		$j++;
	}
	$menu_export = $menu_export."</ul></div></nav>";


	if (!file_exists('./cache/')) {
		mkdir('./cache/', 0777, true);
	}

	if(!file_exists("./cache/menu.html"))
		file_put_contents ( "./cache/menu.html" , $menu_export);
?>