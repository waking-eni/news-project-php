<?php
// we are destroying the session, so that if they go back, they won't be logged in again
	session_start();
	session_destroy();
	header("Location: ../public/index.php");
