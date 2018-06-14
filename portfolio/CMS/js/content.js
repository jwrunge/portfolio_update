$(document).ready(function(){

	/*****
		WINDOW RESIZING
	*****/
	
	var prev_height = $(window).height();	//Store window height info
	var prev_width = $(window).width();	//Store window width info
	
	//Set initial positions
	$('#content_screen').css('min-height', '50vh');
	$('#content_screen').css('height', .7 * $(window).height());
	
	//Conditional repositioning on window resize (avoids ugly mobile browser resizing based on vh)
	$(window).resize(function()
	{
		if(Math.abs($(window).height() - prev_height) > 60 || $(window).scrollTop < 10 || $(window).width() != prev_width)
		{
			$('#content_screen').css('min-height', '50vh');
			$('#content_screen').css('height', .7 * $(window).height());

			prev_height = $(window).height();	//update prev_height
		}
		
		prev_width = $(window).width();	//update prev_height
	});
	
	$(window).resize();	//run on load
	
});