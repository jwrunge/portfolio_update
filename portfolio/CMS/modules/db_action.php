<?php
	session_start();

	include('connect_to_db.php');
	
	if($_POST['page'] == 'images')
	{
		$pathstr = substr($_POST['directory'], 0, -1);
		$path_parts = explode('/', $pathstr);
		
		$url = '';
		$link_path = '';
		$path = $_POST['directory'];
		
		//Cycle through directory parts, making them links
		for($i=0; $i<count($path_parts); $i++)
		{
			if($path_parts[$i])
			{
				if($i != count($path_parts)-1 && $i != 0)
				{
					$url .= $path_parts[$i] . '/';
					$link_path .= "<a class='dir' data-ref='$url'>" . $path_parts[$i] . "</a>/";
				}
				else
				{
					$link_path .= $path_parts[$i];
					if($i == 0) $link_path .= '/';
				}
			}
		}
				
		echo "<b>Current Directory:</b> $link_path<br/><br/>";
		
		//Get a reference to all subdirectories and all images in current directory
		$directories = glob('../' . $path . '*', GLOB_ONLYDIR);
		$images = glob('../' . $path . '*.{jpg,gif,png}', GLOB_BRACE);
		
		//List all subdirectories
		echo "<b>Subdirectories:</b><ul style='margin-top: 0'>";
			if(count($directories))
			{
				foreach($directories as $directory)
				{
					$dirname = explode('/', $directory);
					echo "<li><a class='dir' data-ref='" . $path . end($dirname) . "/'>" . end($dirname) . "</a></li>";
				}
			}
			else echo "<li>none</li>";
		echo "</ul>";
		
		//Uploaders
		echo "<div>"
		
			. "<div id='upload_box'><form id='fileform' method='POST' enctype='multipart/form-data'><input type='button' id='upload_img' class='shrunk' value='Upload'/><input type='file' id='fileselect' name='images[]' multiple/> one or more files...<br/></form></div>"
			. "Or grab from URL: <input type='text' id='url_pull'/><input type='button' id='url_click' class='shrunk' value='Grab'/>"
		
		. "</div>";
	
		//Show all images
		foreach($images as $image)
		{
			//Check if it's an image
			$test = getimagesize($image);
			$image_type = $test[2];
			
			if(in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)))
			{
				$filename = explode('/',$image);
				$filename = end($filename);
				
				echo "<div class='thumbnail' style='cursor: default'>";
					echo "<div class='controls'>" .
						"<img class='renamer' data-filename='$filename' src='media/core/edit.png'/>" .
						"<img class='mover' data-filename='$filename' src='media/core/move.png'/>" .
						"<img class='deleter' data-filename='$filename' src='media/core/x.png'/>" . 
					"</div>";
					
					//substr because the ../ is evaluated by the file running ajax... which is in a different directory :-)
					echo "<img src='" . substr($image, 3) . "'/>";
					echo "<p class='caption'>$filename</p>";
				echo "</div>";
			}
		}
			
		echo "</div>";
	}
	
	else if($_POST['page'] == 'image_delete')
	{
		unlink('../' . $_POST['file']);	
	}
	
	else if($_POST['page'] == 'image_upload')
	{
		$messages = [];
		
		if(isset($_FILES['images']['name']) && count($_FILES['images']['name']) > 0)
		{
			for($i = 0; $i < count($_FILES['images']['name']); $i++)
			{
				//Ensure there is no error					
				if($_FILES['images']['error'][$i] == UPLOAD_ERR_OK)
				{
					$type = exif_imagetype($_FILES['images']['tmp_name'][$i]);
				
					//Ensure MIME type is correct
					if($type >= 1 && $type <= 3)
					{
						//Ensure files size is appropriate
						if($_FILES['images']['size'][$i] < 700000)
						{
							//Ensure file is not already present
							$images = glob('../' . $_POST['dir'] . '*.{jpg,gif,png}', GLOB_BRACE);
							
							$newfilename = preg_replace("/[^a-zA-Z0-9.-_]/", "", $_FILES["images"]["name"][$i]);
							
							//Get all filenames
							$current_fnames = [];
							foreach($images as $image)
							{
								//Check if it's an image
								$test = getimagesize($image);
								$image_type = $test[2];
								
								if(in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)))
								{
									$filename = explode('/',$image);
									$filename = end($filename);
								}
								
								array_push($current_fnames, $filename);
							}
							
							if(!in_array($newfilename,$current_fnames))
							{
								 if (move_uploaded_file($_FILES["images"]["tmp_name"][$i], '../' . $_POST['dir'] . "/$newfilename"))
								 {
									array_push($messages, "<b>$newfilename</b>: Successfully uploaded.");
								 }
								 else array_push($messages, "<b>" . $_FILES['images']['name'][$i] . "</b>: An unknown error occurred. Aborted.<br/>" . '../' . $_POST['dir'] . "/" . $_FILES["images"]["name"][$i]);
							}
							
							else array_push($messages, "<b>" . $_FILES['images']['name'][$i] . "</b>: A file with that name already exists in this directory. Aborted.");
						}
						else array_push($messages, "<b>" . $_FILES['images']['name'][$i] . "</b>: Upload is too large (max 700KB). Aborted.");
					}
					else array_push($messages, "<b>" . $_FILES['images']['name'][$i] . "</b>: Upload is not a supported image file (JPEG, GIF, or PNG). Aborted.");
				}
				else array_push($messages, "<b>" . $_FILES['images']['name'][$i] . "</b>: There was an unknown error uploading this file. Aborted.");
			}
		}
		else array_push($messages, "No images selected.");
		
		echo "<p class='msg_box'>";
		foreach($messages as $message)
			echo $message . "<br/>";
		echo "</p>";
	}
	
	else if($_POST['page'] == 'get_subdirs')
	{
		$directories = glob('../' . $_POST['curdir'] . '*', GLOB_ONLYDIR);
		
		//List all subdirectories
		echo "<p>Move to: <b><span id='moveto'>" . $_POST['curdir'] . "</span></b></p><div class='msg_box'><ul style='margin-top: 0; text-align: left;'>";
			if($_POST['curdir'] != 'media/' . $_SESSION['email'] . '/')
				echo "<li><a class='subdir backdir'>[up directory]</a></li>";
			if(count($directories))
			{
				foreach($directories as $directory)
				{
					$dirname = explode('/', $directory);
					echo "<li><a class='subdir' data-ref='" . $_POST['curdir'] . end($dirname) . "/'>" . end($dirname) . "</a></li>";
				}
			}
			else echo "<li>none</li>";
		echo "</ul></div>";
	}
	
	else if($_POST['page'] == 'image_rename')
	{
		//Get the file extension
		$parts = explode('.', $_POST['file']);
		$extension = end($parts);
		
		$newfileparts = explode('/', $_POST['newfile']);
		$path = array_pop($newfileparts);
			
		//Check if newname is valid
		if(end($newfileparts) != '')
		{
			$newname = preg_replace("/[^a-zA-Z0-9.-_]/", "", $_POST['newfile']) . ".$extension";
			
			//Ensure file is not already present
			$images = glob('../' . $path . '*.{jpg,gif,png}', GLOB_BRACE);
			
			//Get all filenames
			$current_fnames = [];
			foreach($images as $image)
			{
				//Check if it's an image
				$test = getimagesize($image);
				$image_type = $test[2];
				
				if(in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)))
				{
					$filename = explode('/',$image);
					$filename = end($filename);
				}
				
				array_push($current_fnames, $filename);
			}
			
			if(!in_array($newname,$current_fnames))
			{
				if(rename('../' . $_POST['file'], '../' . $newname))
					echo "<b>" . $_POST['file'] . "</b> renamed to <b>$newname</b>.";
				else
					echo "Error: Filename exists in this directory.";
			}
		}
		else
			echo "Error: No name entered.";
	}
	
	else if($_POST['page'] == 'image_grab')
	{
		//Check if file exists already
		if(file_exists('../' . $_POST['directory'] . $_POST['filename'] . "." . $_POST['extension']))
		{
			echo "The file cannot be added: a file with that name already exists in " . $_POST['directory'];
		}
		else //If filename is new...
		{
			//Get file headers
			$data = get_headers($_POST['file'], true);
			
			//Check file size
			if(isset($data['Content-Length']))
			{
				if($data['Content-Length'] < 700000)
				{
					//Check file type
					if($data['Content-Type'] == 'image/jpeg' || $data['Content-Type'] == 'image/gif' || $data['Content-Type'] == 'image/png')
					{
						copy($_POST['file'], '../' . $_POST['directory'] . $_POST['filename'] . "." . $_POST['extension']);
			
						echo $_POST['filename'] . "." . $_POST['extension'] . " added to " . $_POST['directory'];
					}
					else //If not an appropriate type
					{
						echo "The file is not of a recognizable type, or may not exist at the location specified. Be sure this image exists, and that it is a JPEG, GIF, or PNG.";
					}
				}
				else //If the image is too big
					echo "The file is too large to load optimally on the web (max 700KB). Please download and shrink the file size.";
			}
			
			else //If the file headers cannot be found
				echo "The file's headers were not returned. Double check the URL for accuracy.";
		}
	}
	
	else //For all other content screens
	{
		//Delete everything
		alter_data($con, "DELETE FROM headers WHERE page=? AND user=?", [$_POST['page'], $_POST['user']]);
		alter_data($con, "DELETE FROM content WHERE page=? AND user=?", [$_POST['page'], $_POST['user']]);
		
		//Insert new information
		insert_data($con, "INSERT INTO headers (page, user, value, image_path, orientation) VALUES (?, ?, ?, ?, ?)", null, [$_POST['page'], $_POST['user'], $_POST['data']['header_value'], $_POST['data']['header_image'], $_POST['data']['header_orientation']]);
		
		if($_POST['data']['content'])
			$data = insert_data($con, "INSERT INTO content (!) VALUES (#)", $_POST['data']['content']);
			
		if(is_numeric($data))
		{
			if($data > 0)
				echo "Content changes successful!";
			else echo "An unknown error occurred: no changes were made.";
		}
		else
			echo $data;
	}
?>