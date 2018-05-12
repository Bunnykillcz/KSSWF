<?php 
/*-----------------------*/
/* Nikola Nejedlý - 2017 */
/*-----------------------*/

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
	echo "<div class='editor' style='z-index: 99000; display:block; width: 150px; height: 32px; left: Calc( 50vw - 75px ); position: fixed; top: Calc( 100vh - 28px ); background-color: black; color: white; border:4px orange ridge; border-radius: 3px;'>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=3'>".icon("edit",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=4'>".icon("file",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=5'>".icon("folder",0)."</a>";
	echo "<a href='#' onclick=\"document.getElementById('edit_form').submit();\" id='form_save'>".icon("save",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=2"."'>".icon("sign-out",0)."</a>";
	echo "</div>";
	
	echo "<div class='editor_c' style='z-index: 99000; display:block; width: 64px; height: 24px; left: Calc( 100vw - 100px ); position: fixed; top: Calc( 100vh - 32px ); background-color: black; color: white; border:2px orange ridge; border-radius: 3px;'>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&c=1'>".icon("bin",0)." cache"."</a>";
	echo "</div>";
	
	echo "<div class='editor_settings' style='z-index: 99000; display:block; width: 28px; height: 28px; left: Calc( 100vw - 64px ); position: fixed; top: Calc( 100vh - 68px ); background-color: black; color: white; border:2px orange ridge; border-radius: 3px;'>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=7'>".icon("config",0)."</a>";
	echo "</div>";
	
	$sty_le="style=\"font-family: 'Open Sans',monospace; background: #afafafDD; min-height: 120px; border: 1px solid transparent; z-index: 5; display: block; position: absolute; width: 200px; font-size: 8px; top: 32px; left: Calc( -100vw + 92px); padding: 2px; margin: 2px;  text-align: left; color: black;\"";
	echo "<div $sty_le class='admin_log'><b>Event log:</b><br/><br/>".readlog(30)."</div>";

}
?>
