<?php
if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))])) //if admin logged in 
{
	$a = 0;
	if(!empty($_GET['a']))
		$a = $_GET['a'];
	if($a == 3)
	{
		echo "<link rel='stylesheet' href='./addons/RichTextEditor/src/richtext.min.css'>";
	}
}

include("./cache/c_font_init.php");

if(file_exists($template."/style.css"))
echo "<link rel='stylesheet' type='text/css' href='$template/style.css' />";
//if(file_exists($template."/style-print.css"))
//echo "<link rel='stylesheet' type='text/css' href='$template/style-print.css'>";
echo "<link rel='shortcut icon' href='$favicon' type='image/x-icon' />";

if(file_exists($template."/components/")){
	
	/*
	$files = scandir($template."/components/");
	$linker = "";
	
	foreach($files as &$file)
	{
		$temp = explode(".",$file);
		if($temp[count($temp)-1] == "css")
		{
			$linker .= "<link rel='stylesheet' type='text/css' href='$template/components/$file' />";
		}
	}
	*/
	if(!file_exists("./cache/css-full.css"))
		mk_cache_css();
	
	$linker = "<link rel='stylesheet' type='text/css' href='./cache/css-full.css' />";
	echo $linker;
}
	

?>