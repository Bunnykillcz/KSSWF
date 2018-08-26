<h1>Functions</h1>
<h2 class="code">Socials(<span class="string">string</span> type)</h2>
<p><span class="function">function</span> <b>socials</b> generates social share icons according to input. Returns false if failed.</p>
<p><span class="string">string</span> <i>type</i> can be only "google", "facebook", "twitter", or "all".</p>
<br/>
<!--p><?php echo icon("warning",0); ?> <b> This function uses (2x) caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p--><br>


<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		socials("all");
	?> 
</code></pre>

<h2>Showtime!</h2>
<?php
socials("all");
?>


<h4>Dependencies</h4>
<ul>
	<li>icon.php
	</li>
</ul>
