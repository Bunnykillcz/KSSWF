<h1>Functions</h1>
<h2 class="code">map_google(...);</h2>
<p><span class="function">function</span> <b>map_google</b> ... </p>
<p>*YET TO BE EDITED*</p>
<br/>
<p><?php echo icon("info",0);?> <b>This has to be used only once per page max. Having more will cause issues.</b></p>


<h3>Usage example</h3>
<pre><code class="language-php">	
&lt;div style='display:block;border:1px black solid;left:Calc( 50% - 400px );text-align:center;width:800px;position:relative;'>
	&lt;?php 
		map_google(2846, "AIzaSyBm-zVgKndR4Cl9UhaoS5Te56ejXv2aIDA","","Somewhere in CzechRepublic 01", 49.5798787, 14.5064755, 7, 800, 400, true);
	?> 
&lt;/div>
</code></pre>


<h2>Showtime!</h2>
<div style='display:block;border:1px black solid;left:Calc( 50% - 400px );text-align:center;width:800px;position:relative;'>
<?php  
		map_google(2846, "AIzaSyBm-zVgKndR4Cl9UhaoS5Te56ejXv2aIDA","","Somewhere in CzechRepublic 01", 49.5798787, 14.5064755, 7, 800, 400, true);
?>
</div>
