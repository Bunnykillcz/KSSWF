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
	$gen_export .= " ".$string_splitter." ";


	$temp_list = explode('+',$this_w);
	$part_i = 1;
	$tmp_addr_whole = "";
	foreach($temp_list as &$l)
	{
		
		if($part_i != 1)
		{
			$tmp_addr_whole .= "+$l";
			$gen_export .= " ".$string_splitter." ";
		}
		else
			$tmp_addr_whole .= "$l";
		
		$gen_export .= "<span class='bcnav_p' id='$part_i'>";
			
		if($bool_href)//EDIT HERE !! --> every href needs to check the existence of target! Otherwise set to "#";
			$gen_export .= "<a href='index.php?w=$tmp_addr_whole'>";
		
		$gen_export .= $l;
		
		if($bool_href)//EDIT HERE !! --> every href needs to check the existence of target!
			$gen_export .= "</a>";
		
		$gen_export .= "</span>";
		$part_i++;
	}
	
	$gen_export .= "</div>";
	
	file_put_contents("./cache/$varname.html" , $gen_export);
	include("./cache/$varname.html");
	
	$i = 0;
	$i = count(explode('+',$this_w));
	return $i;
}
		
	
?>