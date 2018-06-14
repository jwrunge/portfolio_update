<div id="nav">

	<div id='mobile_links'>
		<div class='center_links'>
			<a href="index.php#screen_1" id='home_button_mobile' alt='home'><img src='media/core/home.png' alt='home button'/></a>
		</div>
		<div class='center_links'>
			<a href="#menu" id='menu_button' alt='menu'>&#9776;</a>
		</div>
	</div>
		
	<div id='desktop_links'>
		<span style='float: left; padding: 5px 0;'>
			<a href="index.php#screen_1" id='home_button' alt='home'><img src='media/core/home.png' alt='home button'/></a>
			<?php
			if(isset($_SESSION['email']) && $_SESSION['email'] != '')
			{
				echo 	"<span id='admin_links'>
							<a href='account_access.php'>Dash</a> |
							<a href='login.php?alert=logout'>Log out</a>
						</span>";
			}	
			?>
		</span>
		<span style='float: right; padding: 5px 0;'>
			<span id="desktop_scroll_links">
				<a href="index.php#screen_2" id='worship_link'>Worship</a>
				<a href="index.php#screen_3" id='learn_link'>Learn</a>
				<a href="index.php#screen_4" id='community_link'>Community</a>
			</span>
			<a href="team.php">Team</a>
		</span>
	</div>
</div>

<div id='menu_links'>
	<h2><a href="index.php#screen_1">Home</a></h2>
	<h2><a href="index.php#screen_2">Worship</a></h2>
	<div id="worship_links" class="nav_links">
		<?php get_links('worship_links', $con); ?>
	</div>
	<h2><a href="index.php#screen_3">Learn</a></h2>
	<div id="learn_links" class="nav_links">
		<?php get_links('learn_links', $con); ?>
	</div>
	<h2><a href="index.php#screen_4">Community</a></h2>
	<div id="community_links" class="nav_links">
		<?php get_links('community_links', $con); ?>
	</div>
	<a href="team.php"><h2>Team</h2></a>
	<?php
		if(isset($_SESSION['email']) && $_SESSION['email'] != '')
		{
			echo 	"<div id='site_access' class='nav_links'>
						<h2>Site Access</h2>
						<a href='account_access.php'>Dash</a>
						<a href='login.php?alert=logout'>Log out</a>
					</div>";
		}	
	?>
	<br height='2em'/>
</div>