<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
echo $_SESSION['username'] . " Działa.";
?>
