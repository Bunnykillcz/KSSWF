/*--------------------------------------*/
/*            Nikola Nejedlý            */
/*                 2017                 */
/*--------------------------------------*/

function canvas_next()
{
	ImageCnt++;
	if(ImageCnt >= max_img) ImageCnt = 0;
	document.getElementById('canvas').style.background = 'url(' + Images[ImageCnt] + ')';
	document.getElementById('canvas').style.display = "block";
	document.getElementById('canvas').style.backgroundSize = "contain";
	document.getElementById('canvas').style.backgroundPosition = "center";
	document.getElementById('canvas').style.backgroundRepeat = "no-repeat";
	document.getElementById('canvas_bg').style.display = "block";
}
function canvas_prev()
{
	ImageCnt--;
	if(ImageCnt < 0) ImageCnt = max_img-1;
	document.getElementById('canvas').style.background = 'url(' + Images[ImageCnt] + ')';
	document.getElementById('canvas').style.display = "block";
	document.getElementById('canvas').style.backgroundSize = "contain";
	document.getElementById('canvas').style.backgroundPosition = "center";
	document.getElementById('canvas').style.backgroundRepeat = "no-repeat";
	document.getElementById('canvas_bg').style.display = "block";
}
function canvas_goto(canv_i)
{
	ImageCnt=canv_i;
	document.getElementById('canvas').style.background = 'url(' + Images[ImageCnt] + ')';
	document.getElementById('canvas').style.display = "block";
	document.getElementById('canvas').style.backgroundSize = "contain";
	document.getElementById('canvas').style.backgroundPosition = "center";
	document.getElementById('canvas').style.backgroundRepeat = "no-repeat";
	document.getElementById('canvas_bg').style.display = "block";
}
function canvas_close()
{
	document.getElementById('canvas').style.display = "none";
	document.getElementById('canvas_bg').style.display = "none";
}