<?php

/*first we check if the user had clicked the submit button
button in signup.php in the form that is referencing this page is called signup-submit
if the user had clicked on the submit button, then we can try to make a connection to the database*/
if(isset($_POST['signup-submit'])) {
	require 'dbh.inc.php';
	
	/* fetch information from the form 
	name of input field in signup.php is called uid, etc*/
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	
	/* basic error handlers */
	
	/* did the user leave one of the fields empty*/
	If(empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ) {
		/* if any are empty, we send the user back to the sign up page and write the message in URL (like a location),
		but we fill in the fields he filled previously, again
		they should always repeat the password, because we don't ever want the pass to be seen in the url*/
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
		exit();
	}
	/*this check needs to be done f=before the next two
	we're checking if both email and username are invalid*/
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invalidmailuid");
		exit();
	}
	/* check for invalid email */
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../signup.php?error=invalidmail&uid=".$username);
		exit();
	}
	/* check for invalid username */
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: ../signup.php?error=invaliduid&mail=".$email);
		exit();
	}
	/* are the two password fields matching */
	else if($password !== $passwordRepeat) {
		header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
		exit();
	}
	/* does the chosen username already exist*/
	else {
		
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		/* did our mysqli statement fail */
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../signup.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			/* execute sends to the database */
			mysqli_stmt_execute($stmt);
			/* now we check of there is a user with the same username */
			/* store result is used for fetching from the database */
			mysqli_stmt_store_result($stmt);
			/* how many users did we get from the database? it should be either zero or one */
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if($resultCheck > 0) {
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				exit();
			}
			else {
				/* ubacujemo podatke o novom useru u bazu 
				? is a placeholder, which is a safer way of dealing with data*/
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../signup.php?error=sqlerror");
					exit();
				}
				else {
					
					/*before we send the data to the database, we need to hash the password;
					later, when someone is just logging in, we will dehash it to check if it is valid;
					we are using bcrypt to hash the password, because it's constantly being updated*/
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
					
					/* in our current sql statement we have 3 placeholders, so we need 3 variables*/
					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
					mysqli_stmt_execute($stmt);
					/* the user has now succesfully signed up */
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
		
	}
	
	/* we want to close the statement we created */
	mysqli_stmt_close($stmt);
	/* close the connection */
	mysqli_close($conn);
	
}
/* if the user gained acces to this page without clicking the sign up button*/
else {
	header("Location: ../signup.php");
	exit();
}
