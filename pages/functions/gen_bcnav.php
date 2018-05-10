<h1>Functions</h1>
<h2 class="code">gen_bcnav(<span class="bool">bool</span> href, <span class="string">string</span> splitter);</h2>
<p>function <b>gen_bcnav</b> generates a html preset button div with a <span class="string">string</span> of current location sequence, also known as "Breadcrumb Navigation".</p>
<p><span class="bool">bool</span> <i>href</i> expects a <span class="bool">boolean</span> value (true/false). If true, every breadcrumb will be an url, if existing.</p>
<p><span class="string">string</span> <i>splitter</i> expects a value such as <i>"/"</i>, etc.; It represents the character that's used to split every single breadcrumb. If empty, using default "|";</p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br>


<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 100px;">	&lt;?php 
	gen_bcnav(true,">");
	gen_bcnav(false,"");
	gen_bcnav(false,"/");
	?>
</code></pre>


<h3>ShowTime!</h3>
<p>
<?php 
	gen_bcnav(true,">");
	gen_bcnav(false,"");
	gen_bcnav(false,"/");
?>
</p>

