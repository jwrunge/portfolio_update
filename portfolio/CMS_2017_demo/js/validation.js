/*
	JACOB RUNGE - 2016
	Updated: 8/11/2016
	
	-Set password event listener onkeyup to password_validation (calls length and char validations)
	-Pass password, password confirmation, and error message elements to functions
	-You can set error message parameters to null if you don't have error checking <div>s
	
	-IMPORTANT: This does not replace server-side validation! Javascript can be disabled. :-)
*/

//Check against special char array
function check_against_specials(character)
{
	var special_chars = [ '!', '\"', '#', '$', '%', '&', '\'', '(', ')', '*', '.', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|', '}', '~' ];
	
	for(var i = 0; i < special_chars.length; i++)
	{
		if(character == special_chars[i])
			return true;
	}
	
	return false;
}

//Check array (string) against special chars (calls check_against_specials())
function check_array_against_specials(array)
{
	var return_var = false;
	for(var i = 0; i < array.length; i++)
	{
		//If return_var remains false, check again; otherwise, break loop
		if(return_var == false)
			return_var = check_against_specials(array[i]);
		else
			break;
	}
	
	return return_var;
}

//Zip validation
function zip_validation(zip, error_msg)
{
	//If zip is not a number or does not equal 5 digits
	if(isNaN(zip.value) || zip.value.length != 5)
	{
		zip.style.backgroundColor = "red";
		zip.style.color = "white";
		
		if(error_msg !== null)
			error_msg.innerHTML = "5-digit zip code should only contain numbers";
		
		return false;	//Validation failed
	}
	
	else
	{
		zip.style.backgroundColor = "";
		zip.style.color = "";
		
		if(error_msg !== null)
			error_msg.innerHTML = "";
		
		return true;	//Validation succeeded
	}
}

//Text validation
function text_validation(input, error_msg)
{
	//If special chars are detected, mark error
	if(check_array_against_specials(input.value))
	{
		input.style.backgroundColor = "red";
		input.style.color = "white";
		
		if(error_msg !== null)
			error_msg.innerHTML = "Some text fields contain invalid characters. Use only upper- and lower-case alphanumeric characters.";
		
		return false;	//Validation failed
	}
	
	//Otherwise, clear error
	else
	{
		input.style.backgroundColor = "";
		input.style.color = "";
		
		if(error_msg !== null)
			error_msg.innerHTML = "";
		
		return true;	//Validation succeeded
	}
}

//Phone validation
function phone_validation(phone, error_msg)
{
	//If format is valid and no illegal chars
	if(isNaN(phone.value) || check_array_against_specials(phone.value))
	{
		phone.style.backgroundColor = "red";
		phone.style.color = "white";
		
		if(error_msg !== null)
			error_msg.innerHTML = "Invalid format: key 10-digit number with no separating punctuation (e.g. 1235554567)";
			
		return false;	//Validation failed
	}
	
	else if(phone.value.length < 10)
	{
		phone.style.backgroundColor = "red";
		phone.style.color = "white";
		
		if(error_msg !== null)
			error_msg.innerHTML = "Key 10 digits, including area code";
			
		return false;	//Validation failed
	}
	
	else
	{
		phone.style.backgroundColor = "";
		phone.style.color = "";
		
		if(error_msg !== null)
			error_msg.innerHTML = "";
			
		return true;	//Validation succeeded
	}
}

//Email validation
function email_validation(email, error_msg)
{
	//Check for @
	var at_present = false;
	for(var i = 0; i < email.value.length; i++)
	{
		if(email.value[i] == '@' && i > 1)
			at_present = true;
	}
	
	//Validate
	if(at_present)
	{
		email.style.backgroundColor = "";
		email.style.color = "";
		
		if(error_msg !== null)
			error_msg.innerHTML = "";
			
		return true;	//Validation succeeded
	}
	
	else
	{
		email.style.backgroundColor = "red";
		email.style.color = "white";
		
		if(error_msg !== null)
			error_msg.innerHTML = "Email address not valid";
			
		return false;	//Validation failed
	}
}

//Completion validation
function form_completion_validation(form, error_msg)
{
	//Determine number of blank fields
	var empty_boxes = 0;
	var inputs = form.getElementsByTagName('input');
	for(var i = 0; i < inputs.length; i++)
	{
		if(inputs[i].value == "" && inputs[i].type != "submit")
			empty_boxes += 1;
	}
	
	if(empty_boxes > 0)
	{
		if(error_msg !== null)
			error_msg.innerHTML = "Incomplete form: please fill all fields";
		return false;	//validation failed
	}
	else
	{
		if(error_msg !== null)
			error_msg.innerHTML = "";
		return true;
	}
}

//Password length validation
function pass_len_validation(password, error_msg)
{
	//If password is too short
	if(password.value.length < 8)
	{
		if(error_msg != null)
			error_msg.innerHTML = "Password must exceed 8 characters.";
			
		return false;	//validation failed
	}
	
	//If password is too long
	else if(password.value.length > 30)
	{
		if(error_msg != null)
			error_msg.innerHTML = "Password must not exceed 30 characters.";
		
		return false;	//validation failed
	}
	
	else
	{
		error_msg.innerHTML = "";
		
		return true;	//valdiation succeeded
	}
}

//Password character validation
function pass_char_validation(password, error_msg)
{
	//Error flags
	var capital_used = false;
	var special_char_used = false;
	var lower_used = false;
	var num_used = false;
	
	//Iterate over password's length
	for(var i = 0; i < password.value.length; i++)
	{
		//If char is not a number
		if(isNaN(password.value[i]))
		{
			if(!special_char_used && check_against_specials(password.value[i]))
			{
				special_char_used = true;
			}
			
			//If no lower used yet, check current char
			else if(!lower_used && password.value[i] == password.value[i].toLowerCase() && !check_against_specials(password.value[i]))
			{
				lower_used = true;
			}
			
			//If no upper used yet, check current char
			else if(!capital_used && password.value[i] == password.value[i].toUpperCase() && !check_against_specials(password.value[i]))
			{
				capital_used = true;
			}
		}
		
		else if(!num_used)
			num_used = true;
	}
	
	//If any character type is not used, set error message
	if(!capital_used || !special_char_used || !lower_used || !num_used)
	{
		//Set error message only if argument is not null
		if(error_msg !== null)
		{
			var error_string = "Please use the following: <ul>";
			
			if(!lower_used)
				error_string += "<li>lower case character</li>";
			if(!capital_used)
				error_string += "<li>capital character</li>";
			if(!num_used)
				error_string += "<li>number</li>";
			if(!special_char_used)
				error_string += "<li>punctuation or symbol</li>";
			
			error_string += "</ul>";
			
			//Set error_msg to error_string
			error_msg.innerHTML = error_string;
		
			return false;	//validation failed
		}
	}
	
	else
	{
		if(error_msg !== null)
			error_msg.innerHTML = "";
		return true;	//validation succeeded
	}
}

//Password validation wrapper
function password_validation(password, len_error, char_error)
{
	//Run functions (and pass return values)
	var valid_len = pass_len_validation(password, len_error);
	var valid_char = pass_char_validation(password, char_error);
	
	//Set colors accordingly
	if(valid_len && valid_char)
	{
		password.style.backgroundColor = 'LawnGreen';
		password.style.color = 'black';
	}
	else
	{
		password.style.backgroundColor = 'red';
		password.style.color = 'white';
	}
}

//Password match (confirmation) validation
function pass_match_validation(password_confirm, password, error_msg)
{
	//If password does not match confirmation
	if(password_confirm.value != password.value)
	{
		password_confirm.style.backgroundColor = 'red';
		password_confirm.style.color = 'white';
		
		//If error message in use, set it
		if(error_msg != null)
		{
			error_msg.innerHTML = "Passwords do not match";
		}
		
		return false;	//validation failed
	}
	
	//If password does match confirmation
	else
	{
		password_confirm.style.backgroundColor = 'LawnGreen';
		password_confirm.style.color = 'black';
	
		//If error message in use, set it
		if(error_msg != null)
		{
			error_msg.innerHTML = "";
		}
		
		return true;	//validation succeeded
	}
}
