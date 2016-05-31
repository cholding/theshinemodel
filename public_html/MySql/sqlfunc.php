<?php
 function getnamefromemail($email){
	include("dbconnect.php");
	 	

	$query = "SELECT * FROM contacts WHERE email ='".$email."'";
	 	
	if ($result=mysqli_query($link, $query)) {
 
	 	 while ($row = mysqli_fetch_array($result)) {
			
			 return $row;
	 	 }
			
 
	} else { 
	 	 echo "It failed";
	}	
	// Free result set
	//mysqli_free_result($result);	

	//mysqli_close($link);		
}	 	

 ?>