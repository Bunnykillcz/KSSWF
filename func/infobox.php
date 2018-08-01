<?php
// "pop-up" for text notifications
function infobox() //text = "Hi, my name is ... Bodega!"; type = "error", "warning", "info"(default), "none" ; posx & posy = int absolute position -> if -1, then default
{
	$a_t_ = "";
	if(!empty($_GET["a"]))
		if($_GET["a"] == 9)
			$a_t_ = "&a=7";
	$text=""; 
	$type=""; 
	$posx="-1";
	$posy="-1";
	
	if(func_num_args() < 2 || func_num_args() > 4)
	{
		infobox("Wrong use of function <b>infobox()</b>!<br/>ERROR: Wrong amount of parameters! :[".func_num_args()."|of2-4]:","error");
		return 0;
	}
	//function overloading
	for ($i = 0; $i < func_num_args(); $i++) {
		switch($i){
			case 0: $text = func_get_arg($i); break;
			case 1: $type = func_get_arg($i); break;
			case 2: $posx = func_get_arg($i); break;
			case 3: $posy = func_get_arg($i); break;			
		}		
    }
	//overload end
	
	global $actual_link;
	global $after_link;
	
	if(!empty($_GET['w']))
		$w_t = "?w=".$_GET['w'];
	else
		$w_t="";
	
	$gen_message = "";
	$gen_t = "";
	
	$pos = "";
	
	if($posx == "-1" || $posy == "-1")
		$pos = "";
	else
		$pos = "style='position: absolute; left:".$posx."; top:".$posy.";'";
	
	echo "<div class='info' ".$pos.">";
	
	if($type == "none")
		$gen_t=$gen_t."";
	else
	if($type == "warning")
		$gen_t=$gen_t.icon("warning",1);
	else
	if($type == "error")
		$gen_t=$gen_t.icon("error",1);
	else
		$gen_t=$gen_t.icon("info",1);
	
	

	//$gen_message = $gen_message.$gen_t."<p>".$text."</p><a href='".$actual_link.$after_link.$w_t.$a_t_."'>".icon("wclose",0)."</a>";
	$gen_message = $gen_message.$gen_t."<p>".$text."</p><a href=\"javascript:hide_element('.info', 300);\">".icon("wclose",0)."</a>";
	echo $gen_message;
	echo "</div>";
}
?>