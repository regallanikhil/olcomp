<?php
function sqlConnection(){
        $servername = "localhost";
		
    	 $username = "root";
		
		 $password = "root";
        
         $dbName= "editor";
    
        
	
		$connection = mysqli_connect($servername, $username, $password,$dbName)or die("Unable to connect.");
    
        

  
	return $connection;
     
}


?>