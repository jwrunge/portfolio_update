/*
	TO USE:
	Pass JQuery div reference and array of options and screen elements to create_switch_menu()
*/

/*
	SWITCHING MENUS
*/

//Array of screen order and max push
var max_push = 5;
var screen_order = [];

//Switching animation
function switchin(switch_in, switch_out, scroll_top, track_order, callback)
{
	scroll_top = scroll_top || true;
	track_order = track_order || false;
	callback = callback || null;

	$(switch_out).animate({left: '-10em', opacity: '0'}, 200, 'swing', function() {
		$(this).hide();
		if(scroll_top === true)
			$(switch_in).animate({scrollTop: 0}, 1);
		$(switch_in).css('left', '10em').css('opacity', '0').show().animate({left: '0', opacity: '1.0'}, 200, 'swing', function(){
			if(callback != null)
				callback();
		});
	});
	
	if(track_order)
	{
		screen_order.push(switch_in);
		while(screen_order.length > max_push) screen_order.shift();
	}
}

//Navigate back a screen
function switch_nav_back()
{
	switchin(screen_order[screen_order.length - 2], screen_order[screen_order.length - 1]);
	screen_order.pop();
}

//Reset menu
function reset_switch_menu(div_selector)
{
	//Assemble screen class object for resetting main screen
	screen_class = $('.' + div_selector.substring(1) + '_screens');
	
	$(div_selector + ' a').removeClass('selected');
	$(div_selector + ' a.default_link').addClass('selected');
	
	screen_class.hide();
	screen_class.first().css('opacity', '1').css('left', '0').show();
}

/*
	CREATE SWITCH MENU
*/
//Use var = create_switch(); div = menu div element selector, options = array of links, screens = array of screen div elements
function create_switch_menu(div_selector, options, screens, firstscreen)
{	
	/*
		ENSURE THE MENU AND SCREENS ARE PROPERLY SET UP
	*/
	
	firstscreen = firstscreen || null;
	
	div = $(div_selector);
	div.addClass('switch_menu');	//Make sure the div knows it's a menu
	
	//Make sure the div has a unique ID
	if(!div.prop('id'))
	{
		div.html("ERROR: div does not have a unique ID.");
		return false;
	}
	
	//Set up a class for all link elements based on the div ID (essentially limits switching scope)
	var link_class = div.prop('id') + '_links';
	var screen_class = div.prop('id') + '_screens';
	
	//Make sure the array lengths are not mismatched
	if(options.length != screens.length)
	{
		div.html("ERROR: array lengths do not match.");
		return false;
	}
	
	/*
		SET UP THE MENU
	*/
	//Add options to menu
	var options_string = '';
	
	for(var i=0; i < options.length; i++)
	{
		//Add option text
		if(i != 0)
			options_string += "<a id=\'" + link_class + "_" + i + "\' class='" + link_class + "\'>" + options[i] + "</a>";
		else	//If first item, make it 'selected'
			options_string += "<a id=\'" + link_class + "_" + i + "\' class=\'" + link_class + " default_link selected\'>" + options[i] + "</a>";
	}
	
	div.html(options_string);

	/*
		Set up screens and listeners
	*/
	//Set event handler
	for(var i=0; i < screens.length; i++)
	{
		(function(i, link_class, screen_class, screen){
			
			//Make sure the screens are all members of the screen class
			$(screen).addClass(screen_class);
			
			//Hide screen if not default
			if(i != 0)
				$(screen).hide();
		
			$('#' + link_class + "_" + i).on('click', function(e)
			{
				$('.' + link_class).removeClass('selected');
				$(this).addClass('selected');
				switchin(screen, '.' + screen_class);
			});
		})(i, link_class, screen_class, screens[i]);
	}
	
	$('.' + screen_class).css('position', 'relative');
	
	//Set first screen
	if(firstscreen) screen_order.push(firstscreen);
}