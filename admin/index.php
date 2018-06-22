<?php
<?php

function redirect($url, $CodeStatus = 303)
{
	header("Location:".$url, true, $CodeStatus);
	die();
}

//echo "location:".$actual_link."".$after_link."/admin/index.php";
redirect("./index.php?w=home&a=1", false);
?>
?>