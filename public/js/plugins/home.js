$(document).ready(function(){

// FULL PAGE SCROLLING//


	$.fn.fullpage({
		anchors: ['home', 'info', 'register'],
		menu: '#menu',
		verticalCentered: false,
		resize:true,
		easing: 'easeInOutQuad',
		    fixedElements: '#menu',
		  loopBottom:true,

	});
//LOAD ANIMATIONS//

	// $('.txt-input').animate({'width': '420px'}, 1000);
	// $('input[type=submit]').animate({'width': '420px'},1000);
	// $('input[type=submit]').animate({'opacity': '1'},800);





$('.arrowBtnDown').click(function(){
	$.fn.fullpage.moveSectionDown();
});




});