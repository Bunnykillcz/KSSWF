<?php
// "pop-up" for text notifications
function infobox($text, $type) //text = "Hi, my name is Bill"; type = "warning", "info"(default), "none" 
{
	global $actual_link;
	global $after_link;
	
	if(!empty($_GET['w']))
		$w_t = "?w=".$_GET['w'];
	else
		$w_t="";
	
	$gen_message = "";
	$gen_t = "";
	
	echo "<div class='info'>";
	
	if($type == "none")
		$gen_t=$gen_t."";
	else
	if($type == "warning")
		$gen_t=$gen_t.icon("warning",1);
	else
		$gen_t=$gen_t.icon("info",1);
	
	

	$gen_message = $gen_message.$gen_t."<p>".$text."</p><a href='".$actual_link.$after_link.$w_t."'>".icon("wclose",0)."</a>";
	echo $gen_message;
	echo "</div>";
}
?>