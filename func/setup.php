<?php 
//set responsibility

$responsive = FALSE;
$init_scale = 1.0;

if(file_exists($template."/this.kstr"))
{
	$file_ = fopen($template."/this.kstr","r");
	$line = 0;
	while(! feof($file_))
	{
		$temp_ = fgets($file_);
		if($line == 1)
			if(clean($temp_) == "TRUE"){$responsive = TRUE;}
		
		if($line == 3)
			if($responsive){$init_scale = intval(cleannum($temp));}
		
		//echo "line".$line." - R:".$responsive."+".$init_scale.":".$temp_."<br/>";
	$line++;
	}
	fclose($file_);
}

//get title

function get_title()
{
	global $content;
	global $subtitle;
	global $title;
	
	if(!empty($_GET['w']))
		$content = $_GET['w'];

	if($content == "index" )
		$content = "home";

	$subtitle = explode("/",$content)[count(explode("/",$content))-1];

	if(!empty($subtitle))
		echo "<title>$title | $subtitle</title>";
	else
		echo "<title>$title</title>";
}

?>