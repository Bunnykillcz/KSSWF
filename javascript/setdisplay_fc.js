/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2018                 */
/*--------------------------------------*/

function setDisplay(id, display) 
{
    var ths_l = document.getElementById("loading");
	if(ths_l) 
		ths_l.style.display = "block";
	
    var ths = document.getElementsByName(id);
	
	for (var i = 0; i < ths.length; i++) 
	{
		if(ths[i]) 
		{
			ths[i].style.display = ths[i].style.display == "block" ? "none" : "block";
			//ths[i].style.visibility = ths.style.display == "block" ? "visible" : "hidden";
		}
	}
	
	if(ths_l) 
		ths_l.style.display = "none";
}