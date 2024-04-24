<?php
session_start();

if(isset($_SESSION['username'])) {
    header("Location: main/welcome.php");
    exit;
} else {
    header("Location: login/login1.html");
    exit;
}
?>
