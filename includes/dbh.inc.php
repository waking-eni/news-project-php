<?php

$servername="localhost";
$dBUsername="root";
$dBPassword="";
$dBName="newsweb";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName, "3308");
	/* checking if the connection was succesfull */
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}

session_start();
$_SESSION['conn'] = $conn;
