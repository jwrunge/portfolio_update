<?php

$sname = 'localhost';
$dname = 'jakeSite';
$uname = 'jwrunge';
$pword = 'JwrMcr2010!';

//Connect to database
$con = new PDO("mysql:host=$sname; dbname=$dname", $uname, $pword);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		//Set error checking

/*
GENERIC SQL INTERFACE FUNCTION
*/
function get_data($con, $sql, $columns = null, $parameters = null)
{
	//Alter statement, replacing '!' with column names and '#' with values
	if($columns != null)
	{
		if(!is_array($columns))
		{
			$row['error'] = "Error: column list is not an array.";
			return $row;
		}
		else
		{
			$columnlist = implode(", ", array_keys($columns)); //Get list of keys 
			$sql = preg_replace("/!/", $columnlist, $sql);
			
			$values = str_repeat('?, ', count($columns));
			$sql = preg_replace("/#/", substr($values, 0, -2), $sql);
		}
	}
	
	//Prepare SQL statement
	$stmt = $con->prepare($sql);
	
	$index = 1;
	
	//Bind values
	if(is_array($columns))
	{
		foreach($columns as $key=>$value)
		{
			$stmt->bindParam($index, $columns[$key]);
			$index++;
		}
	}
	else if($columns != null)
	{
		$stmt->bindParam($index, $columns);
		$index++;
	}
			
	//Bind parameters
	if(is_array($parameters))
	{
		foreach($parameters as $value)
		{
			$stmt->bindParam($index, $value);
			$index++;
		}
	}
	else if($parameters != null)
	{
		$stmt->bindParam($index, $parameters);
		$index++;
	}
	
	try { $stmt->execute(); }
	catch(PDOException $e) { $row['error'] = "SQL failed: " . $e->getMessage(); }
	
	while($row[] = $stmt->fetch(PDO::FETCH_ASSOC));	//Iterate over table rows for each match, loading $row with an array of arrays
	
	return $row;
}

?>