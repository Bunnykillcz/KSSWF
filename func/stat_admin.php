<?php 
//admin stuff
//------------------------------------------------//
// 				Nikola Nejedlý - 2017/18		  //
//------------------------------------------------//

$error = "";
$addr = $after_link;

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
		$password=$_POST['password'];
		$username = stripslashes($username);
		$password = stripslashes($password);
		//CHECK IF ADMIN !!!
		$_SESSION['login_admin']=$username;
		header('location:'.$addr."?w=home&s=2");
	}
}
//-----------------------------------------------    << $_GET

if(!empty($_GET['a']))
{
$a = $_GET['a'];

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
		admin_logout();
		break;
		
	case 3: //edit page
		break;
		
	case 4: //new file
		break;
		
	case 5: //new folder
		break;
		
	case 6: //save
		break;
		
	}
}
?>