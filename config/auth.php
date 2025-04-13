<?php
    session_start();
    include 'conn.php';

    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit();
    }
?>
