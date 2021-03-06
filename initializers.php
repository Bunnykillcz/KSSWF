<?php 
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$after_link  = htmlspecialchars(trim($_SERVER['PHP_SELF']));
$root_link	 = getcwd();
$subtitle 	 = "";
$this_w		 = "";
$endclude 	 = "";
$ad_priv	 =  0;

$global_locale		= "cs-CZ"; 
//list of locales available at: https://stackoverflow.com/questions/3191664/list-of-all-locales-and-their-short-codes
setlocale(LC_TIME, $global_locale);
date_default_timezone_set($default_timezone);
//List of timezones available at: http://php.net/manual/en/timezones.php

if(!empty($_GET['w']))
	$this_w	= str_replace("%20","+", str_replace(" ","+", $_GET['w']));
$imageid 	 = 0;
$this_con = array(); 

session_start([
    'cookie_lifetime' => $admin_logon_time,
    'read_and_close'  => true
]);
session_cache_limiter('private');
session_cache_expire($admin_logon_time);

include("./func/.app.php"); 

if(strpos($actual_link, "//localhost") == 0) //if localhosting, don't use BASE
	echo "<base href='/' />";

$gray = array(0, false, false, false, true, true, false); //init for editor graying
include("./func/all_func_loader.php"); 
include("./func/setup.php"); 
?>
<head>
<meta charset="UTF-8"/>
<meta name="description" content="<?php echo $description.':'.$subtitle;?>">
<meta name="keywords" content="<?php echo $tags;?>">
<meta name="author" content="<?php echo $author;?>">

<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1">
<?php

if(!file_exists("./cache/menu.html"))
{
	$addr = $after_link;
	include("./func/gen_menu.php");
	redirect($addr."?w=home&s=1", false);
}

include("./func/js_load.php");
?>
<style>
body{
	margin: 0;
<?php echo "background-color: $bg_color;";?>
<?php if(file_exists($bg_image)) echo "background-image: url('$bg_image');"; ?>
}
</style>
<?php

get_title(true);
?>
</head>
<body>
<?php 

include("./parts/header.php");
if(file_exists("./cache/menu.html"))
	include("./cache/menu.html");
include("./parts/body.php");

include("./parts/footer.php");

file_put_contents("./cache/endclude.html" , $endclude);
include("./cache/endclude.html");

include("./parts/admin_login.php");

echo "<div class='loadicon' id='loading' style='display: none;'>".icon("rot-loading",2)."</div>";
?>