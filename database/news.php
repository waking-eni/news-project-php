<?php

require_once __DIR__.'/../includes/dbh.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function getNewsId($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT id FROM news WHERE id = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

function fetchNews() {
    //pregled svih vesti na prvoj strani sa kratkim opisima
    $conn = $_SESSION['conn'];
    $sql = "SELECT id, title, administrator_id, date_added, short_description FROM news ORDER BY date_added DESC ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        //header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        //mysqli_stmt_bind_param($stmt);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
        exit();
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

function getArticle($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT id, title, category, administrator_id, date_added, short_description, content FROM news WHERE id = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

function getAnotherArticle() {
    $conn = $_SESSION['conn'];
    $sql = "SELECT id, title, category, administrator_id, date_added, short_description, content FROM news WHERE id != ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

function getAuthor($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT name, surname FROM administrator WHERE id = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        $result2 = $row['name']." ".$row['surname'];
        return $result2;
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

Function getNewsByCategory($category) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT id, title, date_added, short_description, administrator_id FROM news WHERE category = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $category);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}

function getAllCategories() {
    $conn = $_SESSION['conn'];
    $sql = "SELECT category FROM news ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        //header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        //mysqli_stmt_bind_param($stmt);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
        exit();
    }
    else {
        //header("Location: ../public/index.php?error=sqlerror");
        return null;
        exit();
    }
}
