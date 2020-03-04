<?php

require_once __DIR__.'/../includes/dbh.inc.php';
session_start();

function getUserId($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT id FROM user WHERE id = ? ;";
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
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    }
}

function getUserUsername($id) {
    $conn = $_SESSION['conn'];
    $sql = "SELECT username FROM user WHERE id = ? ;";
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
        header("Location: ../public/index.php?error=sqlerror");
        exit();
    }
}
