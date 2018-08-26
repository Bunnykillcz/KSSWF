<h1>Functions</h1>
<h2 class="code">img(<span class="string">string</span> source, <span class="string">string</span> alt, <span class="string">string</span> css_class, <span class="bool">bool</span> cache_this, <span class="bool">bool</span> click_big, <span class="int">int</span> width)</h2>
<p><span class="function">function</span> <b>img</b> will generate html tag for each image according to parameters; This allows to easily use caching and click-enlarging of images.</p>
<p> ... To be filled out ..</p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses (2x) caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>


<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
	echo "&lt;div style='display:block;'>";
		$chk = img("./img/gallery/IMG_9187.jpg", "", "", true, true, 320);
		$chk .= img("./img/gallery/IMG_8419.jpg", "", "", true, true, 240);
		echo $chk;
	echo "&lt;/div>";
	?> 
</code></pre>

<h2>Showtime!</h2>
<?php 
	echo "<div style='display:block;position:static;'>";
		$chk = img("./img/gallery/IMG_9187.jpg", "", "", true, true, 320);
		$chk .= img("./img/gallery/IMG_8419.jpg", "", "", true, true, 240);
		echo $chk;
	echo "</div>";
?>



<h4>Dependencies</h4>
<ul>
	<li>mk_cache_img.php
	</li>
</ul>
