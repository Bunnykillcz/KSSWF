<h1>Functions</h1>
<h2 class="code">encrypt_caesar(<span class="string">string</span> your_text, <span class="int">int</span> number)</h2>
<p><span class="function">function</span> <b>encrypt_caesar</b> returns string of characters encrypted by Caesars method. <br/><br/>This is done by shifting characters from <span class="string">string</span> <i>your_text</i> by an <span class="int">int</span><i>number</i>.</p>
<p>Opposite to this function is <span class="function">function</span> <b>decrypt_caesar</b>.</p>
<br/>

<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		echo encrypt_caesar("THIS IS CAESAR ENCRYPTION!", 10)."&lt;br>"; //	Increments the number of characters
		echo decrypt_caesar("THIS IS CAESAR DECRYPTION!", 10)."&lt;br>"; //	Decrements the number of characters
		
		//for a better example:
		$_enc = encrypt_caesar("THIS IS CAESAR ENCRYPTION!",10);
		$_dec = decrypt_caesar($_enc,10);
		
		echo "&lt;br>". $_enc." == ".$_dec;
	?> 
</code></pre>

<h2>Showtime!</h2>
<?php
		echo encrypt_caesar("THIS IS CAESAR ENCRYPTION!", 10)."<br>";
		echo decrypt_caesar("THIS IS CAESAR DECRYPTION!", 10)."<br>";
		
		$_enc = encrypt_caesar("THIS IS CAESAR ENCRYPTION!",10);
		$_dec = decrypt_caesar($_enc,10);
		
		echo "<br>". $_enc." == ".$_dec;
?>


<h4>Dependencies</h4>
<ul>
	<li>None
	</li>
</ul>
