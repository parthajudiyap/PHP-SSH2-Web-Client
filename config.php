<?php

	// Turn off error reporting
    //error_reporting(1);


	//web API path
	


	//database configration
	$servername = "localhost";
	$database = "ssh";
	$username = "ssh";
	$password = "pwt";

	// Create connection

	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection

	if (!$conn) {

	    die("Connection failed: " . mysqli_connect_error());

	}


?>
