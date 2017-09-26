<div class="text_area">

<div id="txt"><br><?php 

if($content == "index")
$content = "home";

if(empty($content))
{
	$addr = $after_link;
	$content = "home";
	header('location:'.$addr."?w=".$content);
}
else
{
	if(file_exists("./pages/$content.php"))
	{
			include("./pages/$content.php");
	}
}
?></div>
</div>