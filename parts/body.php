<div class="text_area">

<div id="txt"><br><?php 
if(!empty($_GET['w']))
	$content = $_GET['w'];

if($content == "index" )
$content = "home";

if(empty($content))
{
	$addr = $after_link;
	$content = "home";
	header('location:'.$addr."?w=".$content);
}
else
{
	$content = str_replace(' ', '+', $content);
	$content = str_replace('+', '/', $content);
	if(file_exists("./pages/".$content.".php"))
	{
			include("./pages/".$content.".php");
	}else
	{
		echo "file '"."./pages/".$content.".php"."' not found.";
	}
$subtitle = explode("/",$content)[count(explode("/",$content))-1];
}

if(!empty($subtitle))
echo "<title>$title | $subtitle</title>";
else
echo "<title>$title</title>";
?></div>
</div>