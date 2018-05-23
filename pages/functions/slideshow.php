<h1>Functions</h1>

<h2>slideshow(var identifier, string folder, bool show_controls_arrow, bool show_controls_dots, int time, string effect);</h2>

<p>function <strong>slideshow</strong> gets all files in folder and makes a slideshow of them for you.</p>

<p>var <em>identifier</em> expects any value, but numbers are very recommended.</p>

<p>string <em>folder</em> expects a folder name such as <em>"slideshow"</em> which will then lead to <em>"./img/slideshow/**"</em> and read all images inside.</p>

<p>bool <em>show_controls_arrow</em> and <em>show_controls_dots</em> expect a <em>true</em>/<em>false</em>. This will turn on or off corresponding controls (dots, or arrows).</p>

<p>int <em>time</em> expects a number in [ms]. If this number is zero, then it won&#39;t be timed.</p>

<p>string <em>effect</em> expects an effect name. Currently only <em>"fade"</em> or nothing (<em>""</em>) can be used, but more could be set up in the "slideshow.css" for the current template and then be used in this function.</p>

<p>&nbsp;</p>

<p>If the slideshow fails to generate its cache file, it returns <em>-1</em>. This can be caused by missing, or empty folder, etc.</p>

<p>&nbsp;</p>

<p><?php echo icon("info",0);?> <strong>This has to be used only once per page max. Having more will cause an error.</strong></p>

<p><?php echo icon("info",0);?> <em>Images in slideshow are loaded from a folder. This should contain for each image a "*.kstr" file with the same name as an image. This file gets loaded and its contents will get shown as description of image when shown in slideshow!</em></p>

<h3>Usage example</h3>

<pre>
<code>	
	&lt;?php 
		slideshow(0,"gallery",true,true,15000,"fade"); 
		//("" - empty parameter &#39;folder&#39; leads to "./img/", but in this case goes to "./img/gallery/")
	?> 
</code></pre>

<h2>Showtime!</h2>

<p><?php slideshow(0,"gallery",true,true,15000,"fade"); ?></p>
