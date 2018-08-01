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
<?php echo "<a href='$actual_link$after_link$w_t_&a=91'>"; echo icon("user-c");?> <b>Change username</b></a>
</div>
<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&a=9'>"; echo icon("key");?> <b>Change password</b></a>
</div>
<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&c=1&a=7'>"; echo icon("wand");?> <b>Clear cache</b></a>
</div>

<div class="admin_setup_button">
<?php echo "<a href=''>"; echo icon("users-cog");?> <b>Edit admin users</b></a>
</div>

<div class="admin_setup_button">
<?php echo "<a href='$actual_link$after_link$w_t_&a=9937519'>"; echo icon("user-slash");?> <b>Reset user file</b></a>
</div>

<hr>


<?php
function translate_priv($priv)
{
	switch($priv)
	{
		case 0: return "none"; break;
		case 1: return "read-only"; break;
		case 2: return "write-only"; break;
		case 3: return "access+"; break;
		case 4: return "access+ | read"; break;
		case 5: return "access+ | write"; break;
		case 6: return "access+ | read | write"; break;
		case 7: return "access+ | read | write | user-control"; break;
	}
}

echo "<form id='settings_form' action='"."$actual_link$after_link$w_t_"."&a=7"."' method='post'>";
echo "<h2>Edit admin users</h2>";
echo "<table class='settings_table'>";
echo "<tr>";
echo 	"<th>Username</th>";
echo 	"<th>Privileges</th>";
echo 	"<th></th>";
echo 	"<th>Operations</th>";
echo "</tr>";

echo "<tr>";
echo 	"<td></td>";
echo 	"<td></td>";
echo 	"<td></td>";
echo 	"<td></td>";
echo "</tr>";

echo "</table>";
?>
</form>


