<?php
/* Menu generator (from a directory tree); Nikola Nejedlý (c) 2017 */

$root = "./pages";

$list_names[0]  = "";
$list_target[0] = "";
$list_origin[0] = "";
$list_type[0] = "";
$list_lvl[0] = 0;

function search($folder) //Function that builds the menu according to "this.kstr" in $root folder (also skips files listed that doesn't exist in directories)
{
	global $after_link;
	global $list_target;
	global $list_names;
	global $list_origin;
	global $list_type;
	global $list_lvl;
	global $root;
	
	$files = scandir($folder);
	
	$line = 0;
	$s = 0;
	$list_lvl[$s] = 0;
	
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
					$konst = 0;
					$tp = explode(";",$temp);
					
					if(!empty($tp[0]) && !empty($tp[1]))
					{
						$this_address 	= str_replace("|","/",$tp[0]);
						$this_name 		= $tp[1];
					}
					else
					$skip = true;
									
					if(!$skip)
					{					
					$skip2 = false;
					
					$this_address_chain = explode("/",$this_address);	
					$final_address = "";
					$this_typename = $this_address_chain[count($this_address_chain)-1];
					$this_addr_to_file[0] = "";
					for($i = 0; $i < count($this_address_chain)-1;$i++){
						$this_addr_to_file[$i] = $this_address_chain[$i];
						$final_address = $final_address.$this_address_chain[$i]."/";
					}
					
					if(cleanx($this_typename) != "#" && cleanx($this_typename) != "ß")
					{
						$type = "file";
						
						$final_address = $final_address.cleanx($this_typename);
						
						if(!file_exists($root."/".$final_address.".php"))
							$skip2 = true;
						
						$this_target = "index.php?w=".str_replace("/","+",$final_address);
					}
					else 
					if(cleanx($this_typename) == "#")
					{
						$type = "url";
						if(file_exists($root."/".$final_address."/this.kstr"))
						{
							$readfrom = $root."/".$final_address."/this.kstr";
							$konst = 1;
							$file_2 = fopen($readfrom,"r");
							while(! feof($file_2))
							{
								$this_target = fgets($file_2);
								break;
							}
							fclose($file_2);
						}else
							$skip2 = true;
					}
					else 
					if(cleanx($this_typename) == "ß")
					{
						$konst = 1;
						$type = "folder";
						$this_target = "#";
					}
					else
						$skip2 = true;
					
					if(!$skip2)
					{						
						$list_names[$s]  = $this_name;						//name
						$list_target[$s] = $this_target; 					//a href
						$list_origin[$s] = dirname($final_address."x.php");	//folder structure
						$list_type[$s]   = $type; 							//file, folder, url
						$list_lvl[$s]	 = count(explode("/",$final_address))-1-$konst; 
						//echo $list_names[$s]." - ".$list_target[$s]." - ".$list_origin[$s]." - ".$list_type[$s]."</br>";
						$s++;
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

	$menu_export = "<nav id='nav_wrap'><div class='mainmenu'><ul>";
	$id_name = 0;
	$flvl = 0;
	$ul = 0;
	$li = 0;
	foreach($list_names as &$name)
	{
		$href = $list_target[$id_name];
		$type = $list_type[$id_name];
		$from = $list_origin[$id_name];
		$lvl  = $list_lvl[$id_name];
		$previous_from = "";
		
			
		if($id_name > 0)
		$previous_from = $list_origin[$id_name-1];
		
		$orig_parts = explode("/",$list_origin[$id_name]);
		$orig_parts_prev = explode("/",$previous_from);
		$prev_lvl = count($orig_parts_prev)-1;
		
		$skip = false;
		
		if($id_name > 0)
			for($i = 0; $i < ($prev_lvl - $lvl); $i++){
				$menu_export = $menu_export."</ul></li>"; $ul--;$li--;
			}
			
		if($id_name == count($list_names)-1 && ($ul > 0 && $li > 0)){
				$menu_export = $menu_export."</ul></li>"; $ul--;$li--;
			}
			
		if($type == "folder")
		{
			$menu_export = $menu_export."<li><a href='$href'>$name".icon("dropdown",0)."</a><ul>";
			$flvl++; $ul++;$li++;
		}
		else if($type == "file")
			$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
		else if($type == "url")
			$menu_export = $menu_export."<li><a href='$href'>$name</a></li>";
		
		
	$id_name++;
	}
	
	$menu_export = $menu_export."</ul></div></nav>";

	if (!file_exists('./cache/')) {
		mkdir('./cache/', 0777, true);
	}

	if(!file_exists("./cache/menu.html"))
		file_put_contents ( "./cache/menu.html" , $menu_export);	//*/
?>