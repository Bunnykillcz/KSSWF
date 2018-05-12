<?php
//tag, homepage, tag, KSSWF, Lorem, Ipsum 

//keywords can be set-up for every page on line 2 in a comment!
//correct syntax is "//one, two, three, four, five, etc"
//if incorrect, or not set, the keywords will be default; default keywords are set in index.php
?>
<?php  
gen_bcnav(true,">");
?>
<hr/>
<br/>
<h1>KSSWF</h1>
<p>Welcome! Hi! Hello! Konnichiwa! Ahoj! Čus! Yo!</p>

<h3>Current firmware version:</h3>
<b>
<?php 
	echo "> v"; 
	echo get_ver().""; 
	echo "<br/><br/>> KyberSoft Simple Website Framework, aka KSSWF <br/>> created by Nikola Nejedlý 2017-18 <br/>> All Rights Reserved"; 
?>
</b>


<?php 
//generate HOME stuff like NEWS?
?>