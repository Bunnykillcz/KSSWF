<?php  
gen_bcnav(true,">");
?>
<hr/>
<br/>
<h1>Lorem Ipsum h1</h1>
<p>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer tempor. Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat. Quisque porta. Integer vulputate sem a nibh rutrum consequat. Morbi scelerisque luctus velit. Nunc auctor. 
<?php //img("/img/pexels-photo-225231.jpeg","test image", "right", false, false, 240); ?>
<img style="height:240px;" src="https://images.pexels.com/photos/225231/pexels-photo-225231.jpeg" alt="test image"/>
Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aliquam in lorem sit amet leo accumsan lacinia. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Nunc dapibus tortor vel mi dapibus sollicitudin. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Phasellus faucibus molestie nisl. Nulla non lectus sed nisl molestie malesuada. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor.
</p><p>
<a href="#">#RANDOM LINK# Nam sed tellus id magna elementum tincidunt.</a> <?php lorem(1, 5, 3, 10, false); ?>
</p>
<?php lorem(1, 5, 3, 10, false); ?>

<h2>Lorem Ipsum h2</h2>
<?php lorem(2, 10, 5, 18, true); ?>
<h4>Slideshow: </h4>
<?php slideshow(0,"gallery",true,true,15000,"fade"); ?>
<?php lorem(2, 10, 5, 18, false); ?>

<h3>Ipsum Dolor h3</h3>
<?php lorem(2, 10, 5, 18, true); ?>
<br/>
<div class="floatright"><?php button("Button","#",false,0,0); ?> <br/> .floatright</div>
<ol> OL 01
	<li>LI 01</li>
	<li>LI 02</li>
	<li>LI 03</li>
	<ol> OL 02
		<li>LI 01</li>
		<li>LI 02</li>
		<li>LI 03</li>
		<ol> OL 03
			<li>LI 01</li>
			<li>LI 02</li>
			<li>LI 03</li>
		</ol>
	</ol>
</ol>

<h4>Dolor Sit Amet h4</h4>
<?php lorem(2, 10, 5, 18, true); ?>
<br/>
<ul> UL 01
	<li>LI 01</li>
	<li>LI 02</li>
	<li>LI 03</li>
	<ul> UL 02
		<li>LI 01</li>
		<li>LI 02</li>
		<li>LI 03</li>
		<ul> UL 03
			<li>LI 01</li>
			<li>LI 02</li>
			<li>LI 03</li>
		</ul>
	</ul>
</ul>
<br/>

<?php gallery("gallery", "Gallery", "cba", true); ?>

<h4>Basic tags: </h4>
<p>
<br/><strong>STRONG</strong>
, <b> B </b>, <i> I </i>, <u> U </u>
</p>

<div class="l_column">
<h2>l_column</h2>
<?php lorem(1, 12, 4, 8, true); ?>
</div>
<div class="r_column">
<h2>r_column</h2>
<?php lorem(1, 8, 5, 8, false); ?>
</div>

<?php
	youtube("PvzBWFGEz8M");
?>

<div class="l_column_big">
<h2>l_column_big</h2>
<?php lorem(1, 12, 4, 8, true); ?>
<br/>
<img class="null_m  null_bg  null_float  null_p  null_border  full_w" src="https://images.pexels.com/photos/225231/pexels-photo-225231.jpeg" alt="test_image no_margin no_padding full_width" />
</div>
<div class="r_column_small">
<h2>r_column_small</h2>
<p>
<b>ipsum B</b> dolor sit amet, consectetuer adipiscing elit. Integer tempor. Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat. Quisque porta. Integer vulputate sem a nibh rutrum consequat. Morbi scelerisque luctus velit. Nunc auctor. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aliquam in lorem sit amet leo accumsan lacinia. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Nunc dapibus tortor vel mi dapibus sollicitudin. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Phasellus faucibus molestie nisl. Nulla non lectus sed nisl molestie malesuada. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor.
</p>
<?php lorem(1, 5, 3, 10, false); ?>
</div>

<?php socials("all"); ?>

