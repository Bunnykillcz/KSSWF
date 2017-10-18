<h1>Frequently Asked Questions</h1>
<h2>01 - Why is my menu incorrectly generated?</h2>
<p>Your menu, dear user, might be generated incorrectly because of various reasons.</p>
<p>I would suggest checking if the <i>../pages/<b>this.kstr</b></i> file is written with correct syntax and all the files and folders listed do exist. Items listed as URLs need to have a <b>this.kstr</b> inside, where only one line should be written and that's the target url. Check if all your listed folders have a declaration as <i>'ß'</i> keyword.</p>
<p>Non-existent items are automatically skipped by generating script which might cause your menu to be generated wrong. Commenting lines with <i>'//'</i> at the beginning of the line that you have prepared for future use is recommended.</p>
<p>Also - don't forget to clear the cache, otherwise the script won't generate the new menu (If you're unsure about the changes, save the last generated file before doing so).</p><div class="right"><?php button(icon("bin",0)."CLEAR CACHE", "index.php?c=1", false,0,0); ?></div>
<h2>02</h2>
<p> ### </p>
