<?php
/*-----------------------------------------------------------------*/
/* Breadcrumb Navigation generator;        Nikola Nejedlý (c) 2018 */
/*-----------------------------------------------------------------*/


function gen_bcnav($bool_href, $string_splitter) 	//Function that generates and writes out the Breadcrumb Navigation sequence; returns current position as a number;
								//$bool_href = true --> single parts will be generated as urls, otherwise it's just a text; $string_splitter --> how do you want to split your characters (if empty = "|");
{
	global $after_link;
	global $this_w;
	$root = "./pages";
	
	$temp_addr = "home";
	if(!empty($this_w))
		$temp_addr = str_replace("+","_", $this_w);
	
	//cache setup & check
		if (!file_exists('./cache/')) 
			mkdir('./cache/', 0777, true);
		
		$varname = ord($string_splitter).$temp_addr.$bool_href;
		
		if(file_exists("./cache/$varname.html"))
		{
			include("./cache/$varname.html");
			$i = 0;
			$i = count(explode('+',$this_w));
			return $i;
		}
	//--------------------
		
	if(empty($string_splitter))  
		$string_splitter = "|";
	
	$gen_export = "<div class='bcnav'>"; 
	$gen_export .= "<span class='bcnav_p' id='0'>";
	if($bool_href)
		$gen_export .= "<a href='index.php'>home</a>";
	else
		$gen_export .= "home";
	$gen_export .= "</span>";
	if($this_w != "home" && $this_w != "index" && !empty($this_w))
		$gen_export .= " ".$string_splitter." ";

	$temp_list = explode('+',$this_w);
	$part_i = 1;
	$tmp_addr_whole = "index.php?w=";
	$parent = "home";
	$leave_next = false;
	$current_read = "";
	
	if($this_w != "home" && $this_w != "index" && !empty($this_w))
		foreach($temp_list as &$l)
		{
			$current_read.="$l/";
			$readfrom = $root."/".$current_read."this.kstr";
						
			if($leave_next && (bc_get_name($l,$parent) == "#" || empty(bc_get_name($l,$parent))) || 
				$leave_next && count($temp_list) == $part_i && !(bc_get_name($l,$parent) == "#" || empty(bc_get_name($l,$parent))))
				break;
			
			$bool_exist = false;
			
			if($part_i != 1)
			{
				$tmp_addr_whole .= "+$l";
				$gen_export .= " ".$string_splitter." ";
			}
			else
				$tmp_addr_whole .= $l;
			
			$gen_export .= "<span class='bcnav_p' id='$part_i'>";
				
			$tmp_get_name = bc_get_name($l,$parent);
			
			if(substr($tmp_get_name,0,3) == "ß?")
			{
				$bool_exist = true;
				
				if(file_exists($readfrom))
				{
					$file_0d = fopen($readfrom,"r");
					while(!feof($file_0d))
					{
						$tmp_addr_whole = fgets($file_0d);
						break;
					}
					fclose($file_0d);
				}
				
				$levels_got = substr($tmp_get_name,count($tmp_get_name)-2);
				
				if($levels_got == $part_i+1)
					$leave_next = true;
				
				$tmp_get_name = substr($tmp_get_name,3,-2);
				//if(count($temp_list)-1 == $part_i)
				//	$leave_next = true;
						
			}else
			if(substr($tmp_get_name,0,4) == "ßß")
			{
				$bool_exist = false;
				$tmp_get_name = substr($tmp_get_name,4);
			}else
			if(substr($tmp_get_name,0,2) == "??")
			{
				if(file_exists($readfrom))
				{
					$file_0d = fopen($readfrom,"r");
					while(!feof($file_0d))
					{
						$tmp_addr_whole = fgets($file_0d);
						break;
					}
					fclose($file_0d);
					$bool_exist = true;
				}
				else
					$bool_exist = false;
				
				if(count($temp_list)-1 == $part_i)
					$leave_next = true;
				$tmp_get_name = substr($tmp_get_name,2);
			}
			
			if(empty($tmp_get_name) || $tmp_get_name=="#")
				$tmp_get_name = $l;
			
			if($bool_href && $bool_exist)
				$gen_export .= "<a href='$tmp_addr_whole'>";
				
			$gen_export .= $tmp_get_name;
			
			if($bool_href && $bool_exist)
				$gen_export .= "</a>";
				
			$gen_export .= "</span>";
			$part_i++;
			$parent = $l;
		}
	
	$gen_export .= "</div>";
	
	file_put_contents("./cache/$varname.html" , $gen_export);
	include("./cache/$varname.html");
	
	$i = 0;
	$i = count(explode('+',$this_w));
	return $i;
}

function bc_get_name($identificator,$parent_ident)
{
	$name_ret = "#";
	$name = "#";
	$folder = "./pages";
	$line = 0;
	if(file_exists($folder."/this.kstr"))
	{	
		$file = fopen($folder."/this.kstr","r");
		while(! feof($file))
		{
			$temp = fgets($file);
			  
			if($line >= 5)
			{
				if(!empty($temp))
				{
					$skip=false;
					$tp = explode(";",$temp);
					
					if(substr($temp,0,2) == "//" && substr($temp,0,7) != "//:nav:")
						$skip=true;
					
					if(!$skip)
					{
						$ident_get_parent = "home";
						$ident_get = explode("|",$tp[0])[count(explode("|",$tp[0]))-1];
						if(count(explode("|",$tp[0]))>1)
							$ident_get_parent = explode("|",$tp[0])[count(explode("|",$tp[0]))-2];
						if(!empty($tp[count($tp)-1]))
							$name = $tp[count($tp)-1];
						
						if(substr($ident_get,0,7) == "//:nav:")
							$ident_get = substr($ident_get,7);
						if(substr($ident_get_parent,0,7) == "//:nav:")
							$ident_get_parent = substr($ident_get_parent,7);
						
						$levels = count(explode("|",$tp[0])); 
						
						if("ß#" == $ident_get && $identificator == $ident_get_parent)
							$name_ret = "ß?".$name.sprintf('%02d', $levels-1);
						else
						if("ß" == $ident_get && $identificator == $ident_get_parent)
							$name_ret = "ßß".$name;
						else
						if("#" == $ident_get && $identificator == $ident_get_parent)
							$name_ret = "??".$name;
						
						if(substr($temp,0,7) == "//:nav:")
							if($ident_get == $identificator && $parent_ident == $ident_get_parent)
								return $name;
							
						if($ident_get == $identificator && $parent_ident == $ident_get_parent)
							$name_ret = $name;
						
						//if($ident_get == $identificator && $parent_ident == $ident_get_parent)
						//echo "$ident_get == $identificator && $parent_ident == $ident_get_parent"." >> $name_ret";
					}
				}
			}
			$line++;
		}
	}
	return $name_ret;
}
	
?>