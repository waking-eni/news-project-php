<?php

// database handler


/* making a connection */
$servername="localhost";
$dBUsername="root";
$dBPassword="";
$dBName="news-assignment";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
	/* checking if the connection was succesfull */
	if(!$conn) {
	die("Connection failed: ".mysqli_connect_error());
}
