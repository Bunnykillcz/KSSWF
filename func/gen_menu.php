<?php
/* Menu generator; Nikola Nejedlý (c) 2017 */

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

$menu_export = "<div class='main_menu'><ul>";

foreach($list_names as &$name)
{
	$href = $list_target[$j];
	$orig_parts = explode("/",$list_origin[$j]);
	$lvl = 0;
	
	$ip = 0;
	//echo "testpoint #0004 - origin: ".$list_origin[$j]."</br>";
	foreach($orig_parts as &$part)
		if(!empty($part) && $part!="." && $part!=".." && $lvl < count($orig_parts)-1)
		{
			$same = true;
			
			$ik = 0;
			if($j > 0)
			foreach(explode("/",$list_origin[$j-1]) as &$opart_prev)
			{
				if($ik == $ip)
				{
					if($opart_prev == $part)
					{
						echo "<br>testpoint #0005 - is it the same? : ".$same." --> ".$opart_prev." = ".$part;
					}else
					{
						$same = false;
						echo "<br>testpoint #0005 - is it the same? : ".$same." --> ".$opart_prev." != ".$part;
					}
				}
				$ik++;
			}	
				
			if(!$same)
			{
				$menu_export = $menu_export."<ul>$part";
				$lvl++;
			}
			$ip++;
		}
	
	$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
	
	for($i = 0; $i < $lvl; $i++)
		$menu_export = $menu_export."</ul>";
		
	$j++;
}
$menu_export = $menu_export."</ul></div>";

//echo $menu_export;

if (!file_exists('./cache/')) {
    mkdir('./cache/', 0777, true);
}

if(!file_exists("./cache/menu.html"))
file_put_contents ( "./cache/menu.html" , $menu_export);

?>