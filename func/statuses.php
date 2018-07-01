<?php

if(!empty($_GET['s']))
{
$s = $_GET['s'];
	switch($s)
	{
		case 1: //cache
			infobox("Cache has been cleared.","warning");
			break;
		
		case 2: //logged in
			infobox("Admin successfully logged in.","info");
			break;
			
		case 3: //login fail
			infobox("Login unsuccessful.","warning");
			break;
			
		case 4: //logout
			infobox("Admin logged out.","info");
			break;
			
		case 5: //Password, or name change failed
		case 51:
			infobox("ADMIN LOGON FAILED. FILE WRITE ERROR.", "error","","");
			break;
			
		case 6: //Password change succeeded
			$usrn = "";
			if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
				$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
			infobox("<b>$usrn</b> password successfully changed.", "info","","");
			break;
		case 61: //Name change succeeded
			$usrn = "";
			if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
				$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
			infobox("<b>$usrn</b> name successfully changed; please log in again with your new nickname.", "info","","");
			admin_logout(true);
			break;
	}
}
?>