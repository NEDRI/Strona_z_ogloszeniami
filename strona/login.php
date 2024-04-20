<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION["id"] = session_id();
        header("Location: main/welcome.php");
        exit();
    } else {
        echo "Wrong username or password";
    }
}
?>
