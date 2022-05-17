<?php


$servername = "localhost";
$username = "root";
$dbname = "oliyaya_couture";



// when connection is called the three parameters are called

$con = mysqli_connect($servername,$username,'');



	if (!$con) 
	{
		
     # die("Connection failed: " . mysqli_connect_error());
		 	
    }
	else
	{
		//echo "<br>Connected successfully<br>";
	}	
		
$cid = 6;
$date = date('2021-10-29');

	$selectDB = mysqli_select_db($con,$dbname);
	

		if (!$selectDB) 
		{

		  $sql = "CREATE DATABASE ".$dbname."";
		
		   mysqli_query($con, $sql); 
		
		
		   //echo "<br>Database ".$dbname." succesfully created<br>";

		} 
		else 
		{
			
		  // echo "<br>Database ".$dbname." already exsist<br>";
	    }
		
$conn = mysqli_connect($servername,'root','',$dbname);

?>