<?php 
	session_start();
	ini_set('display_errors', 'On');
	error_reporting(E_ALL | E_STRICT);
	
	include('modules/connect_to_db.php');
	
	//AUTHENTICATION
	//Ensure user is allowed to view this data
	if($_SESSION['approved'] == false)
	{
		echo "<script>window.location = 'login.php?alert=noaccess';</script>";
		exit();
	}
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width" />

    <title>Select an Image</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
	<link rel="stylesheet" type="text/css" href="style/cms.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/screen_switch.js"></script>
	<script src="js/dropdown.js"></script>
</head>

<body>
	
	<div id='main_content'>
		<div class='entry'>
			
			<h1>Image Store</h1>
			<h3>Select Image</h3>
			<p>Select the image you would like to use.</p>
		
			<?php
				if(isset($_GET['path_ext']))
					$path = urldecode($_GET['path_ext']) . '/';
				else $path = 'media/' . $_SESSION['email'] . '/';
					
				echo "<p>CURRENT DIRECTORY: $path<br/>";
				
					$directories = glob($path . '*', GLOB_ONLYDIR);
					$images = glob($path . '*.{jpg,gif,png}', GLOB_BRACE);
					
					foreach($directories as $directory)
					{
						echo "<a href='image_select.php?path_ext=" . urlencode($directory) ."'>$directory</a><br/>";
					}

				echo "</p>";
				
				echo "<div style='text-align: center;'>";
				
					echo "<div class='thumbnail' data-return='false'>"
						. "<img src='media/core/x.png'/>"
						. "<p class='caption'>REMOVE IMAGE</p>"
					. "</div>";
					
					foreach($images as $image)
					{
						//Check if it's an image
						$test = getimagesize($image);
						$image_type = $test[2];
						
						if(in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP)))
						{
							echo "<div class='thumbnail'>";
							echo "<img src='" .  $image . "'/>";
							$splitstring = explode('/',$image);
							echo "<p class='caption'>" . end($splitstring) . "</p>";
							echo "</div>";
						}
					}
					
				echo "</div>";
			?>
		
		</div>
	</div>
	
	<script>
	
		//hover and click
		$('.thumbnail').on(
		{
			mouseenter: function()
			{
				$(this).children('img').css('opacity', '0.6');
				$(this).css('background-color', 'yellow');
			},
			mouseleave: function()
			{
				$(this).children('img').css('opacity', '');
				$(this).css('background-color', '');
			},
			click: function()
			{
				if(window.opener.source_element != 'header')
				{
					if($(this).attr('data-return') != 'false')
					{
						//cut image name down
						var imagesrc = $(this).find('img').prop('src');
						imagesrc = imagesrc.split('/');
						
						var flag = false;
						var newsrc = '';
						for(var i=0; i<imagesrc.length; i++)
						{
							if(imagesrc[i] == 'media') flag = true;
							if(flag)
							{
								newsrc += imagesrc[i];
								if(i != imagesrc.length-1)
									newsrc += '/';
							}
							
						}
						
						window.opener.source_element.prop('src', newsrc);
					}
					else
						window.opener.source_element.prop('src', "media/core/addImage.png");
				}
				else
				{
					if($(this).attr('data-return') != 'false')
					{
						//cut image name down
						var imagesrc = $(this).find('img').prop('src');
						imagesrc = imagesrc.split('/');
						
						var flag = false;
						var newsrc = '';
						for(var i=0; i<imagesrc.length; i++)
						{
							if(imagesrc[i] == 'media') flag = true;
							if(flag)
							{
								newsrc += imagesrc[i];
								if(i != imagesrc.length-1)
									newsrc += '/';
							}
						}
						
						window.opener.$('#content_screen').css('background-image', 'url(' + newsrc + ')');
					}
					else
						window.opener.$('#content_screen').css('background-image', 'url(media/group.jpg)');
				}
			
				window.close();
			}
		});
	
	</script>
	
</body>
</html>