/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

function hide_element(selector, speed) 
{
	$(document).ready(function(){
		easing = "linear";
		$(selector).hide(speed,easing);
    });

}

function show_element(selector, speed) 
{
	$(document).ready(function(){
		easing = "linear";
		$(selector).show(speed,easing);
    });

}