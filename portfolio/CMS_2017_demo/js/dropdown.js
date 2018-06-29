//Set menu status
var menu_engaged = false;
var mobile_width = 770;

$(document).ready(function(){
	
	/*****
		MENU RESIZING
	*****/
	
	$(window).resize(function()
	{
		var content_height = ($(window).height() - $('#nav').height()) + 'px';
		
		//Reset menu status
		if(menu_engaged === true)
		{
			switchin('#main_content', '#menu_links', false);
			$('#menu_button').html('&#9776;');
			menu_engaged = false;
		}
		
		if($(window).width() < mobile_width)
		{
			$('.nav_links').attr('style', '');
			$('#menu_links').attr('style', '');
			$('#main_content').attr('style', '');
			
			$('#menu_links').css('height', content_height);
			$('#main_content').css('height', content_height);
		}
		else
		{
			$('.nav_links').attr('style', '');
			$('#menu_links').attr('style', '');
			$('#menu_links').css('top', $('#nav').outerHeight() - 1 + 'px');
			$('#main_content').css('height', content_height);
			$('#main_content').css('top', $('#nav').height() + 'px');
		}
	});
	
	$(window).resize();	//call first time
	
	/*****
		HANDLE APPEARANCE / DISAPPEARANCE OF SUB-LINKS UNDER NAV BAR IN DESKTOP MODE
	*****/
	
	//Prevent hover on click
	$('#desktop_links a').on('click', function()
	{
		$('.nav_links').stop(true).slideUp(1);
	});
	
	//Sliding down submenu links
	$('#nav a[href*="#screen_2"]').on('mouseenter', 
		function() 
		{ 			
			if($(window).width() >= mobile_width)
			{
				//Slide down appropriate submenu
				$('#worship_links').css('z-index', 2001).stop(true).slideDown(300);
				
				if($('#worship_links').width() > $(this).width())
					$('#worship_links').css('left', $(this).offset().left - Math.abs($(this).width() - $('#worship_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
				else
					$('#worship_links').css('left', $(this).offset().left + Math.abs($(this).width() - $('#worship_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
			}
		}
	);
	
	//When mouse leaves the link, fade the submenu
	$('#nav a[href*="#screen_2"]').on('mouseleave',
		function()
		{
			if($(window).width() >= mobile_width)
				$('#worship_links').css('z-index', 2000).stop(true).slideUp(300);
		}
	);
	
	//Next two submenu function pairs behave similarly	- Screen 3
	$('#nav a[href*="#screen_3"]').on('mouseenter', function() { 
		if($(window).width() >= mobile_width)
		{
			$('#learn_links').css('z-index', 2001).stop(true).slideDown(300);
			
			if($('#learn_links').width() > $(this).width())
				$('#learn_links').css('left', $(this).offset().left - Math.abs($(this).width() - $('#learn_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
			else
				$('#learn_links').css('left', $(this).offset().left + Math.abs($(this).width() - $('#learn_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
		}
	});
	
	$('#nav a[href*="#screen_3"]').on('mouseleave',
		function()
		{
			if($(window).width() >= mobile_width)
				$('#learn_links').css('z-index', 2000).stop(true).slideUp(300);
		}
	);
	
	//Screen 4
	$('#nav a[href*="#screen_4"]').on('mouseenter', 
		function() 
		{ 
			if($(window).width() >= mobile_width)
			{
				$('#community_links').css('z-index', 2001).stop(true).slideDown(300);
				
				if($('#community_links').width() > $(this).width())
					$('#community_links').css('left', $(this).offset().left - Math.abs($(this).width() - $('#community_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
				else
					$('#community_links').css('left', $(this).offset().left + Math.abs($(this).width() - $('#community_links').width())/2 + 5 + 'px');	//Position the submenu horizontally
			}
		}
	);
	
	$('#nav a[href*="#screen_4"]').on('mouseleave',
		function()
		{
			if($(window).width() >= mobile_width)
				$('#community_links').css('z-index', 2000).stop(true).slideUp(300);
		}
	);
		
	//Fade in submenu on mouseenter (prevents fading when you leave link area); fade out on mouseleave
	$('.nav_links').on('mouseenter', 
		function() 
		{
			if($(window).width() >= mobile_width)
				$(this).stop(true).slideDown(300);
		}
	);
	
	$('.nav_links').on('mouseleave', 
		function() 
		{
			if($(window).width() >= mobile_width)
				$(this).stop(true).slideUp(300);
		}
	);
	
	/*****
		MOBILE MENU
	*****/
	
	$('#menu_button').click(function(e){
	
		//Prevent default link behavior ("jumping" to the anchor)
	    e.preventDefault();		//prevents default link behavior
		e.stopPropagation();	//prevents parent anchors from enacting default link behavior ("bubbling up")
		
		if(menu_engaged == false)
		{
			switchin('#menu_links', '#main_content', true);
			$('#menu_button').html('X');
			menu_engaged = true;
		}
		else
		{
			switchin('#main_content', '#menu_links', false);
			$('#menu_button').html('&#9776;');
			menu_engaged = false;
		}
	});
});