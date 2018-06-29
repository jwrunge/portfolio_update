/*
	TO USE:
	Pass target selector to functon (create_slider('#target')); $('#target') now has .reveal(), .conceal(), and .toggle() methods
*/

function create_slider(target)
{
	this.target = target;
	this.essential_height = $(target).height();
	this.slide_status = 'shown';
	
	this.reveal = function(speed = 300, easing = 'swing')
	{
		$(this.target).height(0).show().stop().animate({height: this.essential_height}, speed, easing);
		this.slide_status = 'shown';
	}
	
	this.conceal = function(speed = 300, easing = 'swing')
	{
		$(this.target).show().stop().animate({height: '0'}, speed, easing, function() { $(this.target).hide(); });
		this.slide_status = 'hidden';
	}
	
	this.toggle = function(speed = 300, easing = 'swing')
	{
		if(this.slide_status == 'hidden')
			this.reveal(speed, easing);
		else
			this.conceal(speed, easing);
	}
}