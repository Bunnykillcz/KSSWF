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

function convert_php_headers($s_input, $b_encode)
{
	$s_output = "";
	
	if($b_encode)//, ; (when ENT_NOQUOTES is not set),  (when ENT_QUOTES is set),  and ;.
		$s_output = str_replace("&quot;", "&!quot;", str_replace("&#039;", "&!#039;", str_replace("&lt;", "&!lt;", str_replace("&gt;", "&!gt;", str_replace("&amp;", "&!amp;", 
					str_replace("<?php", "<_php", str_replace("?>", "_>", $s_input)))))));
	else //b_decode
		$s_output = str_replace("&!quot;", "&quot;", str_replace("&!#039;", "&#039;", str_replace("&!lt;", "&lt;", str_replace("&!gt;", "&gt;", str_replace("&!amp;", "&amp;", 
					htmlspecialchars_decode(str_replace("<_php", "<?php", str_replace("_>", "?>", str_replace("&lt;_php", "<?php", str_replace("_&gt;", "?>", $s_input))))))))));
	
	return $s_output;
}

function admin_logout()
{
	global $after_link;
	$addr = $after_link;
	
	if(session_destroy()) 
	{
		header('location:'.$addr."?w=home&s=4");
	}	
	else
	{
		$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
		savetolog("<span style='color:orange;'>$usrn</span> failed to log out.");	
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
			$_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))] = $uunn;
			savetolog("<span style='color:green;'>$uunn</span> logged in.");
			header('location:'.$addr."?w=home&s=2");
		}
	}
}

//-----------------------------------------------    << $_GET

if(!empty($_GET['a']))
{
	$a = $_GET['a'];
	
	if($a > 1)
	{
		if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
			return 0;
		
		$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	}
	
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
		savetolog("<span style='color:#af0000;'>".$usrn." logged out.</span>");
		admin_logout();
		break;
		
	case 3: //edit page
		$endclude .= "<script>CKEDITOR.replace( 'editor_field' );</script>";
		$admin_message .= "Editing: ./pages/".str_replace(' ', '/', $content_).".php";
		$admin_message .= "<br/><br/><br/><span style='color: #af0000;'>Don't forget to save your changes!</span>";
		break;
		
	case 4: //new file
		break;
		
	case 5: //new folder
		break;
		
	case 6: //saving $_POST form
		if (!empty($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
		{
			$content = str_replace('%20', '/', $content_);
			
			global $admin_create_backups;
			
			if($admin_create_backups)
			{
				$backup_file = file_get_contents("./pages/".str_replace(' ', '/', $content_).".php");
				file_put_contents("./pages/bcp_".str_replace(' ', '/', $content_).".php_bcp",$backup_file);
				savetolog("AutoBackup: ./pages/bcp_".str_replace(' ', '/', $content_).".php_bcp");
			}
			
			$new_data = convert_php_headers($_POST["editor_field"], false);
			$name = "./pages/".str_replace(' ', '/', $content_).".php";
			file_put_contents($name, $new_data);
			
			$new_name = trim(htmlspecialchars($_POST['filename']));
						
			if(str_replace(' ', '/', $new_name) == str_replace(' ', '/', $content_) || rename("./pages/".str_replace(' ', '/', $content_).".php", "./pages/".str_replace(' ', '/', $new_name).".php"))
			{
				savetolog("<b>$usrn</b> edited: ./pages/".str_replace(' ', '/', $new_name).".php");
				header('location:'.$addr."?w=$new_name&a=61");
			}
			else
			{
				savetolog("<b>$usrn</b> tried to edit: './pages/".str_replace(' ', '/', $content_).".php', but the operation failed.");
				$admin_message .= "Error: Operation failed!";
			}
		}
		else
			$admin_message .= "Error: Empty handlers sent!";
		
		break;
	case 61:
			$admin_message .= "Saved as: ./pages/".str_replace(' ', '/', $content_).".php";
		break;
		
	case 7: //settings
		break;
		
	case 8: //revert to backup
		break;
		
	}
	echo $admin_message."</div>";
}


?>