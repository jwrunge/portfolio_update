$(document).ready(function(){

	//var mobile_width should be defined in dependency "dropdown.js"
	var disallow_location_bar = false;

	/*****
		WINDOW RESIZING
	*****/
	
	var prev_height = $(window).height();	//Store window height info
	var prev_width = $(window).width();	//Store window width info
	
	//Set initial positions
	$('#screen_1').css('min-height', '50vh');
	
	$('body').backstretch([
			{url: 'media/cool_church.jpg'},
			{url: 'media/youth.jpg', alignY: 'top'},
			{url: 'media/group.jpg'},
			{url: 'media/perspective.jpg', alignY: 'bottom'}
			], {duration: 6000, transition: 'pushLeft', transitionDuration: 300, animateFirst: false});
	
	//Conditional repositioning on window resize (avoids ugly mobile browser resizing based on vh)
	$(window).resize(function()
	{
		$('#screen_1').css('height', $('#main_content').height() + 'px');
		
		$('#location').show();
		if($('#location').offset().top < $('#logoMobile').offset().top + $('#logoMobile').height() + 50)
		{
			$('#location').hide();
			disallow_location_bar = true;			
		}
		else
			disallow_location_bar = false;
	});
	
	$(window).resize();	//run on load
		
	/*****
		SCROLL TO HASH
	*****/
	
	//If you click a nav link with a #, prevent default link behavior and scroll to the top of the intended link, minus the height of the nav bar
	$('#worship_times, #nav a[href*="#"], #menu_links a[href*="#"], #worship_times_mobile a').click(function(e){
			
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")

		//If the hash value is not blank, obtain the hash value as a scroll-to target
		if(this.hash != '#menu')
		{
			var target = this.hash;	//get the hash value from the nav>a

			//Stop animations in process, then animate scrolling to target; this accounts for the height of $nav if it is at the top of the screen
			if($(window).width() >= mobile_width)
			{
				$('.nav_links').stop().slideUp(300);
				$('#main_content').stop().animate({'scrollTop': $(target)[0].offsetTop}, 900, 'swing');
			}
			else
			{
				$('#menu_button').html('&#9776;');
				if(menu_engaged === true)
				{
					switchin('#main_content', '#menu_links', false, false, function(){
						$('#main_content').stop().animate({'scrollTop': $(target)[0].offsetTop}, 900, 'swing');
					});
					menu_engaged = false;
				}
				else
					$('#main_content').stop().animate({'scrollTop': $(target)[0].offsetTop}, 900, 'swing');
			}
		}
	});
	
	
	/*****
		HANDLE THE RECOLORING OF ANCHOR LINKS AND ARROW HREF BASED ON PAGE LOCATION; HANDLE LOCATION BAR FADE
	*****/
	
	//Flags tracking whether the location div/home and previous buttons and next buttons should be faded
	var location_fade = false;
	
	//Initialize home and previous buttons to transparent
	$('#home_button').css('opacity', '0.2');
	$('#home_button_mobile').css('opacity', '0.2');
	
	//Scroll position function - check for page position
	$('#main_content').on('scroll', function()
	{
		var y_scroll_pos = $('#main_content').scrollTop();	//y scroll position stored

		//Handle location appearance / disappearance
		//If y > 20px, fade out location div, fade in location; opposite if <=
		if(y_scroll_pos > 100 && location_fade==false)
		{
			$('#location').stop().fadeOut(500);
			$('#home_button').stop().fadeTo(500, 1);
			$('#home_button_mobile').stop().fadeTo(500, 1);
			location_fade = true;
		}
		else if(y_scroll_pos <= 100 && location_fade==true)
		{
			if(disallow_location_bar === false)
				$('#location').stop().fadeIn(500);
			$('#home_button').stop().fadeTo(500, 0.2);
			$('#home_button_mobile').stop().fadeTo(500, 0.2);
			location_fade = false;
		}
				
		if($(window).width() >= mobile_width)	//in the event of an extremely small window, disable most menu effects
		{
			//Set nav link colors to highlight section you are on; replace anchor href accordingly
			if(y_scroll_pos < $('#screen_2')[0].offsetTop - 100)
			{
				$('#nav a').css('color', '');
			}
			else if(y_scroll_pos >= $('#screen_2')[0].offsetTop - 100 && y_scroll_pos < $('#screen_3')[0].offsetTop - 100)
			{
				$('#nav a:link').css('color', '');
				$('#worship_link').css('color', 'orange');
			}
			else if(y_scroll_pos >= $('#screen_3')[0].offsetTop - 100 && y_scroll_pos < $('#screen_4')[0].offsetTop - 100)
			{
				$('#nav a').css('color', '');
				$('#learn_link').css('color', 'orange');
			}
			else if(y_scroll_pos >= $('#screen_4')[0].offsetTop - 100)
			{
				$('#nav a').css('color', '');
				$('#community_link').css('color', 'orange');
			}
		}
	});
});