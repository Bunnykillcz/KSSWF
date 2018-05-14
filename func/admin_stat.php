<?php 
//admin stuff
//------------------------------------------------//
// 				Nikola Nejedlý - 2017/18		  //
//------------------------------------------------//

$error = "";
$addr = $after_link;
$salt = "Žluťoučký kůň úpěl ďábelské ódy!";

$content_ = "";
if(!empty($_GET['w']))
	$content_ = $_GET['w'];
$content_ = str_replace('%20', '/', str_replace('+', '/', $content_));

//-----------------------------------------------    << Functions

function admin_logout()
{
	global $after_link;
	$addr = $after_link;
	
	//session_start();
	if(session_destroy()) 
	{
		header('location:'.$addr."?w=home&s=4");
	}	
}

//-----------------------------------------------    << $_POST
if (isset($_POST['submit'])) 
{
	if (empty($_POST['username']) || empty($_POST['password'])) 
	{
		$error = "<div style='display:block; color:red; padding-left:12px; '>Username or Password is invalid.</div>";
	}
	else
	{
		$username=$_POST['username'];
		$uunn = $username;
		$password=$_POST['password'];
		$username = stripcslashes(htmlspecialchars(trim($username)));
		$password = stripcslashes(htmlspecialchars(trim($password)));
		$isadmin = false;
		
		$password = $password.$salt;
		$password = md5($password);
		$password = strrev($password);
		$username = md5($username);
		
		//Infobox("N: ".$username."<br>P: ".$password, "info", "", "");

		
		$fil_ = "./admin/admin_login.pwd";
		$i = 0;
		$e = 0;
		$untest = "";
		$pwtest = "";

		if(!file_exists($fil_))
		{
			infobox("ADMIN LOGON IMPOSSIBLE. FILE NOT FOUND.", "error","","");
			return 0;
		}
		else
		{
			$file_r = fopen($fil_,"r");
			while(! feof($file_r))
			{
				$temp = fgets($file_r);
				  
				if($i == 0)
				{ 
					$untest = trim($temp);
				}
				else
				if($i == 1)
				{ 
					$pwtest = trim($temp);
				}
				
				$i++;
			}
			fclose($file_r);
		}
		
		if(trim($username) != $untest)
			$e++;
		if(trim($password) != $pwtest)
			$e++;
		
		
		if($e == 0)
			$isadmin = true;
		else
			$error = "<div style='display:block; color:red; padding-left:12px; '>Username or Password is incorrect. </div>";
		
		
		if($isadmin)
		{
			savetolog("<span style='color:green;'>$uunn</span> logged in.");
			$_SESSION['login_admin']=$username;
			header('location:'.$addr."?w=home&s=2");
		}
	}
}

//-----------------------------------------------    << $_GET

if(!empty($_GET['a']))
{
	$a = $_GET['a'];
	
	if($a > 1)
	if(!isset($_SESSION['login_admin']))
		return 0;
	
	$admin_message = "<div style='min-height: 320px; border: 1px solid transparent; z-index: 5; background: none; display: block; position: absolute; width: 200px; font-size: 8px; right: 0px; top: 32px; padding: 2px; margin: 2px; white-space: none; text-align: right; color: white;'>";

	switch($a){
	default: 
		break;
		
	case 1: //login
		$form  = "<div class='right' style='padding:7px; right:30px;font-weight: bold;'>";
		$form .= "<form action='' method='post'><b><u>Admin login:</u></b><br/>";
		$form .= "<label>N: </label><input type='text' id='name' name='username' placeholder='username'></input><br/>";
		$form .= "<label>P: </label><input type='password' id='password' placeholder='***' name='password'></input><br/>";
		$form .= "<input type='submit' name='submit' value='login' style='border: 1px black solid;'></input></form></div>";
		$form .= $error;
		
		infobox($form,"none");
		break;
		
	case 2:
		savetolog("<span style='color:#af0000;'>admin logged out.</span>");
		admin_logout();
		break;
		
	case 3: //edit page
		$endclude .= "<script>
			$(document).ready(
			function() {
				$('.to_edit').richText();
			});
		</script>";
		$admin_message .= "Editing: ./pages/".str_replace(' ', '/', $content_).".php";
		$admin_message .= "<br/><br/><br/><span style='color: #af0000;'>Don't forget to save your changes!</span>";
		break;
		
	case 4: //new file
		break;
		
	case 5: //new folder
		break;
		
	case 6: //saving $_POST form
	
	
		$admin_message .= "Saved as: ./pages/".str_replace(' ', '/', $content_).".php";
		savetolog("Edited: ./pages/".str_replace(' ', '/', $content_).".php");
		
		
		break;
		
	case 6: //settings
		break;
		
	}
	echo $admin_message."</div>";
}

function readlog($lines)
{
	$log_addr = "./admin/log.txt";
	$data = explode("\n",file_get_contents($log_addr),$lines+1);
	if($lines == 0 || $lines == -1)
		$data = explode("\n",file_get_contents($log_addr));

	$out  = "";
	$i = 1;
	foreach($data as $d)
	if(!empty($d))
	{
		if($i < $lines+1)
			$out .= sprintf("%02d",$i)."> $d <br/>\n";
		else
		if($i == $lines+1)
			$out .= "(log limit = ".$lines.") ... <br/>\n";
		$i++;
	}
	
	return $out;
}

function savetolog($string_add)
{
    date_default_timezone_set('Europe/Prague');
	$date = date('d.m.Y');
	$time = date('H:i:s');
	$string_out = "$date | $time | ".$string_add."\n";
	$log_addr = "./admin/log.txt";
	
	$old_data = file_get_contents($log_addr);
	$log_op = fopen($log_addr, "w");
		fwrite($log_op, $string_out);
		fwrite($log_op, $old_data);
	fclose($log_op);	
}



?>