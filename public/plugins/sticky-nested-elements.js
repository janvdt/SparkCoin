/*
 | --------------------------------------------------------
 | STICKY NESTED ELEMENTS
 | --------------------------------------------------------
 |
 | This funstion provides a simple way to create sticky 
 | elements relative to another.
 | 
 | @author: Rémi Pelhate
 | @requirements: jQuery
 |
 */

function sticky_nested_element()
{
	var threshold  = 90;

	$('.timeline-nav').each(function() {
		// Elements
		var $el 		= $(this);
		var $par 	= $el.parent();
		var $window = $(window);

		// Offsets
		var par_bottom_offset = $par.offset().top - $window.scrollTop() + $par.height();
		var el_outer_height = $el.height() + parseInt($el.css('top'));

		// Animation: make the timeline stick
		if ( $par.offset().top - $window.scrollTop() >= threshold )
		{
			$el
				.css('position', 'absolute')
				.css('top', '0%')
				.css('width', '20%');
		}
		else if ( $el.offset().top - $window.scrollTop() < threshold )
		{
			$el
				.css('position', 'fixed')
				.css('top', '10%')
				.css('width', '16%');
		}

		// Animation: fade it out when the timeline has passed
		if ( par_bottom_offset - el_outer_height <= 0 )
		{
			$el.stop().animate({
				opacity: 0
			}, anim_speed_fast);
		}
		else
		{
			$el.stop().animate({
				opacity: 1
			}, anim_speed_fast);
		}
	});
}