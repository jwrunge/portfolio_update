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

    <title>Manage Images</title>
	
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/coreStyle.css"/>
	<link rel="stylesheet" type="text/css" href="style/cms.css"/>
	<link rel="stylesheet" type="text/css" href="style/forms.css"/>
		
	<script src="js/jquery-min.js"></script>
	<script src="js/dropdown.js"></script>
</head>

<body>
	<input id='username' type='hidden' value='<?php echo $_SESSION['email']; ?>'/>

	<?php include('modules/navigation.php') ?>
	<div id='main_content'>

		<div id='content_screen'>
			<div id='content_pos'>
				<h1>Image Store</h1>
			</div>
		</div>
		
		<div class='entry'>
		
			<h3>Manage Images</h3>
			<p>Note that all actions performed on images here affect the rest of the website. Deleting images in use will cause some pages not to display as intended.</p>
			
			<div id='directory'></div>
		
		</div> <!--End '.entry'-->
		
		<?php include('modules/footer.php') ?>
		
	</div> <!--End '#main_content'-->
	
</body>

<script src='js/site_alert.js'></script>
<script>
	var current_command = null;
	var cancel_command = null;
	var operate_on = null;
	var curdir = 'media/' + $('#username').val() + '/';
	
	//Get a list of directories
	

	//Reload directory display
	function reload_directory(dir)
	{
		$.ajax({
			url: 'modules/db_action.php',
			type: 'POST',
			dataType: 'html',
			data: {page: 'images', directory: dir},
			beforeSend: function()
			{
				$('#directory').html("<div style='margin: 1em auto; text-align: center'><img src='media/core/loader.svg'/></div>");
			},
			error: function(){
				$('#directory').html("<div style='margin: 1em auto; text-align: center'>Error loading resources.</div>");	//Error msg
			},
			success: function(response){
				//On success, get html response
				$('#directory').html(response);
				binders();
			},
			cache: 'false'
		});
	}

	function binders() {
		//Upload button
		$('#upload_img').on('click', function()
		{
			$('#fileselect').click();
		});
	
		//Grab from url
		$('#url_click').on('click', function()
		{
			var filepath = $('#url_pull').val();
			var filename = filepath.split('/');
			filename = filename[filename.length - 1];
			
			var file_extension = filename.split('.');
			file_extension = file_extension[file_extension.length - 1];

			current_command = function() {
				
				$.ajax({
					url: 'modules/db_action.php',
					type: 'POST',
					dataType: 'html',
					data: {page: 'image_grab', file: filepath, filename: $('#file_rename').val(), directory: curdir, extension: file_extension},
					error: function(){
						siteAlert('Unknown Error: Could not upload image.');
					},
					success: function(response){
						//On success, get html response
						siteAlert(response);
						reload_directory(curdir);
					},
					cache: 'false'
				});
			};
			
			siteAlert("Name the file: <input type='text' id='file_rename'/>");
		});
		
		//On form submit
		$('#fileform').on('submit', function(e) {
			e.preventDefault();
			e.stopPropagation();
			
			var fileselect = document.getElementById('fileselect');
			var files = fileselect.files;
			
			var formData = new FormData();
			formData.append('page', 'image_upload');
			formData.append('dir', curdir);
			
			for(var i=0; i<files.length; i++)
			{
				var file = files[i];
				
				formData.append('images[]', file, file.name);
			}
			
			$.ajax({
				url: 'modules/db_action.php',
				type: 'POST',
				dataType: 'html',
				data: formData,
				error: function(){
					siteAlert('Unknown Error: Could not upload image.');
				},
				beforeSend: function()
				{
					$('#upload_box').html("<div style='margin: 1em auto;'><img style='width: 2em; display: block;' src='media/core/loader.svg'/>Uploading your files. You may continue working.</div>");
				},
				success: function(response){
					//On success, get html response
					siteAlert(response);
					reload_directory(curdir);
				},
				cache: 'false',
				processData: false,
				contentType: false
			});
		});
		
		//On file addition
		$('#fileselect').on('change', function()
		{
			$('#fileform').submit();
		});
	
		//Change directories
		$('.dir').on('click', function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			
			reload_directory($(this).attr('data-ref'));
			curdir = $(this).attr('data-ref');
			history.pushState(curdir, null, null);
			$('#page').val(curdir);
		});
		
		//Delete an image
		$('.deleter').on('click', function()
		{
			operate_on = curdir + $(this).attr('data-filename');

			current_command = function() {
				
				$.ajax({
					url: 'modules/db_action.php',
					type: 'POST',
					dataType: 'html',
					data: {page: 'image_delete', file: operate_on},
					error: function(){
						siteAlert('Error: Could not delete the image.');
					},
					success: function(){
						//On success, get html response
						reload_directory(curdir);
						siteAlert(operate_on + " was deleted.");
					},
					cache: 'false'
				});
			};
			
			siteAlert('Are you sure you want to delete this image? Deletion is permanent, and will affect how the image is used site-wide.');
		});
		
		//Rename file
		$('.renamer').on('click', function()
		{
			operate_on = $(this).attr('data-filename');

			current_command = function() {
				
				$.ajax({
					url: 'modules/db_action.php',
					type: 'POST',
					dataType: 'html',
					data: {page: 'image_rename', file: curdir + operate_on, newfile: curdir + $('#file_rename').val()},
					error: function(){
						siteAlert('Error: Could not rename the image.');
					},
					success: function(response){
						//On success, get html response
						siteAlert(response);
						reload_directory(curdir);
					},
					cache: 'false'
				});
			};
			
			siteAlert("Rename the file: <input type='text' id='file_rename'/>");
		});
		
		//Move file
		$('.mover, a.subdir').on('click', function()
		{
			if($(this).hasClass('mover'))
				operate_on = $(this).attr('data-filename');
			
			var directory = '';
			if($('#moveto').text() != '' && $(this).hasClass('subdir'))
			{
				if($(this).hasClass('backdir'))
				{
					var dirparts = $('#moveto').text().split('/');
					if(dirparts[dirparts.length-1] == '')
						dirparts.pop();
						
					dirparts.pop();
						
					directory = dirparts.join('/') + '/';
				}
				else
					directory = $('#moveto').text() + $(this).text() + '/';
			}
			else directory = curdir;
			
			$.ajax({
				url: 'modules/db_action.php',
				type: 'POST',
				dataType: 'html',
				data: {page: 'get_subdirs', curdir: directory},
				error: function(){
					siteAlert('Error: Could not move the image.');
				},
				success: function(response){
					//On success, allow user to commit the move
					current_command = function() {
					
						//remove file extension (it will be added on during file rename)
						var oparray = operate_on.split('.');
						oparray.pop();
						var sansextension = oparray.join('.');
					
						$.ajax({
							url: 'modules/db_action.php',
							type: 'POST',
							dataType: 'html',
							data: {page: 'image_rename', file: curdir + operate_on, newfile: directory + sansextension},
							error: function(){
								siteAlert('Error: Could not rename the image.');
							},
							success: function(response){
								//On success, get html response
								siteAlert(response);
								reload_directory(curdir);
							},
							cache: 'false'
						});
					}
					
					siteAlert(response);
					binders();
				},
				cache: 'false'
			});
		});
	}

	window.addEventListener('popstate', function(e)
	{
		if(e.state)
			reload_directory(e.state);
	});
	
	history.replaceState(curdir, null, null);
	reload_directory('media/' + $('#username').val() + '/');
	
</script>

</html>