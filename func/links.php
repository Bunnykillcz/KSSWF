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
<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Modak' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Concert+One' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Playball' rel='stylesheet' /> 
<link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' />
 

<?php

if(isset($_SESSION['login_admin'])) //if admin logged in 
{
	$a = 0;
	if(!empty($_GET['a']))
		$a = $_GET['a'];
	if($a == 3)
	{
		echo "<link rel='stylesheet' href='./addons/RichTextEditor/src/richtext.min.css'>";
	}
}

if(file_exists($template."/style.css"))
echo "<link rel='stylesheet' type='text/css' href='$template/style.css' />";
//if(file_exists($template."/style-print.css"))
//echo "<link rel='stylesheet' type='text/css' href='$template/style-print.css'>";
echo "<link rel='shortcut icon' href='$favicon' type='image/x-icon' />";

if(file_exists($template."/components/")){
	$files = scandir($template."/components/");
	
	foreach($files as &$file)
	{
		$temp = explode(".",$file);
		if($temp[count($temp)-1] == "css")
		{
			echo "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
		}
	}
}
	

?>