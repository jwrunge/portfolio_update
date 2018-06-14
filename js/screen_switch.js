/*
	TO USE:
	Pass JQuery menu reference and array of options and screen elements to create_switch_menu()
*/

/*
	SWITCH MENU OBJECT
*/
var SwitchMenu = function(menu_selector, screens, ops)
{
	//Handle options 
	var settings = {
		firstscreen: null,
		callback: null,
		track_order: null,
		top: 'both',
		body_top: 0,
		target_top: 0,
		body_scroll_speed: 0,
		target_scroll_speed: 0
	}
	
	if(ops !== null)
		$.extend(settings, ops); //merge options into settings

	//Array of screen order and max push
	this.max_push = 5;
	this.screen_order = [];
	
	//Ensure the menu and screens are properly set up; display error if not
	var menu = $(menu_selector);			//Reference to the menu
	menu.addClass('switch_menu');			//Make sure the menu knows it's a menu
	var options = $(menu_selector + ' a'); 	//Reference to the anchors in the menu
	var screen_class = menu.prop('id') + '_screen'; //Class for all menu subscreens
	
	//Set a menu screen without animation
	this.set_screen = function(switch_in, switch_out)
	{
		$(switch_out).hide();
		$(switch_in).animate({scrollTop: 0}, 1);
		$(switch_in).css('left', '0').css('opacity', '1').show();
		menu.children('a').removeClass('selected').first().addClass('selected');
	}
	
	//Reset menu
	this.reset = function(only_if_hidden) //Only if hidden is a selector
	{
                only_if_hidden = only_if_hidden || false;
		if(only_if_hidden && $(only_if_hidden).css('display') != 'none') //Only reset if only_hidden is false (default) --> passing a selector allows for reset without affecting only_if_hidden
			return;
		
		$('.' + screen_class).hide();
		$('.' + screen_class).first().css('opacity', '1').css('left', '0').show();
		menu.children('a').removeClass('selected').first().addClass('selected');
	}
	
	//Switching animation
	this.switchin = function(switch_in, switch_out, ops) //callback = null, track_order)
	{
                track_order = track_order || null;
 
		var settings = {
			callback: null,
			track_order: null,
			top: 'both',
			body_top: 0,
			target_top: 0,
			body_scroll_speed: 0,
			target_scroll_speed: 0
		}
		
		if(ops !== null)
			$.extend(settings, ops); //merge options into settings
	
		//Scroll body
		if(settings.top == 'both' || settings.top == 'body')
		{
			$('html, body').animate({scrollTop: settings.body_top}, settings.body_scroll_speed); 
		}
		
		//Scroll target
		if(settings.top == 'both' || settings.top == 'target')
		{
			$(switch_in).animate({scrollTop: settings.target_top}, settings.target_scroll_speed);
		}
	
		$(switch_out).animate({left: '-10em', opacity: '0'}, 200, 'swing', function() {
			$(this).hide();	//hide switch_out after animation
				
			//Bring in new screen
			$(switch_in).css('left', '10em').css('opacity', '0').show().animate({left: '0', opacity: '1.0'}, 200, 'swing', settings.callback);
		});
		
		if(settings.track_order)
		{
			this.screen_order.push(switch_in);
			while(this.screen_order.length > this.max_push) this.screen_order.shift();
		}
	}

	//Navigate back a screen
	this.switch_nav_back = function()
	{
		this.switchin(this.screen_order[this.screen_order.length - 2], this.screen_order[this.screen_order.length - 1]);
		this.screen_order.pop();
	}
	
	//Bind event listeners to each anchor; iterate over screens to ensure specific screen is affected (not only the last in the array)
	screenMenu_object = this;	//Set reference; this changes context in $.each()
	$.each(screens, function(index, current_screen)
	{
		if(current_screen != 'skip' && current_screen != null) //Two options to skip assigning action to an anchor: 'skip' or null
		{
			$(current_screen).addClass(screen_class);	//Add common class
		
			$(options[index]).on('click', function(e)
			{
				e.preventDefault();		//prevents default link behavior
				e.stopPropagation();	//prevents parent anchors from enacting default link behavior
				
				if($(current_screen).css('display') == 'none')
				{
					screenMenu_object.switchin(current_screen, '.' + screen_class, ops);
				}
				
				menu.children('a').removeClass('selected');
				$(this).addClass('selected');
			});
		}
		else
			$(current_screen).addClass(screen_class);	//Add common class
	});
	
	$('.' + screen_class).css('position', 'relative');	//Ensure all screens are set to relative
	
	//Set first screen; default is screens[0]
	if(settings.firstscreen != null)
	{
		this.screen_order.push(settings.firstscreen);
		this.set_screen(settings.firstscreen, '.' + screen_class);
	}
	else
	{
		this.screen_order.push(screens[0]);
		this.set_screen(screens[0], '.' + screen_class);
	}
}