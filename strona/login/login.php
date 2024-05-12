<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "projekt";

    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($user_id, $db_email, $db_password);

    if ($stmt->num_rows > 0) {
        while($stmt->fetch()) {
            if (password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $db_email;
                header("Location:../main/welcome.php");
                exit();
            } else {
                $error = "Wrong email or password";
            }
        }
    } else {
        $error = "Wrong email or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Welcome</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <?php 
                if(isset($error)) {?>
                <p class="error"><?php echo $error;?></p>
            <?php }?>
            <button type="submit">login</button>
        </form>
        <p>Don't have an account? <a href="../SignUp/signup.php">Sign up</a></p>
    </div>
</body>
</html>
