var slideIndex = 0;
var time_saved = -1;
var timer_id = 0;

function showSlides(time, n) {
	var i;
	var noslide=false;
	
	if(time_saved == -1)
		time_saved = time;
	
	if(time != time_saved)
		time = time_saved;
	
	var slides = document.getElementsByClassName("thisSlide");
	var dots = document.getElementsByClassName("dot");
	if (n > slides.length) {slideIndex = 1} 
	if (n < 1) {slideIndex = slides.length; noslide=true;} 
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none"; 
    }
	if(!noslide)
		slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1} 
	if(dots.length > 0)
	for (i = 0; i < dots.length; i++) {
	  dots[i].className = dots[i].className.replace(" active", "");
	}
    slides[slideIndex-1].style.display = "block";
	if(dots.length > 0)
		dots[slideIndex-1].className += " active";

	clearTimeout(timer_id);
	timer_id = setTimeout(showSlides,time);
}

function plusSlides(n) {
	showSlides(time = time_saved,slideIndex += n-1);
}

function currentSlide(n) {
	showSlides(time = time_saved,slideIndex = n-1);
}
