<?php
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projekt";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone_number = $_POST['phone_number'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (email, password, phone_number, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $email, $password, $phone_number);

        if ($stmt->execute() === TRUE) {
            $user_id = $conn->insert_id;
            $stmt = $conn->prepare("INSERT INTO addresses (user_id, street, city, postal_code, country) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $user_id, $street, $city, $postal_code, $country);
            if ($stmt->execute() === TRUE) {
                header("Location: ../login/login.php");
                exit();
            } else {
                $error = "Error: " . $conn->error;
            }
        } else {
            $error = "Error: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password for confirm" required>
            </div>
            <div class="input-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number (e.g., 123-456-789)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
            </div>
            <div class="input-group">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street" placeholder="Enter your street" required>
            </div>
            <div class="input-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" placeholder="Enter your city" required>
            </div>
            <div class="input-group">
                <label for="postal_code">Postal Code:</label>
                <input type="text" id="postal_code" name="postal_code" placeholder="Enter your postal code (e.g., 12-345)" pattern="[0-9]{2}-[0-9]{3}" required>
            </div>
            <div class="input-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" placeholder="Enter your country" required>
            </div>
            <?php if(!empty($error)) {?>
                <p class="error"><?php echo $error;?></p>
            <?php }?>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="../login/login.php">Log in</a></p>
    </div>
</body>
</html>