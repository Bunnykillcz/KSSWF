<?php 
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



?>