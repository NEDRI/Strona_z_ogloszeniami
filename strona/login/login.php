<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === 'admin' && $password === 'admin123') {
        $_SESSION['email'] = $email;
        header("Location:../main/welcome.php");
        exit();
    } else {
        $error = "Wrong email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Welcome</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php if(isset($error)) {?>
                <p class="error"><?php echo $error;?></p>
            <?php }?>
            <button type="submit">login</button>
        </form>
        <p>Don't have an account? <a href="../SignUp/signup.php">Sign up</a></p>
    </div>
</body>
</html>