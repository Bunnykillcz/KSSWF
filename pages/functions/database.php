<h1>Functions</h1>
<h2 class="code">database_init(<span class='int'>int</span> this_ID, <span class='string'>string</span>  servername, <span class='string'>string</span>  username, <span class='string'>string</span>  password, <span class='string'>string</span>  database_name <i>(optional)</i>)</h2>
<h2 class="code">database_create(<span class='int'>int</span> this_ID, <span class='string'>string</span>  new_db_name, <span class='bool'>bool</span>  silent <i>(optional)</i>)</h2>
<h2 class="code">database_delete(<span class='int'>int</span> this_ID, <span class='string'>string</span>  delete_db_name, <span class='bool'>bool</span>  silent <i>(optional)</i>)</h2>
<h2 class="code">database_query(<span class='int'>int</span> this_ID, <span class='string'>string</span>  query, <span class='bool'>bool</span>  silent <i>(optional)</i>)</h2>
<h2 class="code">database_close(<span class='int'>int</span> this_ID)</h2>
<br/>
<h2 class="code">database_create_T(<span class='int'>int</span> this_ID, <span class='string'>string</span>  setup, <span class='string'>string</span>  table)</h2>
<h2 class="code">database_update_T(<span class='int'>int</span> this_ID, <span class='string'>string</span>  set_data, <span class='string'>string</span>  update_rule, <span class='string'>string</span>  table)</h2>
<h2 class="code">database_write_T(<span class='int'>int</span> this_ID, <span class='string'>string</span>  set_data, <span class='string'>string</span>  table)</h2>
<h2 class="code">database_read_T(<span class='int'>int</span> this_ID, <span class='string'>string</span>  what_to_read, <span class='string'>string</span>  table)</h2>
<h2 class="code">database_deletefrom_T(<span class='int'>int</span> this_ID, <span class='string'>string</span>  delete_rule, <span class='string'>string</span>  table)</h2>
<br/>
<h2 class="code">database_show_T(<span class='string'>string</span>  element_class, <span class='int'>int</span> this_ID, <span class='string'>string</span>  servername, <span class='string'>string</span>  username, <span class='string'>string</span>  password, <span class='string'>string</span>  database_name, <span class='string'>string</span>  what_to_read, <span class='string'>string</span>  from_table)</h2>

<!--p><span class="function">function</span> <b>socials</b> generates social share icons according to input. Returns false if failed.</p>
<p><span class="string">string</span> <i>type</i> can be only "google", "facebook", "twitter", or "all".
</p-->
<b>this_ID - ID 9 is reserved for the Posting System.</b>

<br/>



<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		database_show_T('table_quotes',000,"nejedniko.cz","####user####","#####pass####","###dbname###","*","quote");
	?> 
</code></pre>

<h2>Showtime!</h2>
<?php
	echo "For the safety of my database, everything is censored and the result is screenshotted.";
	img("./img/func/database_example.png", "", "", true, true, 480);
?>


<h4>Dependencies</h4>
<ul>
	<li>None
	</li>
</ul>
