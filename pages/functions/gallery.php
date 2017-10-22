<h1>Functions</h1>
<h2>Gallery(string folder);</h2>
<p>function <b>gallery</b> gets all files in folder and makes a gallery of them for you. Also returns a number to tell you how many items it found (this dies not need to be used).</p>
<p>If the return value is <i>-1</i>, then the folder doesn't exist.</p>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 64px;">	
	&lt;?php 
		$num = gallery("gallery"); //("" - empty parameter leads to "./img/"+"gallery")
		echo $num;
	?> 
</code></pre>

<hr>
<h3>Showtime!</h3>
<?php 
	$num = gallery("gallery");
	echo $num;
?>

