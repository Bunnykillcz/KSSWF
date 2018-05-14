<?php
function cache_clear()
{
	if(file_exists("./cache/menu.html"))
		unlink("./cache/menu.html");
	
	$dir = "./cache/";
	$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
	$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
	foreach ( $ri as $file ) {
		$file->isDir() ?  rmdir($file) : unlink($file);
	}
	
}

if(!empty($_GET['c']))
if($_GET['c'] == "1")
if(isset($_SESSION['login_admin']))
{
	savetolog("Cache cleared.");
	cache_clear();
	//$addr = $after_link;
	//$content = "home";
	//header('location:'.$addr."?w=".$content);
}
else
if(!isset($_SESSION['login_admin']))
	Infobox("Admin logon required.","warning", "", "");
?>