<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//checking SHA-256 password
function checkPassword($password, $db_password)
{
    $hashed = hash('sha256',$password);
    return ($hashed == $db_password) ? true : false;
}

if(isset($_POST['login-submit'])) {
    require_once __DIR__.'/dbh.inc.php';
    $conn = $_SESSION['conn'];
	
	$mailuid = mysqli_real_escape_string($conn, $_POST['mailuid']);
	$password = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	If(empty($mailuid) || empty($password))  {
		header("Location: ../public/loginadministrator.php?error=emptyfields&mailuid=".$mailuid."&mail=".$email);
		exit();
	}
	else {
		$sql = "SELECT * FROM administrator WHERE username=? OR email=? ;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../public/loginadministrator.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			//we have raw db data in result
			$result = mysqli_stmt_get_result($stmt);
			//check if there are any results
			//also using assoc to put it in associative array because we can then do something with it
			if($row = mysqli_fetch_assoc($result)) {
				/*grab the password from the user if we have a user with this username/email
				then take that password from the db, and hash the password the user tried to log in with
				and see if the two match*/
				/*I used SHA-256 for password encryption in MySQL for administrators*/ 
				$pwdCheck = checkPassword($password, $row['password']);

				if($pwdCheck == false) {
					header("Location: ../public/loginadministrator.php?error=wrongpwd");
					exit();
				}
				else if($pwdCheck == true) {
					/*to log in a user we need to start a session,because for log in system to work we create a global variable
					that has information of the user when he's logged in, and then inside the website we check is the global variable available*/
					$_SESSION['administratorId'] = $row['id'];
					$_SESSION['administratorUsername'] = $row['username'];
					
					header("Location: ../public/index.php?login=succes");
					exit();
				}
				//in case something went wrong
				else {
					header("Location: ../public/loginadministrator.php?error=wrongpwd");
					exit();
				}
			}
			else {
				header("Location: ../public/loginadministrator.php?error=nouser");
				exit();
			}
		}
	}
	
}
else {
	header("Location: ../public/loginadministrator.php");
	exit();
}
