<?php

/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

function youtube($video_id, $element_class = "YTvideo", $autoplay = false, $allowfullscreen = true)
{
	$fs = "";
	$ap = "";
	if($allowfullscreen)
		$af="allowfullscreen";
	if($autoplay)
		$ap = "autoplay;";
	echo "<div class='$element_class'><iframe src='https://www.youtube.com/embed/$video_id' frameborder='0' allow='$ap encrypted-media' $fs></iframe></div>";
}



?>