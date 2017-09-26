
<div id='navbar'>

<?php
//$after_link = trim($_SERVER['PHP_SELF']);

include 'pwdscript.php';
if(!empty($_GET['w']))
{
	$content = $_GET['w'];
}else
{
	header('location:'.$addr."?ln=".$lang."&w=index");
}
if(!isset($aes))
{
	include 'AES.class.php';
	$aes = new AES($k);
}

include 'sens/db_login.php';

$sql = "SELECT * FROM menu WHERE Type = 'menu'";
$res = mysql_query($sql);
$addr = $after_link;

if($res == false)
header('location:'.$addr."?ln=".$lang."&w=404");
else
while($db_field = mysql_fetch_assoc($res))
{

$nm_cs = $db_field['Name_cs'];
$nm_en = $db_field['Name_en'];
$targt = $db_field['Target'];
$ttype = $db_field['Target_type'];

if($ttype == "page")
	$tar = $addr."?ln=".$lang."&w=".$targt;
else
	$tar = "#";
	
	//header('location:'.$addr."?ln=".$lang);

echo "<div class='main_button'>"; //wrapper
if($tar != "#")
	echo "<a href='$tar'>"; 

$ende = "";

if($tar == "#")
{
	$sql_sub = "SELECT * FROM menu WHERE Type = 'submenu' AND Parent = '$targt'";
	$res_sub = mysql_query($sql_sub);
echo "<div class='content'><ul>";
	
	while($db_field_sub = mysql_fetch_assoc($res_sub))
	{
	$nm_cs_sub = $db_field_sub['Name_cs'];
	$nm_en_sub = $db_field_sub['Name_en'];
	$targt_sub = $db_field_sub['Target'];
	$ttype_sub = $db_field_sub['Target_type'];
	
	$tar_sub = "#";
	if($ttype_sub == "page")
	$tar_sub = $addr."?ln=".$lang."&w=".$targt_sub;
	
	echo "<li><a href='$tar_sub'>";
		if($lang == "cs")
		{
			echo $nm_cs_sub;
		}else
		if($lang == "en")	
		{
			echo $nm_en_sub;
		}
	echo "</a></li>";
	}

$ende = "ָ";

echo "</ul></div><div class='parent'>";
}

if($lang == "cs")
{
	echo $nm_cs.$ende;
}else
if($lang == "en")	
{
	echo $nm_en.$ende;
}

if($tar != "#")
	echo "</a></div>";
else
	echo "</div></div>";

}
?></div>
<div class="language"><?php 
	if($lang == "cs")
	{
		echo "<a href='".$addr."?ln=en"."&w=".$content."'><img alt='en' src='./image/flag_great_britain.png'></a>";
	}else
	if($lang == "en")	
	{
		echo "<a href='".$addr."?ln=cs"."&w=".$content."'><img alt='cz' src='./image/flag_czech_republic.png'></a>";
	}
	
 ?></div><div class="printer">
 <?php
 	echo "<a target='_BLANK' href='".$addr."?ln=".$lang."&w=".$content."&print=1'><img alt='print' src='./image/icons/PNG/printer.png'></a>";
 ?></div>