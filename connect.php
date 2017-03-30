<?php	
	//conection: 
	$link = mysqli_connect("127.0.0.1:3306","root","","latiumshop") or die("Error " . mysqli_error($link));
	
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>