<?php


if(isset($_POST["Export"])){
		 session_start();
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
	  $servername = "localhost";
	$username = "root";
	$password = "root";
	$db = "editor";

	try {
   
		$con = mysqli_connect($servername, $username, $password, $db);
	  //echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

      $output = fopen("php://output", "w");  
      fputcsv($output, array('Contest Name', 'Username', 'Program Code', 'Score'));  
      $query = "SELECT * from $_SESSION[contestcode]";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>