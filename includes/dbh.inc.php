<?php

// database handler

function connect_to_db() {
	/* making a connection */
	$servername="localhost";
	$dBUsername="root";
	$dBPassword="";
	$dBName="loginsystemtut";

	$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
	 /* checking if the connection was succesfull */
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
}
