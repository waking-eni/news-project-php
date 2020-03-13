<?php

require_once __DIR__.'/../includes/dbh.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function fetchComments($newsId) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT username, content FROM comments WHERE news_id = $newsId ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
    }
    else {
        return null;
        exit();
    }
}
