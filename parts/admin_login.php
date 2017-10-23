<?php 

?>
<div class="h_admin">
<?php
	if(!empty($_GET['w']))
		$w_t_ = "?w=".$_GET['w'];
	else
		$w_t_="";
	
	echo button("admin","$actual_link$after_link$w_t_"."&a=1",false,0,0);
?>
</div>
<div class="editor" style="z-index: 99000; display:block; width: 150px; height: 32px; left: Calc( 50vw - 75px ); position: fixed; top: Calc( 100vh - 28px ); background-color: black; color: white; border:4px orange ridge; border-radius: 3px;">
<?php 
	echo "<a href='#'>".icon("edit",0)."</a>";
	echo "<a href='#'>".icon("file",0)."</a>";
	echo "<a href='#'>".icon("folder",0)."</a>";
	echo "<a href='#'>".icon("save",0)."</a>";
	echo "<a href='#'>".icon("sign-out",0)."</a>";
?>
</div>
