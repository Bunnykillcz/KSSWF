<?php
// "pop-up" for text notifications
function confirmbox($id, $message, $result_url = "#", $posx = -1, $posy = -1) //posx & posy = int absolute position in pixels -> if -1, then default
{
	$a_t_ = "";
	if(!empty($_GET["a"]))
		if($_GET["a"] == 9)
			$a_t_ = "&a=7";
	$text=""; 
	$type=""; 
	
	global $actual_link;
	global $after_link;
	
	if(!empty($_GET['w']))
		$w_t = "?w=".$_GET['w'];
	else
		$w_t="";
	
	$gen_message = "";
	$gen_t = "";
	
	$pos = "";
	
	if($posx == -1 || $posy == -1)
		$pos = "";
	else
		$pos = "style='display: none; position: absolute; left:".$posx."px; top:".$posy."px;'";
	
	$output = "<div class='info' ".$pos.">";
	
	$gen_t=$gen_t.icon("question-circle",1);
	
	//$gen_message = $gen_message.$gen_t."<p>".$text."</p><a href='".$actual_link.$after_link.$w_t.$a_t_."'>".icon("wclose",0)."</a>";
	$gen_message = $gen_message.$gen_t."<p>".$message."</p><div class='YesNo'><a href='$result_url'>Yes".icon("check-circle")."</a><a href=\"javascript:hide_element('.info', 300);\">No".icon("ban")."</a></div>";
	$output .= $gen_message;
	$output .= "</div>";
	
	echo $output;
}
?>