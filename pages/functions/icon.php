<h1>Functions</h1>
<h2>Icon(string type, int size);</h2>
<p>function <b>icon</b> searches in it's preset icon callers and returns an icon in the form of the correct html tag for the text symbol using <b>font awesome</b> resources. This means that the font icons won't work if your project is offline.</p>
<p>string <i>type</i> expects a value such as <i>"globe"</i>, etc. (preset values in the table below)</p>
<p>int <i>size</i> expects a value between 0 - 3, where 0 is normal size and 3 is huge.</p><br/>
<p><div class="right"><a href="http://fontawesome.io/" target="_blank"><?php echo icon("_new",0); ?><i>More about font awesome?</i></a></div></p><br/>

<hr>
<h3>Usage example</h3>
<pre><code class="language-php" style="display:block; height: 132px;">	
	&lt;?php 
		echo "Some kind of example text and icon globe size 0 - ".icon("globe",0);
	?> 
	&lt;!-- ... some html tags ... -->
	&lt;div class="something">
		&lt;?php echo icon("user-c",2);?>
	&lt;/div>
</code></pre>

<hr>
<h3>Table of preset icons</h3>
<p><table>
<tr>
	<th>type</th>
	<th>size 0</th> 
	<th>size 1</th> 
	<th>size 2</th> 
	<th>size 3</th> 
</tr>
<?php 
foreach($ic_callers_list as &$type){
	echo "<tr><td>"."\"".$type."\""."</td>"; 
	echo "<td>".icon($type,0)."</td>"; 
	echo "<td>".icon($type,1)."</td>"; 
	echo "<td>".icon($type,2)."</td>"; 
	echo "<td>".icon($type,3)."</td></tr>"; 
}
?>
</table></p>
