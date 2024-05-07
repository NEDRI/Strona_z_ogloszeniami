<?php
session_start();

if(isset($_SESSION['email'])) {
    header("Location: main/welcome.php");
    exit;
} else {
    header("Location: login/login.php");
    exit;
}
?>
