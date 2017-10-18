<h1>Functions</h1>
<h2>Button(string text, string url, bool new_window, int size_x, int size_y);</h2>
<p>function <b>button</b> generates a html+css preset button div with a size of [<i>size_x</i> x <i>size_y</i>]px.</p>
<p>string <i>text</i> expects a value such as <i>"This is a button"</i>, etc.</p>
<p>string <i>url</i> expects a value such as <i>"http://blabla.org"</i>, or you can do stuff such as <i>"pages/somepageinhere.php?parameter_x=123456"</i>, etc.</p>
<p>bool <i>new_window</i> expects a BOOLEAN value (true/false) and accordingly opens the link in the same or new window.</p>
<p>int <i>size_x</i>, int <i>size_y</i> expect a number (size in pixels to the width [x] and height [y]). If the size is not set (x, or y is left with 0) the button will have default settings. Which means that it should wrap the text inside and be as big as needed to contain it (it's basically just not limited to a specific size).</p><br/>

<h3>ShowTime!</h3>
<p>
<?php 
echo button("This is a button 128x64px","#",false,128,64);
echo button("Another button [0x0]","#",false,0,0);
echo button("Link to index.php".icon("_new",0),"index.php",true,100,36);
?>
</table></p>

