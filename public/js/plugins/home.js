$(document).ready(function(){

// FULL PAGE SCROLLING//


	$.fn.fullpage({
		verticalCentered: false,
		resize:false,
		easing: 'easeInQuart',
	});
//LOAD ANIMATIONS//

	$('.txt-input').animate({'width': '540px'}, 1000);
	$('input[type=submit]').animate({'width': '550px'},1000);
	$('input[type=submit]').animate({'opacity': '1'},800);





$('#arrowBtnDown').click(function(){
	$.fn.fullpage.moveSectionDown();
});

$('#arrowBtnUp').click(function(){
	$.fn.fullpage.moveSectionUp();
});


// $(window).bind('scroll',function(e){
//     parallaxScroll();
// });
 
// function parallaxScroll(){
// 	alert("heuy");
//     var scrolled = $(window).scrollTop();
//     $('#parallax-bg1').css('top',(0-(scrolled*.25))+'px');
//     $('#parallax-bg3').css('top',(0-(scrolled*.75))+'px');
// }

});