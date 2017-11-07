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
		$w_t_="";
	
if(!isset($_SESSION['login_admin']))
	echo button("Admin","$actual_link$after_link$w_t_"."&a=1",false,0,0);
if(isset($_SESSION['login_admin']))
{
	echo "<div class='editor' style='z-index: 99000; display:block; width: 150px; height: 32px; left: Calc( 50vw - 75px ); position: fixed; top: Calc( 100vh - 28px ); background-color: black; color: white; border:4px orange ridge; border-radius: 3px;'>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=3'>".icon("edit",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=4'>".icon("file",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=5'>".icon("folder",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=6'>".icon("save",0)."</a>";
	echo "<a href='"."$actual_link$after_link$w_t_"."&a=2"."'>".icon("sign-out",0)."</a>";
	echo "</div>";
}
?>