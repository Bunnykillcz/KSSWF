<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'/>
<link href='https://fonts.googleapis.com/css?family=Fira+Sans' rel='stylesheet'/> 
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'/>
<link href='https://fonts.googleapis.com/css?family=Monofett' rel='stylesheet'/>
<link href='https://fonts.googleapis.com/css?family=Cormorant+SC' rel='stylesheet'/>
<link href='https://fonts.googleapis.com/css?family=Kelly+Slab' rel='stylesheet'/> 
<link href='https://fonts.googleapis.com/css?family=Aladin' rel='stylesheet'/>
<link href='https://fonts.googleapis.com/css?family=IM+Fell+English+SC' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Alegreya+Sans+SC' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=BioRhyme' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' /> 
<?php
if(file_exists($template."/style.css"))
echo "<link rel='stylesheet' type='text/css' href='$template/style.css'>";
//if(file_exists($template."/style-print.css"))
//echo "<link rel='stylesheet' type='text/css' href='$template/style-print.css'>";
echo "<link rel='shortcut icon' href='$favicon' type='image/x-icon'/>";

if(file_exists($template."/components/")){
	$files = scandir($template."/components/");
	
	foreach($files as &$file)
	{
		$temp = explode(".",$file);
		if($temp[count($temp)-1] == "css")
		{
			echo "<link rel='stylesheet' type='text/css' href='$template/components/$file'>";
		}
	}
}
	

?>