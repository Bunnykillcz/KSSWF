<div class="text_area">

<?php 
unset($_GET['er']);

$hidden = false;
$content_ = "";
$er404r = "";
$ps = -1;
if(isset($_GET['w']))
	$content_ = $_GET['w'];
if(isset($_GET['ps']))
	$ps = $_GET['ps'];

$getA = 0;
if(!empty($_GET['a']))
	$getA = $_GET['a'];

if($content_ == "index" )
	$content_ = "home";

if(is_numeric($ps) && $ps >= 0)
	$hidden = true;


if(!$hidden)
	echo "<div id='txt'><br>";
else
	echo "<div style='display: none;'>";
	
if(empty($_GET['er']))
	if(empty($content_) && empty($_GET['c']))
	{
		$addr = $after_link;
		$content_ = "home";
		
		$this_w = "home";
		if(file_exists("./pages/".$content_.".php"))
		{
			if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
			if($getA != 3 && $getA != 7 && $getA != 9)
			/*{
				echo "<form id='edit_form'><textarea class='to_edit' name='editor_field'>";
				echo file_get_contents("./pages/".$content_.".php");
				echo "</textarea></form>";
			}
			else*/
				include("./pages/".$content_.".php");
		
			if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
				include("./pages/".$content_.".php");
		}
	}
	else
	if(!empty($content_) || !empty($_GET['c']))
	{
		/*if(!empty($_GET['c']))
		{
			$content_ = "home";
		}*/
		
		$content_ = str_replace(' ', '+', $content_);
		$content_ = str_replace('+', '/', $content_);
		if(file_exists("./pages/".$content_.".php"))
		{
			if(isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
				if($getA == 3)
				{	
					$w_t = "";
					$gray[1] = true;
					$gray[4] = false;
					$gray[5] = false;
					
					if(!empty($_GET['w']))
						$w_t_ = "?w=".$_GET['w'];
					else
						$w_t_="?w="."home";
					
					$disnm = "";
					//disnm = filename input disable
					
					if($content_ == "home" || $content_ == "index" || $content_ == "")
						$disnm = "disabled='true'";
					
					echo "<form id='edit_form' action='"."$actual_link$after_link$w_t_"."&a=6"."' method='post'><textarea class='to_edit' id='editor_field' name='editor_field'>";
					echo convert_php_headers(file_get_contents("./pages/".$content_.".php"), true);
					echo "</textarea>";
					echo "<div class='edit_filename'>Filename: <input name='filename' $disnm type='text' value='$content_' ></div>";
					echo "</form>";
				}
				else
				if($getA == 7 || $getA == 9)
				{				
					if(file_exists("./admin/settings.php"))
						include("./admin/settings.php");
				}
				else
				include("./pages/".$content_.".php");
			
			if(!isset($_SESSION["login_admin".md5($_SERVER['HTTP_HOST'].trim($_SERVER['PHP_SELF']))]))
				include("./pages/".$content_.".php");
			
		}else
		{
			$er404r = $content_;
			include("./error/error.php");
		}
	}
if(!empty($_GET['er']))
	include("./error/error.php");

	
?></div>
<?php

if($hidden)
{
	if(file_exists("./cache/PS/ps_$ps.php"))
	{
		include("./cache/PS/ps_$ps.php");
	}
	else
	if(isset($_GET['ps']))
	{
		$_GET['er'] = 404;
		echo "<div id = 'txt'><br>";
		include("./error/error.php");
		echo "</div>";
	}
}

?>
</div>