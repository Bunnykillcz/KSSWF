<h1>Functions</h1>
<h2 class="code">Gallery(<span class="string">string</span> folder, <span class="string">string</span> title);</h2>
<p>function <b>gallery</b> gets all files in folder and makes a gallery of them for you. Also returns a number to tell you how many items it found (this does not need to be used).</p>
<p>If the return value is <i>-1</i>, then the folder doesn't exist.</p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>


<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 96px;">	
	&lt;?php 
		$num = gallery("gallery", "title"); //("" - empty parameter leads to "./img/", in this case "./img/gallery/")
		echo $num;
	?> 
</code></pre>


<h3>Showtime!</h3>
<?php 
	$num = gallery("gallery", "title");
	echo $num;
?>

