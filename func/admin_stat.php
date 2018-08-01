<?php 
//admin stuff
//------------------------------------------------//
// 				Nikola Nejedlý - 2017/18		  //
//------------------------------------------------//

$error = "";
$addr = $after_link;
global $salt;

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
		$s_output = str_replace("<p>&nbsp;</p>", "", str_replace("&!quot;", "&quot;", str_replace("&!#039;", "&#039;", str_replace("&!lt;", "&lt;", str_replace("&!gt;", "&gt;", str_replace("&!amp;", "&amp;", 
					htmlspecialchars_decode(str_replace("<_php", "<?php", str_replace("_>", "?>", str_replace("&lt;_php", "<?php", str_replace("_&gt;", "?>", $s_input)))))))))));
	
	return $s_output;
}

function admin_logout($silent = false)
{
	global $after_link;
	$addr = $after_link;
	$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	if(session_destroy()) 
	{
		if(!$silent)
			redirect($addr."?w=home&s=4",false);
		else
			savetolog("<span style='color:#af0000;'><b>$usrn</b> has been logged out.</span>");
	}	
	else
	{
		savetolog("<span style='color:orange;'><b>$usrn</b></span> failed to log out.");	
	}	
}

function admin_newname($newname, $passwd) 
{
	global $after_link;
	global $salt;
	$addr = $after_link;
	$fil_ = "./admin/admin_login.pwd";
	
	if(!file_exists($fil_))
	{
		infobox("OPERATION IMPOSSIBLE. FILE NOT FOUND.", "error","","");
		return 5;
	}
	
	$usrn = "";
	if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	if(empty($usrn))	
		return 1;
	
	$username = stripcslashes(htmlspecialchars(trim($usrn)));
	$username = md5($username);
	
	$userID = -1;
	$passID = -1;
	$priv = "";
	$file = "";
	
	$password = $passwd;
	$password = stripcslashes(htmlspecialchars(trim($password)));
	$password = $password.$salt;
	$password = md5($password);
	$password = strrev($password);
	
	$admin = false;
	
	$handle = fopen($fil_, "r");
	if ($handle) 
	{
		$id = 0;
		while(!feof($handle))
		{
			$line = fgets($handle); 
			$trimline = stripcslashes(trim($line));
			if($username == $trimline)
			{
				$userID = $id;
			}
			else
			if($id == $userID+1 && $password == $trimline)
			{
				$passID = $id;
			}
			else
			if($id == $userID+2 && $id == $passID+1)
			{
				$priv = $trimline;
				
				$priv_name = explode(";",$priv)[2];
				
				$username_ex = stripcslashes(htmlspecialchars(trim(decrypt_caesar($priv_name,37))));
				$username_ex = md5($username_ex);
				
				if($username_ex != $username)
				{
					savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change name. Access violation! ");	
					fclose($handle);
					return 5;
				}
				
				$new_enc_name = encrypt_caesar($newname,37);
				$usernewname = stripcslashes(htmlspecialchars(trim($newname)));
				$usernewname = md5($usernewname);
				
				$priv = explode(";",$priv)[0].";".explode(";",$priv)[1].";".$new_enc_name;
				
				
				$admin = true;
			}
			else
				$file .= $trimline."\r\n";
			
			$id++;
		}
    }
	else
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change name. File not accessed.");	
		fclose($handle);
		return 4;
	}
	
	fclose($handle);
	
	if(!$admin)
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change name. Incorrect password?");	
		return 2;
	}
		
	$file .= $usernewname."\r\n".$password."\r\n".$priv; //generated filedata
	
	$ret = file_put_contents($fil_, $file);
	
	if($ret == 1 || $ret){
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:green;'>successfully</span> changed name to <span style='color:black;'><b>$newname</b></span>.");	
		redirect($addr."?w=home&s=61&a=7", false);
		return 0;
	}
	else
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change name. Write error.");	
		redirect($addr."?w=home&s=51&a=7", false);
		return 3;
	}
	
}

function admin_newpass($newpass, $oldpass) //returns: 1 = no-login;  2 = incorrect password (?); 4 = file not accessed; 3 = write error; 0 = success;
{	
	
	global $after_link;
	global $salt;
	$addr = $after_link;
	$fil_ = "./admin/admin_login.pwd";
	
	if(!file_exists($fil_))
	{
		infobox("OPERATION IMPOSSIBLE. FILE NOT FOUND.", "error","","");
		return 6;
	}
		
	$usrn = "";
	if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	if(empty($usrn))	
		return 1;
	
	$username = stripcslashes(htmlspecialchars(trim($usrn)));
	$username = md5($username);
	
	$userID = -1;
	$passID = -1;
	$priv = "";
	$file = "";
	
	$password = $oldpass;
	$password = stripcslashes(htmlspecialchars(trim($password)));
	$password = $password.$salt;
	$password = md5($password);
	$password = strrev($password);
	
	$admin = false;
	
	$handle = fopen($fil_, "r");
	if ($handle) 
	{
		$id = 0;
		while(!feof($handle))
		{
			$line = fgets($handle); 
			$trimline = stripcslashes(trim($line));
			if($username == $trimline)
			{
				$userID = $id;
			}
			else
			if($id == $userID+1 && $password == $trimline)
			{
				$passID = $id;
			}
			else
			if($id == $userID+2 && $id == $passID+1)
			{
				$priv = $trimline;
				
				$priv_name = explode(";",$priv)[2];
				
				$username_ex = stripcslashes(htmlspecialchars(trim(decrypt_caesar($priv_name,37))));
				$username_ex = md5($username_ex);
				
				if($username_ex != $username)
				{
					savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change password. Access violation! ");	
					fclose($handle);
					return 5;
				}
				$admin = true;
			}
			else
				$file .= $trimline."\r\n";
			
			$id++;
		}
    }
	else
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change password. File not accessed.");	
		fclose($handle);
		return 4;
	}
	
	fclose($handle);
	
	if(!$admin)
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change password. Incorrect password?");	
		return 2;
	}
	
	$passwordn = $newpass;
	$passwordn = stripcslashes(htmlspecialchars(trim($passwordn)));
	$passwordn = $passwordn.$salt;
	$passwordn = md5($passwordn);
	$passwordn = strrev($passwordn);
	
	$file .= $username."\r\n".$passwordn."\r\n".$priv; //generated filedata
	
	$ret = file_put_contents($fil_, $file);
	
	if($ret == 1 || $ret){
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:green;'>successfully</span> changed password.");	
		redirect($addr."?w=home&s=6&a=7", false);
		return 0;
	}
	else
	{
		savetolog("<span style='color:black;'><b>$usrn</b></span> <span style='color:red;'>failed</span> to change password. Write error.");	
		redirect($addr."?w=home&s=5&a=7", false);
		return 3;
	}
}
function admin_reset_users($defu, $defp, $priv = "")
{	
	
	global $after_link;
	global $salt;
	$addr = $after_link;
	$fil_ = "./admin/admin_login.pwd";
	
	if(empty($priv))
		$priv = "7;0;".encrypt_caesar($defu,37);
	
	/*if(!file_exists($fil_))
	{
		infobox("OPERATION IMPOSSIBLE. FILE NOT FOUND.", "error","","");
		return 6;
	}*/
		
	$usrn = "";
	if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
		$usrn = $_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))];
	
	if(empty($usrn))	
		return 1;
	
	$usrn_l = $usrn;
	$usrn = $defu;	
	$username = stripcslashes(htmlspecialchars(trim($usrn)));
	$username = md5($username);
	
	$userID = -1;
	$passID = -1;
	$file = "";
	
	$password = $defp;
	$password = stripcslashes(htmlspecialchars(trim($password)));
	$password = $password.$salt;
	$password = md5($password);
	$password = strrev($password);
	
	
		
	$file = $username."\r\n".$password."\r\n".$priv; //generated filedata
	
	$ret = file_put_contents($fil_, $file);
	
	if($ret == 1 || $ret){
		savetolog("<span style='color:black;'><b>$usrn_l</b></span> has <span style='color:red;'>RESET ALL USERS</span>.");	
		redirect($addr."?w=home", false);
		return 0;
	}
	else
	{
		savetolog("<span style='color:black;'><b>$usrn_l</b></span> has <span style='color:red;'>failed</span> to RESET ALL USERS.");		
		redirect($addr."?w=home", false);
		return 3;
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
			savetolog("<span style='color:green;'><b>$uunn</b></span> logged in.");
			redirect($addr."?w=home&s=2&a=7",false);
		}
	}
}

//-----------------------------------------------    << $_GET

if(!empty($_GET['a']))
{
	$a = $_GET['a'];
	
	//if not logging in ( = you're not admin) do nothing!
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
		$form .= "<label style='display: inline-block; position: relative; bottom: 22px; left: -30px; margin: 0; padding: 0;'>".icon("user",0)." </label><input type='text' id='name' name='username' placeholder='username'></input><br/>";
		$form .= "<label style='display: inline-block; position: relative; bottom: 22px; left: -30px; margin: 0; padding: 0;'>".icon("key",0)." </label><input type='password' id='password' placeholder='***' name='password'></input><br/>";
		$form .= "<input type='submit' name='submit' value='login' style='border: 1px black solid;'></input></form></div>";
		$form .= $error;
		
		infobox($form,"none");
		break;
		
	case 2:
		savetolog("<span style='color:#af0000;'><b>$usrn</b> logged out.</span>");
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
		if(!empty($_POST["editor_field"]))
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
				if(str_replace(' ', '/', $content_) == "home")
					$new_name = "home";
				
				if(!empty($new_name))
				{
					savetolog("<b>$usrn</b> edited: ./pages/".str_replace(' ', '/', $new_name).".php");
					redirect($addr."?w=$new_name&a=61", false);
				}
				else
				{
					savetolog("<b>$usrn</b> tried to edit: './pages/".str_replace(' ', '/', $content_).".php', but the name went blank!");
					$admin_message .= "Error: Operation failed!";
				}
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
	//## Happens in "body.php"
		break;
	case 8: //revert to backup
		break;
	
	case 9: //change password	
		if (!empty($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (!empty($_POST["pass_old"]) && !empty($_POST["pass_new"]))
			{
				$a = admin_newpass($_POST["pass_new"], $_POST["pass_old"]); 
				
				//1 = no-login;  2 = incorrect password (?); 4 = file not accessed; 3 = write error; 0 = success;
				switch($a)
				{
					default:
					case 0:
					break;
					
					case 1:
						infobox("Not logged in","error");
					break;
					case 2:
						infobox("Incorrect (old) password! No changes were made.","warning");
					break;
					case 3:
						infobox("Write error; Try again.","error");
					break;
					case 4:
						infobox("File not accessible!","error");
					break;
					case 5:
						infobox("Access violation or broken file coding!","error");
					break;
					case 6:
						infobox("File not accessible!","error");
					break;
				}
				
			}
		}
		else
		{
			$form = icon("key",1);
			$form .= "<div class='right' style='padding:7px; right:30px; font-weight: bold;'>";
			$form .= "<form action='' method='post'><b><u>Change password for <span style='color: green'>$usrn:</span></u></b><br/>";
			$form .= "<label style='display: inline-block; position: relative; bottom: 0; left: -4px; margin: 0; padding: 0;'>old</label><input type='password' id='pass_old' placeholder='***' name='pass_old'></input><br/>";
			$form .= "<label style='display: inline-block; position: relative; bottom: 0; left: -4px; margin: 0; padding: 0;'>new</label><input type='password' id='pass_new' placeholder='***' name='pass_new'></input><br/>";
			$form .= "<input type='submit' name='submit' value='change' style='border: 1px black solid;'></input></form></div>";
			
			infobox($form,"none");
		}
		break;
		
	case 91: //change name
		if (!empty($_POST) && $_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (!empty($_POST["newname"]) && !empty($_POST["passwd"]))
			{
				$a = admin_newname($_POST["newname"], $_POST["passwd"]); 
				
				switch($a)
				{
					default:
					case 0:
					break;
					
					case 1:
						infobox("Not logged in","error");
					break;
					case 2:
						infobox("Incorrect password! No changes were made.","warning");
					break;
					case 3:
						infobox("Write error; Try again.","error");
					break;
					case 4:
						infobox("File not accessible!","error");
					break;
					case 5:
						infobox("Access violation or broken file coding!","error");
					break;
					case 6:
						infobox("File not accessible!","error");
					break;
				}
				
			}
		}
		else
		{
			$form = icon("card-o",1);
			$form .= "<div class='right' style='padding:7px; right:30px; font-weight: bold;'>";
			$form .= "<form action='' method='post'><b><u>Change nickname for <span style='color: green'>$usrn:</span></u></b><br/>";
			$form .= "<label style='display: inline-block; position: relative; bottom: 0; left: -4px; margin: 0; padding: 0;'>new</label><input type='text' id='newname' placeholder='your new username' name='newname'></input><br/>";
			$form .= "<label style='display: inline-block; position: relative; bottom: 0; left: -4px; margin: 0; padding: 0;'>pwd</label><input type='password' id='passwd' placeholder='***' name='passwd'></input><br/>";
			$form .= "<input type='submit' name='submit' value='change' style='border: 1px black solid;'></input></form></div>";
			
			infobox($form,"none");
		}
		break;
	case 9937519: //reset userfile
		admin_reset_users("admin","admin");
		break;
	}
	
	echo $admin_message."</div>";
}


?>