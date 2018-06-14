<?php 
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	include('modules/connect_to_db.php');
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width" />

    <title>FUMC Galesburg</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
	<link rel="stylesheet" type="text/css" href="style/index.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/screen_switch.js"></script>
	<script src="js/dropdown.js"></script>
</head>

<body>

	<!--Navigation data - CSS determines how/where shown-->
	<?php include('modules/navigation.php'); ?>
	
	<div id='main_content'>
		<!--
		SCREEN  1: Title Screen
		-->
		<div id="screen_1" class="screen">
			<!--Two possible logo images here -- CSS stylesheet determines appropriate one to show-->
			<img id="logo" alt="First United Methodist Church logo" src="media/core/umcg_logo2.png"/>
			<img id="logoMobile" alt="First United Methodist Church logo" src="media/core/umcg_logo_mobile2.png"/>
		
			<div id='location'>
				<div id='sub-location'>
					<a id='worship_times' href="#worship_time_p"><img src='media/core/worship_times.png' alt='Worship Times'/></a>
					<a id='directions' href="https://www.google.com/maps/place/120+N+Kellogg+Galesburg+IL+61401" target='_blank'><img src='media/core/location-symbol.png' alt='Directions to the church'/></a>
					<a id='call' href='tel:309-342-3197'><img src='media/core/call_us.png' alt='Call the church'/></a>
					<a id='email' href='mailto:galesburgfumc@gmail.com'><img src='media/core/email_us.png' alt='Email the church'/></a>
					<a id='fb_button' href='https://www.facebook.com/galesburgfirst' target='_blank'><img src='media/core/fb.png' alt='Link to church Facebook'/></a>
				</div>
			</div>
		</div>

		<div id="screen_2" class='screen'>		

			<div class="imgDiv"><h1>Open Hearts</h1></div>

			<div class='link_block'>
				<?php get_links('worship_links', $con); ?>
			</div>
			
			<div class="entry">
				<h1>Who are we?</h1>
				<p>Galesburg First United Methodist Church is a community of faith where open hearts are passionately rekindled, open minds are nurtured, and where open hands reach out to the needs of our neighbors. Member, friend, or guest, we invite you to join us with <b>Open Hearts</b> for Sunday morning worship!</p>
				
				<div id='attention_box'>
					<div id='worship_time_p'>
						<p>
							<h3>Sunday Morning Worship</h3>
							Contemporary Service - 9am<br/>
							Traditional Service - 10:30am<br/>
							<a href='content.php?page=worship_services'>More Information</a>
						</p>
					</div>
					
					<div id='logistics'>
						<p>
							120 N. Kellogg St &middot; 309.342-3197 &middot; <a href='mailto:galesburgfumc@gmail.com'>Email us</a>
						</p>
					</div>
				</div>
			</div>
				
			<br clear="both"/>
		</div>

		<div id="screen_3" class='screen'>

			<div class="imgDiv"><h1>Open Minds</h1></div>
			
			<div class='link_block'>
				<?php get_links('learn_links', $con); ?>
			</div>

			<div class='entry'>
				<h1>Our Desire to Learn</h1>
			
				<p>Education is at the heart of Christian ministry, and what we do here at Galesburg FUMC. As Disciples of Jesus Christ, we are called to keep ourselves open to God's new lessons, and to discern how those lessons affect our lives and our community. We have many Sunday School classes and Bible Studies, as well as small groups available for children, teenagers, and adults. Join us with <b>Open Minds</b> as we explore God's presence in the world today!</p>
			</div>
		</div>

		<div id="screen_4" class='screen'>

			<div class="imgDiv"><h1>Open Hands</h1></div>

			<div class='link_block'>
				<?php get_links('community_links', $con); ?>
			</div>

			<div class='entry'>
				
				<h1>Our Community of Faith</h1>

				<p>Our Community of Faith isn't just a Sunday morning thing, and it isn't confined to the church building. Whether it's by our leadership in Galesburg's Feed the Kids Program, our support of the <a href='http://www.chaddock.org/' target='_blank'>Chaddock Children's Home</a>, or packing up and heading to the nearest soup kitchen, FUMC strives to be a church that make an impact on the community. Find out how our <b>Open Hands</b> are reaching out to our neighbours and to each other. To see what's going on right now, be sure to check out our Facebook page!</p>
				
			</div>
				
		</div>
		
		<?php include('modules/footer.php'); ?>
	</div> <!-- END MAIN CONTENT -->
		
	<script src="js/backstretch.js"></script>
	<script src="js/index.js"></script>
	
</body>
</html>