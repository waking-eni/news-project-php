<?php

require_once __DIR__.'/../includes/dbh.inc.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function fetchNews($offset, $total_records_per_page) {
    //pregled svih vesti na prvoj strani sa kratkim opisima
    $conn = $_SESSION['conn'];
    $sql = "SELECT id, title, administrator_id, date_added, short_description, picture FROM news ORDER BY date_added DESC LIMIT $offset, $total_records_per_page ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
        exit();
    }
    else {
        return null;
        exit();
    }
}

function getArticle($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT title, category, administrator_id, date_added, short_description, 
    content, picture, picture_source FROM news 
    WHERE id = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    //if($row = mysqli_fetch_assoc($result)) {
        return mysqli_fetch_assoc($result);
        exit();
    /*}
    else {
        return null;
        exit();
    }*/
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
        return null;
        exit();
    }
}

function getAllCategories() {
    $conn = $_SESSION['conn'];
    $sql = "SELECT DISTINCT category FROM news ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        return $result;
        exit();
    }
    else {
        return null;
        exit();
    }
}

function getNumberOfArticles() {
    $conn = $_SESSION['conn'];
    $sql = "SELECT COUNT(id) as quantity FROM news ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        $result = $row['quantity'];
        return $result;
        exit();
    }
    else {
        return null;
        exit();
    }
}

function getNumberOfCategories() {
    $conn = $_SESSION['conn'];
    $sql = "SELECT COUNT( DISTINCT category ) as quantity FROM news ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    } else {
        mysqli_stmt_execute($stmt);
    }
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)) {
        $result = $row['quantity'];
        return $result;
        exit();
    }
    else {
        return null;
        exit();
    }
}
