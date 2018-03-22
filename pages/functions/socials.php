<h1>Functions</h1>
<h2>Socials(string type)</h2>
<p>function <b>socials</b> generates social share icons according to input. Returns false if failed.</p>
<p>string <i>type</i> can be only "google", "facebook", "twitter", or "all".</p>
<br/>
<!--p><?php echo icon("warning",0); ?> <b> This function uses (2x) caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p--><br>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 96px;">	
	&lt;?php 
		socials("all");
	?> 
</code></pre>
<hr>
<h3>Showtime!</h3>
<?php
socials("all");
?>

