<h1>Functions</h1>
<h2>img(string source, string alt, string css_class, bool cache_this, bool click_big, int width)</h2>
<p>function <b>img</b> will generate html tag for each image according to parameters; This allows to easily use caching and click-enlarging of images.</p>
<p> ... To be filled out ..</p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses (2x) caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 96px;">	
	&lt;?php 
	echo "&lt;div style='display:block;'>";
		$chk = img("./img/gallery/IMG_9187.jpg", "", "", true, true, 320);
		$chk .= img("./img/gallery/IMG_8419.jpg", "", "", true, true, 240);
		echo $chk;
	echo "&lt;/div>";
	?> 
</code></pre>
<hr>
<h3>Showtime!</h3>
<?php 
	echo "<div style='display:block;position:static;'>";
		$chk = img("./img/gallery/IMG_9187.jpg", "", "", true, true, 320);
		$chk .= img("./img/gallery/IMG_8419.jpg", "", "", true, true, 240);
		echo $chk;
	echo "</div>";
?>

