<h1>Functions</h1>
<h2 class="code">Icon(<span class="string">string</span> type, <span class="int">int</span> size <i>(optional)</i> );</h2>
<p><span class="function">function</span> <b>icon</b> searches in it's preset icon callers and returns an icon in the form of the correct html tag for the text symbol using <b>font awesome</b> resources. This means that the font icons won't work if your project is offline.</p>
<p><span class="string">string</span> <i>type</i> expects a value such as <i>"globe"</i>, etc. (preset values in the table below)</p>
<p><span class="int">int</span> <i>size</i> <i>(optional)</i> expects a value between 0 - 3, where 0 is normal size and 3 is huge.</p><br/>
<p>Note that with update to framework version <b>0.3.37a</b>+ the icon function can use even values that are not in the preset table. Update <b>v0.4.00a</b> set the size parameter as optional and brought the update of Font Awesome to 5.1 .</p><br/>
<p><div class="right"><a href="http://fontawesome.io/" target="_blank"><?php echo icon("_new",0); ?><i>More about font awesome?</i></a></div></p><br/>

<h3>Usage example</h3>
<pre><code class="language-php">	
	&lt;?php 
		echo "Some kind of example text and icon globe size 0 - ".icon("globe",0);
	?> 
	&lt;!-- ... some html tags ... -->
	&lt;div class="something">
		&lt;?php echo icon("user-c",2);?>
	&lt;/div>
</code></pre>


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
