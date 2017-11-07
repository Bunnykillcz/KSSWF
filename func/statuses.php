<?php

if(!empty($_GET['s']))
{
$s = $_GET['s'];
	switch($s)
	{
		case 1: //cache
		infobox("Cache has been cleared.","warning");
		
		case 2: //logged in
			infobox("Admin successfully logged in.","info");
			break;
			
		case 3: //login fail
			infobox("Login unsuccessful.","warning");
			break;
			
		case 4: //logout
			infobox("Admin logged out.","info");
			break;
	}
}
?>