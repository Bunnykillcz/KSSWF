<h1>Functions</h1>
<h2 class="code">
<span class="fce">lorem</span>
( 
<span class="int">int</span> paragraphs_amount, 
<span class="int">int</span> sentences_amount, 
<span class="int">int</span> minWidthSen, 
<span class="int">int</span> maxWidthSen, 
<span class="bool">bool</span> startWlipsum 
)</h2>

<p><span class="function">function</span> <b>lorem</b> generates Lorem Ipsum paragraphs; This can be easily used for testing purposes!</p>
<p>... <i>...</i> ... To be filled out ...</p>
<br/>
<p><?php echo icon("warning",0); ?> <b> This function uses caching! Every change needs the cache to be cleared. </b> <?php echo icon("warning",0); ?></p><br/>
<br/>
<div class="right"><i>function made by <a href="http://soveticka.cz" target="_BLANK">Soveticka <span style="font-size: 8px; "><?php echo icon("_new",0); ?></span></a> & KyberSoft</i></div>

<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		lorem(2, 12, 10, 16, true);
		// = generate 2 paragraphs : built from 12 sentences : each consisting of 10 to 16 words : and start with Lorem Ipsum Dolor Sit Amet if possible; 
	?> 
</code></pre>

<h2>Showtime!</h2>
<?php
lorem(2, 12, 10, 16, true);
?>



<h4>Dependencies</h4>
<ul>
	<li>none
	</li>
</ul>
