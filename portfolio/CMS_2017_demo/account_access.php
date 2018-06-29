<?php 
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	include('modules/connect_to_db.php');
	
	//Ensure user is allowed to view this data
	if($_SESSION['approved'] == false)
	{
		echo "<script>window.location = 'login.php?alert=noaccess';</script>";
		exit();
	}
		
	//Set up folders if needed
	if(!file_exists('media/' . $_SESSION['email'] . '/'))
	{
		mkdir('media/' . $_SESSION['email'] . '/');
		mkdir('media/' . $_SESSION['email'] . '/folder1');
		mkdir('media/' . $_SESSION['email'] . '/folder1/subfolder1');
		mkdir('media/' . $_SESSION['email'] . '/folder1/subfolder2');
		mkdir('media/' . $_SESSION['email'] . '/folder2');
		mkdir('media/' . $_SESSION['email'] . '/folder2/subfolder3');
		mkdir('media/' . $_SESSION['email'] . '/folder2/subfolder4');
		
		copy('media/grumpycat.jpg', 'media/' . $_SESSION['email'] . '/grumpycat.jpg');
		copy('media/bird.jpg', 'media/' . $_SESSION['email'] . '/bird.jpg');
		copy('media/trexdog.jpg', 'media/' . $_SESSION['email'] . '/trexdog.jpg');
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width" />

    <title>Account Access</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/dropdown.js"></script>
</head>
<body>

	<!--Navigation data - CSS determines how/where shown-->
	<?php include('modules/navigation.php'); ?>
	
	<div id='main_content'>
		<div id='content_screen'>
			<div id='content_pos'>
				<h1><?php echo $_SESSION['firstname']; ?>'s Dashboard</h1>
				<p id='js_warning' style='color: white; background-color: red; text-align: center; margin: 0 auto; padding: .5em;'>NOTE: This feature requires JavaScript to be enabled. It will not function correctly unless you enable JavaScript on this page.</p>
				<script>$('#js_warning').remove();</script>
			</div>
		</div>
			
		<div class='entry'>
			
			<?php
				//AUTHENTICATION
				if(isset($_GET['alert']) && $_GET['alert'] == 'noaccess')
					echo "<p>You have not been authorized to access this resource. If this is an error, please try logging out and logging in again. If the problem persists, please contact a site administrator.</p>";
					
				
				//TASKS
				echo "<h3>Tasks</h3>";
				$no_tasks = true;
				
				echo "<ul>";
				
				echo "<li>Approve Accounts [disabled]</li>";
				echo "<li>Assign Pages and Tasks [disabled]</li>";
				
				echo "<li><a href='image_upload.php' >Manage Image Store</a></li>";
				
				echo "<li>Manage Staff Entries [disabled]</li>";
				
				echo "</ul>";
					
					
				//GET CONTENT LINKS
				echo "<h3>Edit pages</h3>";
				$no_pages = true;
				
				$worship_links = get_links('worship_links', $con, false);
				echo "<ul>";
				for($i = 0; $i < count($worship_links) - 1; $i++)
				{
					echo "<li><a  href='" . $worship_links[$i]['href'] . "&edit=yes'>" . $worship_links[$i]['value'] . "</a></li>";
				}
				
				echo "</ul>";
			?>
			
			<br/>
			
		</div>
		
		<?php include('modules/footer.php'); ?>
	</div>
		
	<script src="js/content.js"></script>
	
</body>
</html>