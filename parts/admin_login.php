<?php 
/*--------------------------*/
/* Nikola Nejedlý - 2017/18 */
/*--------------------------*/

?>
<div class="h_admin">
<?php
	if(!empty($_GET['w']))
		$w_t_ = "?w=".$_GET['w'];
	else
		$w_t_="?w="."home";
	
if(!isset($_SESSION['login_admin']))
	echo button("Admin","$actual_link$after_link$w_t_"."&a=1",false,0,0);
if(isset($_SESSION['login_admin']))
{
	echo "<div class='editor'>";
	if($gray[1])
		echo 	"<a href='#' class='e_gray' style='color:gray;'>".icon("edit",0)."</a>";
	else	
		echo 	"<a href='"."$actual_link$after_link$w_t_"."&a=3'>".icon("edit",0)."</a>";
	
	if($gray[2])
		echo 	"<a href='#' class='e_gray' style='color:gray;'>".icon("file",0)."</a>";
	else	
		echo 	"<a href='"."$actual_link$after_link$w_t_"."&a=4'>".icon("file",0)."</a>";
	
	if($gray[3])
		echo 	"<a href='#' class='e_gray' style='color:gray;'>".icon("folder",0)."</a>";
	else	
		echo 	"<a href='"."$actual_link$after_link$w_t_"."&a=5'>".icon("folder",0)."</a>";
	
	if($gray[4])
		echo 	"<a href='#' class='e_gray' style='color:gray;'>".icon("save",0)."</a>";
	else	
		echo 	"<a href='#' onclick=\"document.getElementById('edit_form').submit();\" id='form_save'>".icon("save",0)."</a>";
	
	if($gray[5])
		echo 	"<a href='#' class='e_gray' style='color:gray;'>".icon("sign-out",0)."</a>";
	else	
		echo 	"<a href='"."$actual_link$after_link$w_t_"."&a=2"."'>".icon("sign-out",0)."</a>";
	
	echo "</div>";
	
	echo "<div class='editor_c'>";
	echo 	"<a href='"."$actual_link$after_link$w_t_"."&c=1'>".icon("magic",0).""."</a>";
	echo "</div>";
	
	echo "<div class='editor_settings'>";
	echo 	"<a href='"."$actual_link$after_link$w_t_"."&a=7'>".icon("config",0)."</a>";
	echo "</div>";
	
	$sty_le="";
	echo "<div $sty_le class='admin_log'><b>Event log:</b><br/><br/><hr>".readlog(30)."</div>";

}
?>
