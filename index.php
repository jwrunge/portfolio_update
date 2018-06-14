<!DOCTYPE html>

<html>

<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, user-scalable=no" />
    <title>Jacob Runge</title>
	
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/main.css"/>
	
	<!--JavaScript files-->
	<script src="js/jquery-min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/velocity.ui.min.js"></script>
	<script src="js/switchmenu_velocity.min.js"></script>
	<script src="js/svg_path_animator.js"></script>
</head>

<body>
	<script>
		$('body').prepend('<div id=\'loading_screen\'><div id=\'left_shutter\'></div><div id=\'right_shutter\'></div><div id=\'setup_loading\'><p>Getting set up</p><img src=\'media/Ellipsis.svg\'/></div></div>'); //Set up loading shutters and text
	</script>
	
	<div id='bgimg'></div>
	<video id='bg' alt='' muted>
		<?php 
			$video = rand(1, 4);
			
			if($video == 1)
				echo "<source src='media/Coffee.mp4' type='video/mp4'/>";
			else if($video == 2)
				echo "<source src='media/Cookie.mp4' type='video/mp4'/>";
			else if($video == 3)
				echo "<source src='media/Coffee.mp4' type='video/mp4'/>";
			else if($video == 4)
				echo "<source src='media/Coffee.mp4' type='video/mp4'/>";
		?>
	</video>

	<?php
		include('modules/navigation.php');
	?>
	
	<div id='content_body'>
		<div id='splash_screen'></div>
		<div id='introduction' class='main_screen'>
			<h1>Web Design</h1>
			<div id='introduction_menu' class='submenu'>
				<a href='#web_design'>Services</a>
				<a href='#personal_intro'>About Me</a>
			</div>
			<div class='white_bg' id='web_design'>
				<div class='regular_block'>
					<h2>Let me build you something awesome</h2>
					<p>I build <b>dynamic, responsive, vibrant web experiences</b> that are both <b>intuitive and fun to interact with</b>. From static, promotional websites to interactive web applications, my designs will give your users something to remember you by.</p>
					
					<div class='button_list'>
						<input class='samples' type='button' value='See my portfolio'/>
						<input class='getintouch' type='button' value='Get in touch'/>
					</div>
				</div>
					
				<div class='dark_block attention_block'>
					<img src='media/responsive.svg'/>
					<div class='fifty'>
                        <h3><span class='line'>Responsive designs built</span> <span class='line'>for every</span> <span class='line'>screen size</span></h3>
                        <p>Every design is rigorously tested to ensure it looks just as good on a tiny smartphone as it does on a widescreen computer monitor. With <a href='https://marketingland.com/mobile-top-sites-165725' target='_blank'>56% of consumer web traffic coming from mobile devices</a>, it's just silly not to.</p>
					</div>
					<br clear='both'/>			
				</div>
                
                <div id='library_bg' class='attention_block'>
                    <img src='media/databook.svg'/>
					<div class='fifty leftmost'>
                        <h3><span class='line'>Strong back-end</span> <span class='line'>architecture </span> <span class='line'>and data management</span></h3>
						<p>Solid server-side architecture for dynamic, interactive web applications; powerful custom content management; and reliable database interaction and record-keeping.</p>
					</div>
					<br clear='both'/>					
				</div>
				
				<div class='dark_block attention_block'>
                    <img src='media/intuitive.svg'/>
					<div class='fifty'>
                        <h3><span class='line'>UI that's intuitive</span> <span class='line'>and fun to use</span></h3>
						<p>Your app or website works how your clients think it should, both with a mouse and keyboard and with a touchscreen. Because good user interface design is fun to interact with, your site will never be boring!</p>
					</div>
					<br clear='both'/>					
                </div>
                
                <div id='traffic_bg' class='attention_block'>
					<img src='media/traffic_light.svg'/>
					<div class='fifty leftmost'>
                        <h3><span class='line'>Drive traffic</span> <span class='line'>to your app</span> <span class='line'>or website</span></h3>
						<p>Vibrant design, useful functionality, and an enjoyable user experience keeps them coming back.</p>
					</div>
					<br clear='both'/>					
				</div>
				
				<div class='regular_block'>
					<h2>Your web presence is important</h2>
					<p>Whether you need to maintain client information, to provide sales and service over the internet, or just to get the word about your business or organization out there, <b>quality matters</b>. I begin the design process by learning as much about you and your organization as possible - your core values, your workflow, your client base, your personality. Your web presence shouldn't be a generic template with your logo slapped on top. Your web presence should reflect you, your employees, and your clients.</p>
					
					<div class='button_list'>
						<input class='samples' type='button' value='See my portfolio'/>
						<input class='getintouch' type='button' value='Get in touch'/>
					</div>
				</div>
				
			</div>
			<div class='white_bg' id='personal_intro'>
                <div class='regular_block'>
                    <h2>Who am I?</h2>
                    <p>I'm a web developer living in Illinois with my wife, Mary, and our three dogs, Max, Lucky, and Sadie. We lead pretty busy lives, so we mostly enjoy any opportunity we can get to just stay home and watch a movie, write strange stories, or play board games. A lot of our weekends are spent on our snail's-pace home renovation.</p>
                    <div class='img_scroll'>
                        <img src='media/j&m2.jpg' alt='Jake and Mary Runge in Autumn' class='enlargeable'/>
                        <img src='media/j&m_new.jpg' alt='Jake and Mary Runge' class='enlargeable'/>
                        <img src='media/dogs_new.jpg' alt="Jake's dogs" class='enlargeable'/>
                    </div>
                    <p>Web development has provided me the opportunity to combine the activities I have enjoyed since childhood, from art to coding to writing. It has become something I love getting lost in&mdash;practical puzzles not just to be set aside when solved, but that always make me just a little better of a coder and a little more skillful of a designer; a little more efficient and a little more adventurous. I have discovered a passion for developing engaging, responsive, and accessible designs and interfaces, and for writing code that is useful, adaptable, and efficient.</p>
                    <p>Like what you see? I'd love to hear from you! Get in touch with me <a href='#contact_me' class='getintouch'>here</a>.</p>
                </div>
            </div>
		</div>
		
		<?php include('modules/portfolio.php'); ?>

		<div id='contact_me' class='main_screen'>
			<h1>Contact Me</h1>
			<div class='submenu'></div>
			<div class='white_bg'>
                <div class='regular_block'>
                    <h2>Want to get in touch?</h2>
                    <p><img src='media/gmail.png' class='contact_logo'/>Feel free to email me at <a href='mailto:jwrunge@gmail.com'>jwrunge@gmail.com</a>. I'm happy to answer any questions you may have, or just talk about web development.</p>
                    <p>If you're interested in having your website or webapp (re)designed, please contact me via email. I would love the opportunity to discuss your project!</p>
                    <h2>Want to see more?</h2>
                    <p><img src='media/github.svg' class='contact_logo'/>To see the code for most of my projects, including full site designs, my JavaScript libraries and JQuery plugins, and PHP scripts, check out <a href='https://github.com/jwrunge' target='_blank'>my GitHub page</a>.</p>
                    <p><img src='media/jsfiddle.png' class='contact_logo'/>For interactive JavaScript demos, check out <a href='https://jsfiddle.net/user/jwrunge/fiddles/' target='_blank'>my JSFiddle page</a>.</p>
                </div>
			</div>
		</div>
        
	</div> <!--End 'content_body'-->
	
	<div id='footer'>
		&copy; 2017, Jacob W. Runge &middot; <a href='mailto:jwrunge@gmail.com'>jwrunge@gmail.com</a> &middot; All Rights Reserved. &middot; <a href='attributions.html'>Attributions</a>
	</div>
</body>

<script src="js/bigpicture.js"></script>
<script>

	//References
	var nav_bar = $('#nav_bar');
	var pulldown = $('#nav_mouseover');
	var mobile_threshold = 1015;
	
	//Avoid loading video if on mobile
	if($(window).width() <= mobile_threshold)
		$('#bg').remove();
	
	//Disable nav_bar transitions to start
	nav_bar.addClass('preload');
	
	//Initialize links to invisible
	$('#top_links a').css('visibility', 'hidden');
	
	//Don't allow scrolling until after load
	$('html').css('overflowY', 'hidden');
	
	//Get video element and pause it
	var video = document.getElementById('bg');
	//if(video) video.pause();	
	
	//Set up switch menus
	var header_menu = new SwitchMenu('#nav_bar', ['#splash_screen', '#introduction', '#portfolio', '#contact_me'], {scrollTarget: 'body', scrollDuration: 0, startFunc: function(){$('#content_body').css('height', $('#content_body').height());}, endFunc: function(){$('#content_body').css('height', '');}});
	var intro_menu = new SwitchMenu('#introduction_menu', ['#web_design', '#personal_intro', '#contact_me'], {scrollTarget: 'screen', startFunc: function(){$('#content_body').css('height', $('#content_body').height());}, endFunc: function(){$('#content_body').css('height', '');}});
	var portfolio_menu = new SwitchMenu('#portfolio_menu', ['#full_pages', '#graphics'], {scrollTarget: 'screen', startFunc: function(){$('#content_body').css('height', $('#content_body').height());}, endFunc: function(){$('#content_body').css('height', '');}});
	
	//Resize function - changes nav bar height and screen margins
	$(window).on('resize', function(){
        $('div.main_screen').css('margin-top', '30vh');
	});
	
	//Function for setting the current in-view screen when first opening the page
	function initialize_screens()
	{		
		//Make nav bar invisible if in mobile mode
		if($(window).width() < mobile_threshold)
		{
			nav_bar.addClass('invisible');
			pulldown.removeClass('invisible');
		}
		
		//Set initial splash screen (or other screen) depending on URL
		var hash = window.location.hash;

		if(hash == '#introduction' || hash == '#portfolio' || hash == '#contact_me')
		{
            $('#nav_bar').prop('data-curScreen', hash);
			set_state([hash, null, null]);
			$('#top_links a').css('visibility', 'visible');
		}
		else if(hash == '#web_design' || hash == '#personal_intro')
		{
            $('#nav_bar').prop('data-curScreen', '#introduction');
			set_state(['#introduction', hash, null]);
			$('#top_links a').css('visibility', 'visible');
		}
		else if(hash == '#full_pages' || hash == '#code' || hash == '#graphics')
		{
            $('#nav_bar').prop('data-curScreen', '#portfolio');
			set_state(['#portfolio', null, hash]);
			$('#top_links a').css('visibility', 'visible');
		}
		else
		{
            //Alter history (ensures current page status is logged)
            history.pushState(['#splash_screen', null, null], null, null);
            
            //Handle nav_bar
			if($(window).width() < mobile_threshold)
			{
				nav_bar.removeClass('invisible');
				pulldown.addClass('invisible');
			}
			
			nav_bar.addClass('enlarged');
			
			//Make navbar invisible until bgs are loaded
			$('#nav_bar').css('visibility', 'hidden');
			
			//Create image object to test if it's loaded
			var bgimage = new Image;
			bgimage.src = 'media/novideo_bg.jpg';
			
			//Signature
			var sig = new AniPath('#signature_svg', '.sigs');
			sig.init();
			sig.animate();
		
			//Slide in the links
			$('#top_links a').css('visibility', 'hidden').velocity('transition.slideLeftIn', {delay:  5000, stagger: 250, visibility: 'visible', display: null});
			
			//Ensure nav_bar is visible
			$('#nav_bar').css('visibility', 'visible');
		}
		
		//Open shutters
		$('#left_shutter, #right_shutter, #setup_loading').addClass('open');
		
		if(video) video.play();
		
		//Re-enable scrolling
		$('html').css('overflowY', 'auto');
		
		//Reinstate default nav_bar transitions
		nav_bar.removeClass('preload');
	};
	
	//Ensure everything is resized and loaded before animating
	$(window).resize();
	$(window).on('load', initialize_screens);
	
	//On hash change, alter navigation bar properties
	$(window).on('hashchange', function(){
		var hash = window.location.hash;
		if(hash != '#splash_screen' && hash != '')
			nav_bar.removeClass('enlarged');
		else
			nav_bar.addClass('enlarged');
	});
			
	//On link click, alter menu and nav bar properties
	$('#top_links a').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();

		//Shrink nav bar; switch for pulldown menu
		nav_bar.removeClass('enlarged');
		if($(window).width() <= mobile_threshold)
		{
			nav_bar.addClass('invisible');
			pulldown.removeClass('invisible');
		}
			
		//Reset switch menus for submenus (on first link when switched back in)
		if($('#introduction').css('display') == 'none')
			intro_menu.reset();
		else if($('#portfolio').css('display') == 'none')
			portfolio_menu.reset();
	});
	
	//If logo is clicked, re-enlarge it
	$('#nav_logo').on('click', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		if(!nav_bar.hasClass('enlarged')) nav_bar.addClass('enlarged');

	});
	
	//Bind events on command
	function bind_events()
	{
		$('a.moreinfo_button').off('click').on('click', function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			
			var button = $(this);
			var expander = $(this).prev('div.site_info').find('div.expander');
			
			//expander.removeClass('lessinfo').addClass('moreinfo');
			expander.css('maxHeight', expander[0].scrollHeight + 'px');
			button.removeClass('moreinfo_button').addClass('lessinfo_button').html('- Less info -');
			
			expander.velocity('scroll', {delay: 500, duration: 500, easing: 'ease-in-out', offset: -100});
						
			bind_events();
		});
		
		$('a.lessinfo_button').off('click').on('click', function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			
			var button = $(this);
			var expander = $(this).prev('div.site_info').find('div.expander');
			
			expander.css('maxHeight', '0px');
			button.removeClass('lessinfo_button').addClass('moreinfo_button').html('+ More info +');
			
			expander.velocity('scroll', {delay: 500, duration: 500, easing: 'ease-in-out', offset: -100});
						
			bind_events();
		});
	}
	
	bind_events();	//Initialize events
	
	$('.enlargeable').on('click', function() {
		enlarge_img($(this).attr('src'));
	});
	
	$(window).on('scroll', function() {
	
		//Menubar only appears at top of the page
		if((($(window).width() > mobile_threshold && $(window).scrollTop() > 10) || $(window).width() < mobile_threshold) && $('#splash_screen').css('display') == 'none')
		{	
			if(!currently_switching)
			{
				nav_bar.addClass('invisible');
				pulldown.removeClass('invisible');
			}
		}
		else
		{
			nav_bar.removeClass('invisible');
			pulldown.addClass('invisible');
		}
	});
	
	$(pulldown).on('mouseenter', function()
	{
		nav_bar.removeClass('invisible');
		pulldown.addClass('invisible');
	});
	
	$(pulldown).on('click', function()
	{
		nav_bar.removeClass('invisible');
		pulldown.addClass('invisible');
	});
	
	$(nav_bar).on('mouseleave', function()
	{
		if($(window).scrollTop() > 10 && $('#splash_screen').css('display') == 'none')
		{
			nav_bar.addClass('invisible');
			pulldown.removeClass('invisible');
		}
	});
    
    $('.samples').on('click', function(e){
       e.preventDefault;
       e.stopPropagation;
       set_state(['#portfolio',null,'#full_sites'], true);
    });
    
    $('.getintouch').on('click', function(e){
        e.preventDefault;
        e.stopPropagation;
        set_state(['#contact_me', null, null], true);
    });
		
</script>

</html>