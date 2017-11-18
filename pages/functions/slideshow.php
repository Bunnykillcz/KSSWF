<h1>Functions</h1>
<h2>slideshow(var identifier, string folder, bool show_controls_arrow, bool show_controls_dots, int time, string effect);</h2>
<p>function <b>slideshow</b> gets all files in folder and makes a slideshow of them for you. </p>
<p>var <i>identifier</i> expects any value, but numbers are very recommended.</p>
<p>string <i>folder</i> expects a folder name such as <i>"slideshow"</i> which will then lead to <i>"./img/slideshow/**"</i> and read all images inside.</p>
<p>bool <i>show_controls_arrow</i> and <i>show_controls_dots</i> expect a <i>true</i>/<i>false</i>. This will turn on or off according controls (dots, or arrows).</p>
<p>int <i>time</i> expects a number in [ms]. If this number is zero, then it won't be timed.</p>
<p>string <i>effect</i> expects an effect name. Currently only <i>"fade"</i> or nothing (<i>""</i>) can be used, but more could be set up in the "slideshow.css" for the current template and then be used in this function.</p>
<br/>
<p>If the slideshow fails to generate its cache file, it returns <i>-1</i>. This can be caused by missing, or empty folder, etc.</p>
<p><?php echo icon("info",0);?> <b>This has to be used only once per page max. Having more will cause an error.</b></p>
<p><?php echo icon("info",0);?> <i>Images in slideshow are loaded from a folder. This should contain for each image a "*.kstr" file with the same name as an image. This file gets loaded and its contents will get shown as description of image when shown in slideshow!</i></p>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 92px;">	
	&lt;?php 
		slideshow(0,"gallery",true,true,15000,"fade"); 
		//("" - empty parameter 'folder' leads to "./img/", but in this case goes to "./img/gallery/")
	?> 
</code></pre>

<hr>
<h3>Showtime!</h3>
<?php 
	slideshow(0,"gallery",true,true,15000,"fade"); 
?>

