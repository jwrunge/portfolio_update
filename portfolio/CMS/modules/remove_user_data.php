<?php

	if(isset($_GET['code']) && $_GET['code'] == '77658572')
	{
		include('connect_to_db.php');

		//Remove all user data
		alter_data($con, "DELETE FROM content;");
		alter_data($con, "DELETE FROM headers;");
		alter_data($con, "DELETE FROM users;");
		
		
		//Recursive removal
		function remove_directory($dir)
		{
			$it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
			$files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
						 
			foreach($files as $file)
			{
				if ($file->isDir())
				{
					rmdir($file->getRealPath());
				}
				else
				{
					unlink($file->getRealPath());
				}
			}
			
			rmdir($dir);
		}
		
		
		//Remove subdirectories
		$directories = glob('../media/*', GLOB_ONLYDIR);
		
		foreach($directories as $directory)
		{
			if($directory != '../media/core')
				remove_directory($directory);
		}
	}
	else echo "You are not authorized to access this page.";
?>