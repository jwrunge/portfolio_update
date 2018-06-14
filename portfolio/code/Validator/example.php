<script src='validation.js'></script>
<?php 
	include('validation.php'); 
	if(isset($_POST['form_data']))
	{
		$sname = 'localhost';
		$dname = 'jakesite';
		$uname = 'root';
		$pword = '77658572';

		//Connect to database
		$con = new PDO("mysql:host=$sname; dbname=$dname", $uname, $pword);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Set error checking
		
		$errors = validate_post($_POST['form_data'], $con);
	}
?>

<div id='content_body'>

	<form action="example.php" method="post">
				
		<label>First Name:</label> <input type='text' name='form_data[firstname]'  onkeyup="text_validation(this, text_err)"/> <br/>
		
		<label>Last Name:</label> <input type='text' name='form_data[lastname]'  onkeyup="text_validation(this, text_err)"/> <br/>
		
		<label>Email Address:</label> <input type='text' name='form_data[email]' onkeyup="email_validation(this, email_err)"/> <br/>
		<div id="email_err" class="form_error"></div>
		
		<label>Password:</label> <input id='password' type='password' name='form_data[password]' onkeyup='password_validation(this, len_error, char_error)'/> <br/>
		<div id="len_error" class="form_error"></div>
		<div id="char_error" class="form_error"></div>
		
		<label>Confirm Password:</label> <input type='password' name='form_data[confirm_password]' onkeyup='pass_match_validation(this, password, pass_confirm_error)'/> <br/>
		<div id="pass_confirm_error" class="form_error"></div>
		
		<div>
			<p>JavaScript found the following errors:</p>
			<div id="boxfill_error" class="form_error"></div>
			<div id="text_err" class="form_error"></div>
			
			<?php if(isset($_POST['form_data'])) { ?>
				<br/>
				<p>You have posted data, and PHP found the following errors:</p>
				<ul>
					<?php foreach($errors as $error) echo "<li>" . $error . "</li>"; ?>
				</ul>
			<?php } ?>
		</div>
		
		<input type="submit" id="submit_button" value="Submit"/>
		
	</form>

</div> <!--End 'content_body'-->