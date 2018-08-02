<h1>Functions</h1>
<h2 class="code">Gallery(<span class="string">string</span> folder, <span class="string">string</span> title <i>(optional)</i>, 
<span class="string">string</span> order <i>(optional)</i>, <span class="bool">bool</span> cache_all <i>(optional)</i>,
 <span class="string">string</span> OR <span class="int">int</span> release_frequency <i>(optional)</i>, <span class="string">string</span> release_folder <i>(optional)</i> );</h2>
<p><span class="function">function</span> <b>gallery</b> gets all files in folder and makes a gallery of them for you. Also returns a number to tell you how many items it found (this does not need to be used) -- only works (since update v0.4.00a) when the cache_all is not used, or false.</p>
<p><span class="string">string</span> <i>folder</i> is the key parameter. It references to "./img/"+folder and the function shows its contents as an image gallery. </p>
<p><span class="string">string</span> <i>title</i> <i>(optional)</i> is the title of your gallery. </p>
<p><span class="string">string</span> <i>order</i> <i>(optional)</i> expects "abc", "cba", or "random". Anything else will be considered "abc", as default. </p>
<p><span class="bool">bool</span> <i>cache_all</i> <i>(optional)</i> is a boolean value, default: false; If you don't need to count your items, I suggest you to turn it on (true) since it should make your page load faster.</p>
<p><span class="string">string</span> <i>release_time</i> <i>(optional)</i> expects "hour", "day", "week", "month", "year", or ANY time in minutes as a number. This is optional for releasing new images to the gallery every *release_time* from the first load-up.</p>
<p><span class="string">string</span> <i>release_folder</i> <i>(optional)</i> expects a path to an existing directory. This is the folder from which it will take new images to put in gallery. </p>
<br/>
<p>Since the v0.4.00a update: <span class="string">string</span> title was made optional, otherwise blank; <span class="string">string</span> order <i>(optional)</i> has been added to maintain the order of pictures; <span class="bool">bool</span> cache_all <i>(optional)</i> has been added; <br/> These changes are compatible with old versions, which means that update won't change your galleries, or throw exceptions for the amount of parameters to the function.</p>
<p>Since the v0.4.71a update: Gallery can now be automatically filled up from another folder. </p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses (2x optional) caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>


<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		//$num = gallery("gallery", "title"); //("" - empty parameter leads to "./img/", in this case "./img/gallery/")
		//echo $num;
		//update v0.4.00a usage:
		gallery("gallery", "", "cba", true); 
	?> 
</code></pre>


<h2>Showtime!</h2>
<?php 
	//$num = gallery("gallery", "title");
	//echo $num;
	gallery("gallery", "", "random", true); 
?>

