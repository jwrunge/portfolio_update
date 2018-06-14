<div id="nav">	
	<span style='float: left; padding: 5px 0;'>
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
</div>