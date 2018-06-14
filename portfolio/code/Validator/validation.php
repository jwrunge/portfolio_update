<?php
/*
	JACOB RUNGE - 2016
	Updated: 8/6/2017
	
	-$data is an array of the user's data (including email, firstname, lastname, password, confirm_password)
	- $con is a PDO SQL connection object
*/
function validate_post($data, $con)
{
	$errors = [];

	//If email address is invalid
	if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
		array_push($errors, 'Email address is invalid');

	//If firstname or lastname are invalid
	if(!preg_match("/^[a-zA-Z ]*$/", $data['firstname'])) 
		array_push($errors, 'First name contains invalid characters');
	
	if(!preg_match("/^[a-zA-Z ]*$/", $data['lastname'])) 
		array_push($errors, 'Last name contains invalid characters');
	
	//If firstname or lastname are blank
	if($data['firstname'] == '' || $data['lastname'] == '')
		array_push($errors, 'First or last name is blank');
		
	//If password does not have a special char, lower case, upper-case, and number
	if(!preg_match("#.*^(?=.{8,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $data['password']))
		array_push($errors, 'Password must have at least one special character, one lower-case letter, one upper-case letter, and a number');
	
	//If password and confirmed password don't match
	if($data['password'] != $data['confirm_password'])
		array_push($errors, 'Passwords do not match');
		
	return $errors;
}
?>