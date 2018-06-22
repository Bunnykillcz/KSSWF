<?php 
	$w_t_ = "?w=".$_GET['w'];
	
	if(empty($_GET["a"]))
		redirect("$actual_link$after_link$w_t_", true);

	if($_GET["a"] != 7 && $_GET["a"] != 9 )
		redirect("$actual_link$after_link$w_t_", true);
?>


<h1>Web configuration</h1>
<?php echo "<b>Logged in as <span style='color:red;'> $usrn </span></b>"; ?>

<hr>

<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&a=91'>"; echo icon("user-c",0);?> <b>Change username</b></a>
</div>
<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&a=9'>"; echo icon("key",0);?> <b>Change password</b></a>
</div>
<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&c=1&a=7'>"; echo icon("wand",0);?> <b>Clear cache</b></a>
</div>

<div class="admin_setup_button">
<?php echo "<a href=''>"; echo icon("users",0);?> <b>Edit admin users</b></a>
</div>
<hr>


<?php
echo "<form id='settings_form' action='"."$actual_link$after_link$w_t_"."&a=7"."' method='post'>";



?>
</form>


