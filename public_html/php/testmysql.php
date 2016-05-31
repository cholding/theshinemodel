<?php
 
$link = mysqli_connect("localhost", "cl57-shine", "Lang@t@266", "cl57-shine");
	 	
if (mysqli_connect_error()) {
 
	 	 die("Could not connect to database");
 
}
	 	
$query = "SELECT * FROM members WHERE `username`='NMilian'";
	 	
if ($result=mysqli_query($link, $query)) {
 
	 	 while ($row = mysqli_fetch_array($result)) {
			
			 print_r($row);
	 	 }
			
 
} else { 
	 	 echo "It failed";
}
	 	
	 	
 
 ?>