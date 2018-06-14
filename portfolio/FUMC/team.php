<?php
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	include('modules/connect_to_db.php');
		
	//Ensure user editing the page is allowed to
	if(isset($_GET['edit']))
	{
		//Ensure user is allowed to view this data
		if($_SESSION['approved'] == false)
		{
			echo "<script>window.location = 'login.php?alert=noaccess';</script>";
			exit();
		}
					
		if(!check_permission('manage_staff', $_SESSION['email'], $con))
		{
			echo "<script>window.location = 'account_access.php?alert=noaccess';</script>";
			exit();
		}
	}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width" />

    <title>FUMC Galesburg</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
	<link rel="stylesheet" type="text/css" href="style/forms.css"/>
	<link rel="stylesheet" type="text/css" href="style/staff.css"/>
	<link rel="stylesheet" type="text/css" href="style/cms.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/screen_switch.js"></script>
	<script src="js/dropdown.js"></script>
</head>

<body>
		
	<!--Navigation data - CSS determines how/where shown-->
	<?php
	
		include('modules/navigation.php');
	
		echo "<div id='main_content'>";
		
			echo "<div id='content_screen'>" .
				"<div id='content_pos'>" .
					"<h1>FUMC Team</h1>" .
				"</div>" .
			"</div>";
			
			if(isset($_GET['edit']) && $_GET['edit'] == 'yes')
				place_staff($con, true);
			else
				place_staff($con);
				
			echo "<div id='additions'></div>";
			
			include('modules/footer.php');
		echo "</div>";
		
		if(isset($_GET['edit']) && $_GET['edit'] == 'yes')
		{
			echo "<script src='js/tinymce/tinymce.min.js'></script><script src='js/site_alert.js'></script><script src='js/cms.js'></script>";
		}
	?>
	
	<script src="js/content.js"></script>
	
</body>
</html>