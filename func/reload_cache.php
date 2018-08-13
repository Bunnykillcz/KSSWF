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
	$c_htaccess = "Options -Indexes \r\n
					Order Deny,Allow\r\n
					Allow from all";
	
	file_put_contents("./cache/.htaccess",$c_htaccess);
	
}
function cache_clear_only($path)
{
	$dir = "./cache/$path";
	$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
	$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
	foreach ( $ri as $file ) {
		$file->isDir() ?  rmdir($file) : unlink($file);
	}
}


if(!empty($_GET['c']))
	if($_GET['c'] == "1")
		if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		{
			$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
			savetolog("Cache cleared by <b>$usrn</b>.");
			cache_clear();
		}
		else
		if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
			Infobox("Admin logon required.","warning", "", "");
?>