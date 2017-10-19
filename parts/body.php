<div class="text_area">

<div id="txt"><br><?php 
$content_ = "";
if(!empty($_GET['w']))
	$content_ = $_GET['w'];

if($content_ == "index" )
$content_ = "home";

if(empty($content_) && empty($_GET['c']))
{
	$addr = $after_link;
	$content_ = "home";
	header('location:'.$addr."?w=".$content_);
}
else
if(!empty($content_))
{
	$content_ = str_replace(' ', '+', $content_);
	$content_ = str_replace('+', '/', $content_);
	if(file_exists("./pages/".$content_.".php"))
	{
			include("./pages/".$content_.".php");
	}else
	{
	infobox("file '"."./pages/".$content_.".php"."' was not found.","warning");
	}
}
?></div>
</div>