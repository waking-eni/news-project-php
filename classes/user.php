<?php
include_once '../includes/dbh.inc.php';

class User {
	
	function getUserId($id) {
		$sql = "SELECT id FROM user WHERE id = ? ;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$finalResul += $row['id'];
			}
		}
		
		return $finalResult;
	}
	
	function getUserUsername($id) {
		$sql = "SELECT username FROM user WHERE id = ? ;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$finalResul += $row['username'];
			}
		}
		
		return $finalResult;
	}
	
}

?>
