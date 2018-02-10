<h1>Functions</h1>
<h2>Infobox(string message, string type, <i>string posx, string posy</i>);</h2>
<p>function <b>infobox</b> pops up a predefined message window.</p>
<p>string <i>message</i> expects a text/string value of any kind. This could be something like "ERROR 1234", etc.</p>
<p>string <i>type</i> expects a value <i>{ "warning", "info"(default), "none" }</i> or you could leave it empty <i>("")</i> which chooses default option.</p><br>
<p>(optional) string <i>posx,posy</i> expects a string -> number followed by type such as "100px", or "10%"; if set to "-1", or not set it will set itself as default (That is set by the correct template css).</p><br>

<p><?php echo icon("warning",0); ?> <b> This function should always be used with a $_GET[''] variable! </b> <?php echo icon("warning",0); ?></p><br>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 132px;">	
	&lt;?php 
	if(!empty($_GET['test']))
		Infobox("This is a testing pop-up infobox.","info", "40px", "50px");
	
	echo "&lt;a href='".$after_link."?w=".$this_w."&test=1'>Test this and show me an infobox!&lt;/a>";
	?> 
</code></pre>

<hr>
<h3>Showtime!</h3>
<p>
	<?php 
	if(!empty($_GET['test']))
		Infobox("This is a testing pop-up infobox.","info", "40px", "50px");
	
	echo "<a href='".$after_link."?w=".$this_w."&test=1'>Test this and show me an infobox!</a>";
	?> 
</p>
