<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//did we get here trough comment button
if(isset($_POST['comment'])) {
    require_once __DIR__.'/dbh.inc.php';
    $conn = $_SESSION['conn'];
    $idArticle = $_POST['idArticle'];

    $content = mysqli_real_escape_string($conn, $_POST['comment']);

    //error handling and verifying
    if(empty($content)) {
        header("Location: ../public/readNews.php?error=emptycomment");
        exit();
    }
    else {
        
        //what is the username
        if(isset($_SESSION['userUsername'])) {
            $username = $_SESSION['userUsername'];
        } else if(isset($_SESSION['administratorUsername'])) {
            $username = $_SESSION['administratorUsername'];
        } else {
            $username = "Anonymous";
        }

        //inserting into database
        $sql = "INSERT INTO comments (username, content, news_id) VALUES (?, ?, ?) ;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../public/readNews.php?id=".$idArticle."&error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'sss', $username, $content, $idArticle);
            mysqli_stmt_execute($stmt);
            header("Location: ../public/readNews.php?id=".$idArticle."&comments=success");
			exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

} else {
    header("Location: ../public/readNews.php?id=".$idArticle."&");
	exit();
}
