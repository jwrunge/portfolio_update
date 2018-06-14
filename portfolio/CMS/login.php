<?php 
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	include('modules/connect_to_db.php');

	//VALIDATION
	function validate_post($email, $con)
	{
		if($email === null)
			return false;
	
		$user = check_for_user($email, $con);
		$success = true;
			
		//User information
		if(!$user)
			return false;
		
		//Password information
		if(!hash_equals($user['password'], crypt($_POST['password'], $user['password'])))
			$success = false;
			
		//If success is still true, redirect
		if($success)
		{
			$_SESSION['email'] = $user['email'];
			$_SESSION['firstname'] = $user['firstname'];
			$_SESSION['lastname'] = $user['lastname'];
			$_SESSION['approved'] = $user['approved'];
			header("Location: account_access.php");
			return true;
		}
		else
			return false;
	}
	
	$error = ''; //Error container
	
	//Handle $_GETs
	if(isset($_GET['alert']))
	{
		if($_GET['alert'] == 'created')
		{
			$error = "<p class='error'>Your account has been created; however, access is pending approval by a site administrator.</p>";
		}
			
		else if($_GET['alert'] == 'logout')
		{
			session_unset();
			session_destroy();
			$error = "<p class='error'>You have been logged out.</p>";
		}
			
		else if($_GET['alert'] == 'noaccess')
		{
			session_unset();
			session_destroy();
			$error = "<p class='error'>You have not been approved for access by a site administrator, or you are not currently logged in. You cannot access privileged resources.</p>";
		}
	}
	
	else if(isset($_SESSION['email']) && $_SESSION['email'] != '')
	{
		header("Location: account_access.php");
	}
	
	if(!empty($_POST) && isset($_POST['email']) && !validate_post($_POST['email'], $con))
		$error = "<p class='error'>There was a problem with your user email and password.</p>";
		
	//Create new username and password
	do { $user = rand(0,999999999); } while(check_for_user($user, $con));
	$pass = rand(0,999999999);
	
	add_user($user, "Guest", "Guest", $pass, $con);
	approve_user($user, 1, $con);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width" />

    <title>Login</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
	<link rel="stylesheet" type="text/css" href="style/forms.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/dropdown.js"></script>
</head>

<body>

	<!--Navigation data - CSS determines how/where shown-->
	<?php include('modules/navigation.php'); ?>
		
	<div id='main_content'>
		<div id='content_screen'>
			<div id='content_pos'>
				<h1>Admin Access</h1>
			</div>
		</div>
			
		<div class='entry'>
			<?php
				if($error != '')
					echo $error;
			?>
			
			<h2>Welcome to the CMS demo!</h2>
			<p>Some features of the CMS (such as account creation, account approval, and permissions management) are disabled; however, page editing and image management are fully functional. A temporary account has been created for you, and all changes that you make will be visible only while you are signed in to this account. The account will be deleted at 3:00 AM.</p>
			<p>Please sign in with your temporary account. If you need a new one, use:<br/>username: <b><?php echo $user; ?></b><br/>password: <b><?php echo $pass; ?></b>
			
			<form action="login.php" method="post">
				
				<label>Email Address:</label> <input type='text' name='email' value="<?php echo $user; ?>"/> <br/>
				
				<label>Password:</label> <input type='password' name='password' value="<?php echo $pass; ?>"/> <br/>
				
				<input type="submit" id="submit_button" value="Submit"/>
				
			</form>
			
			<p>For this archived site, all login and CMS features have been removed. You can demo the custom CMS here. [Login request disabled]</p>
			
			<br/>
			
		</div>
		
		<?php include('modules/footer.php'); ?>
	</div>
	
	<script src="js/content.js"></script>
	
</body>
</html>