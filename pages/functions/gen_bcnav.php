<h1>Functions</h1>
<h2>gen_bcnav(bool href, string splitter);</h2>
<p>function <b>gen_bcnav</b> generates a html preset button div with a string of current location sequence, also known as "Breadcrumb Navigation".</p>
<p>bool <i>href</i> expects a BOOLEAN value (true/false). If true, every breadcrumb will be an url, if existing.</p>
<p>string <i>splitter</i> expects a value such as <i>"/"</i>, etc.; It represents the character that's used to split every single breadcrumb. If empty, using default "|";</p>

<p><?php echo icon("warning",0); ?> <b> This function uses caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 100px;">	&lt;?php 
	gen_bcnav(true,">");
	gen_bcnav(false,"");
	gen_bcnav(false,"/");
	?>
</code></pre>

<hr>
<h3>ShowTime!</h3>
<p>
<?php 
	gen_bcnav(true,">");
	gen_bcnav(false,"");
	gen_bcnav(false,"/");
?>
</p>

