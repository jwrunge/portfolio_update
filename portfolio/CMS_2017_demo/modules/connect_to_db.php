<?php

	$sname = 'localhost';
	$dname = 'jwrunge_cms';
	$uname = 'jwrunge_jwrunge';
	$pword = 'A7hfybPh_b9q';

	//Connect to database
	$con = new PDO("mysql:host=$sname; dbname=$dname", $uname, $pword);
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		//Set error checking
	
	if(!function_exists('hash_equals'))
	{
		function hash_equals($str1, $str2)
		{
			if(strlen($str1) != strlen($str2))
			{
				return false;
			}
			else
			{
				$res = $str1 ^ $str2;
				$ret = 0;
				for($i = strlen($res) - 1; $i >= 0; $i--)
				{
					$ret |= ord($res[$i]);
				}
				return !$ret;
			}
		}
	}
	
/*
	GENERIC SQL INTERFACE FUNCTIONS
*/
	//Replace characters with column keys and values and return new SQL statement
	function sql_alter_statement($sql, $columns)
	{
		//Alter statement, replacing '!' with column names and '#' with values
		if($columns != null) {	
		
			//Get keys
			if(is_array($columns) && is_array(reset($columns)))	//If $columns is an array of arrays (for example, when INSERTing multiple rows at a time) -- reset($columns) gets first element in $columns
			{
				//If container array is associative
				if(count(array_filter(array_keys($columns), 'is_string')) > 0)
				{
					$columnlist = implode(", ", array_keys($columns)); //Get list of keys 
					$sql = preg_replace("/!/", $columnlist, $sql);
				}
				else //If it's numeric
				{
					$columnlist = implode(", ", array_keys(reset($columns))); //Get list of keys 
					$sql = preg_replace("/!/", $columnlist, $sql);
				}
			}
			else //Otherwise, don't worry about subarrays
			{
				$columnlist = implode(", ", array_keys($columns)); //Get list of keys 
				$sql = preg_replace("/!/", $columnlist, $sql);
			}
			
			//Get values
			if(is_array($columns) && is_array(reset($columns)))	//If $columns is an array of arrays (for example, when INSERTing multiple rows at a time)
			{
				/* Now we need to differentiate between two possible array formats:
					Array[ 1=> [ val1=> val, val2 => val ... ] ] OR
					Array[ val1 => [ val, val, val ...
				*/
				$values = '';
				
				//If container array is associative
				if(count(array_filter(array_keys($columns), 'is_string')) > 0)
				{
					foreach(reset($columns) as $column)
					{
						$values .= substr(str_repeat('?, ', count($columns)), 0, -2) . '), (';
					}
					$sql = preg_replace("/#/", substr($values, 0, -4), $sql);
				}
				else //If it's numeric
				{
					foreach($columns as $column)
					{
						$values .= substr(str_repeat('?, ', count(reset($columns))), 0, -2) . '), (';
					}
					$sql = preg_replace("/#/", substr($values, 0, -4), $sql);
				}
			}
			else //Otherwise, no looping necessary
			{
				$values = str_repeat('?, ', count($columns));
				$sql = preg_replace("/#/", substr($values, 0, -2), $sql);
			}
		}
		
		/*
			NOTE: This can be used without associative keys (like for SELECT or DELETE statements); associative keys are more for complex INSERT statements. Just use # and not !.
		*/
		return $sql;
	}
	
	//Bind values to ? in a statement, starting at $index; $to_bind can be an array of values; returns $index
	function sql_bind_array(&$stmt, $to_bind, $index = 1)
	{
		//If $to_bind is an array of arrays
		if(is_array($to_bind) && is_array(reset($to_bind))) {
		
			//If container array is associative
			if(count(array_filter(array_keys($to_bind), 'is_string')) > 0)
			{
				foreach($to_bind as $key) {
					foreach($key as $number=>$value)
					{
						$new_index = $index + ($number * (count($to_bind)));

						//Bind parameters, skipping ahead where necessary
						$stmt->bindValue($new_index, $value);
					}
				$index++;
				}
			}
						
			else //If it's numeric
			{
				foreach($to_bind as $array) {
					foreach($array as $key=>$value) {
						$stmt->bindValue($index, $array[$key]);
						$index++;
					}
				}
			}
		}
		//If it is just a simple array
		else if(is_array($to_bind)) {
			foreach($to_bind as $key=>$value) {
				$stmt->bindValue($index, $to_bind[$key]);
				$index++;
			}
		}
		//If it is just a single value
		else if($to_bind != null) {
			$stmt->bindValue($index, $to_bind);
			$index++;
		}
		
		return $index;
	}
	
	//Generic get_data function -- to be used with SELECT queries
	function get_data($con, $sql, $columns = null, $parameters = null)
	{
		//Alter statement, replacing '!' with column names and '#' with values
		$sql = sql_alter_statement($sql, $columns);
		
		//Prepare SQL statement
		$stmt = $con->prepare($sql);
		
		//Bind values
		$index = sql_bind_array($stmt, $columns);
		sql_bind_array($stmt, $parameters, $index);
		
		try { $stmt->execute(); }
		catch(PDOException $e) { $row['error'] = "SQL failed: " . $e->getMessage(); }
		
		//Return data in array
		while($row[] = $stmt->fetch(PDO::FETCH_ASSOC));	//Iterate over table rows for each match, loading $row with an array of arrays
		
		if(isset($row['error']))
			return $row['error'];	//Return only error if error is set
		else
			return $row;
	}
	
	//Generic alter_data function -- to be used with DELETE, ALTER queries
	function alter_data($con, $sql, $parameters = null)
	{
		//Prepare SQL statement
		$stmt = $con->prepare($sql);
		
		//Bind values
		sql_bind_array($stmt, $parameters);
		
		try { $stmt->execute(); }
		catch(PDOException $e) { $row['error'] = "SQL failed: " . $e->getMessage(); }
		
		//Return success or failure
		return $stmt->rowCount();
	}
	
	//Generic insert_data function -- to be used with INSERT queries
	function insert_data($con, $sql, $columns = null, $parameters = null)
	{
		//Alter statement, replacing '!' with column names and '#' with values
		$sql = sql_alter_statement($sql, $columns);
				
		//Prepare SQL statement
		$stmt = $con->prepare($sql);
		
		//Bind values
		$index = sql_bind_array($stmt, $columns);
		sql_bind_array($stmt, $parameters, $index);
		
		$error = null;
		try { $stmt->execute(); }
		catch(PDOException $e) { $error = "SQL failed: " . $e->getMessage(); }
		
		//Return success or failure
		if($error)
			return $error;
		else
			return $stmt->rowCount();
	}
	
/*
	PAGE CONTENT MANAGEMENT
*/
	//Populate link lists with links; $display indicates whether or not to display the links or just to return the values
	function get_links($category, $con, $display = true)
	{
		//Populate links based on link category
		$links = get_data($con, "SELECT value, href FROM links WHERE category = '" . $category . "'");
				
		if($display)
		{
			foreach($links as $link)
				echo "<a href='" . $link['href'] . "'>" . $link['value'] . "</a>";
		}
		else //if not displaying
		{
			return $links;
		}
	}
	
	//Place content - $editing says to place editable content if true
	function place_content($page, $user, $con, $editing = false)
	{
		//Get content data
		$header = get_data($con, "SELECT value, image_path, orientation FROM headers WHERE page = ? AND user = ? LIMIT 1", null, [$page, $user]);
		$content = get_data($con, "SELECT id, image_path, html_content FROM content WHERE page = ? AND user = ?", null, [$page, $user]);
				
		//Add metadata that JS can reference
		echo "<input id='page_reference' type='hidden' value='" . $page . "'/>";
		
		array_pop($content);
	
		//Place header
		if(isset($header[0]['image_path']) && isset($header[0]['orientation']))
			echo "<div id='content_screen' style='background-image: " . $header[0]['image_path'] . "; background-position: " . $header[0]['orientation'] . ";'>";
		else
			echo "<div id='content_screen'>";
		
			//Display image change and alignment controls if editing
			echo "<div id='content_pos'>";
				if($editing)
				{
					//The controls
					echo 	"<div style='background-color: rgba(255,255,255,.9);'>
								<a href='' id='header_img' class='add_image'>Change header image</a><br/>
								align: <a href='' class='a_top'>top</a> | <a href='' class='a_mid'>middle</a> | <a href='' class='a_bot'>bottom</a>
							</div>";
							
					//Place editable heading inside header div
					if(isset($header[0]['value']))
						echo "<input type='text' class='editable' id='title' name='title' value='" . $header[0]['value'] . "'/>";
					else
						echo "<input type='text' class='editable' id='title' name='title' value='No Header'/>";
				}
				
				else	//if not editing
				{
					//Place heading inside header div
					if(isset($header[0]['value']))
						echo "<h1>" . $header[0]['value'] . "</h1>";
					else
						echo "<h1>No Header</h1>";
				}
					
			echo "</div>";
		echo "</div>";
		
		//Place all content
		echo "<div class='entry'>";
		
			if($editing)
			{
				//Place view, add, and save button
				echo "<div class='floating_box'>" . 
					"<a class='viewer' href='" . $page . "'><input type='button' class='floating' value='View page'/></a>" . 
					"<input type='button' class='floating adder' value='Add'/>" .
					"<input type='submit' class='floating submitter' value='Save'/>" .
				"</div>";
			}
			
			else //If not editing
			{
				//Place edit page link if relevant
				if(isset($_SESSION['approved']) && $_SESSION['approved'] != false)
					echo "<div class='floating_box'>" .
						"<a href='" . $page . "&edit=yes'><input type='button' class='floating' value='Edit page'/></a>" .
					"</div>";
			}
					
			//Cycle through all content and display
			$img_display = 'float_right'; //Initial image display float; alternates
			foreach($content as $block)
			{						
				//Control panel
				if($editing)
				{
					echo "<div class='editing_block' data-id='" . $block['id'] . "' style='clear: both; margin-bottom: 1em;'>";
					
						echo "<div class='image_control'>";
							
							//Block controls
							echo "<div class='block_controls'>" .
								"<input type='button' class='up' value='&uarr;'/>" .
								"<input type='button' class='down' value='&darr;'/>" .
								"<input type='button' class='delete' value='x'/>" .
							"</div>";
						
							//Image
							if(isset($block['image_path']) && $block['image_path'] != "")
								echo "<img class='add_image' src='" . $block['image_path'] . "'/>";
							else
								echo "<img class='add_image' src='media/core/addImage.png'/>";
							
						echo "</div>";
						
						echo "<div class='panel_control'><textarea class='editable' id='" . $block['id'] . "_content'>" . $block['html_content'] . "</textarea></div>";
						
						echo "<div class='delete_marker'>Queued for deletion<br/>-<a class='undo_delete'>undo</a></div>";
					
					echo "</div>";
				}
				
				else
				{					
					echo "<div style='clear: both; margin-bottom: 1em;'>";
					
						//Image (no edit)
						if($block['image_path'] != "")
						{
							echo "<img src='" . $block['image_path'] . "' class='$img_display' />";
							
							//Alternate the display value
							if($img_display == 'float_right') $img_display = 'float_left';
							else $img_display = 'float_right';
						}
						
						if($block['html_content'] != "")
							echo "<p>" . $block['html_content'] . "</p>";
			
					echo "</div>";
				}
			}
			
		echo "</div>";
	}
	
	//Add user
	function add_user($email, $firstname, $lastname, $password, $con)
	{
		//Populate links based on page
		$sql = "INSERT INTO users (email, password, firstname, lastname, approved, timestamp) VALUES (:email, :password, :firstname, :lastname, :approved, NOW())";
				
		/*
			HASHING AND SALTING
		*/
		$cost = 10; //Slows down hashing
		
		//Random salt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_RANDOM)), '+', '.');
		
		// Prefix information about the hash so PHP knows how to verify it later.
		// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		
		$hash=crypt($password, $salt);	//hash the password and salt
				
		$approved = false;
		
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $hash);
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':approved', $approved);
		
		try
		{
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			return false;
		}
		
		return true;
	}
	
	//Remove user
	function remove_user($email, $con)
	{
		//Remove user permissions
		$sql = "DELETE FROM permissions WHERE username = :email";
				
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email', $email);
		
		try
		{
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			return false;
		}
		
		//Remove user
		$sql = "DELETE FROM users WHERE email = :email";
				
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email', $email);
		
		try
		{
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			return false;
		}
		
		return true;
	}
	
	//Check for username
	function check_for_user($email, $con)
	{
		//Populate links based on page
		$sql = "SELECT * FROM users WHERE email = :email";
				
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':email', $email);
		
		try
		{
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			return false;
		}
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);	//Load row with table data array
		
		return $row;
	}
	
	//Alter approval for user
	function approve_user($email, $approval, $con)
	{
		$sql = "UPDATE users SET approved = :approval WHERE email = :email";
		
		$stmt = $con->prepare($sql);
		$stmt->bindParam(':approval', $approval);
		$stmt->bindParam(':email', $email);
		
		try
		{
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			return false;
		}
		
		return true;
	}