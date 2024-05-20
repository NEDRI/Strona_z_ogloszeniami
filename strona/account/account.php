<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="account-container">
        <div class="back-button-container">
            <a href="../main/welcome.php" class="back-button">Back</a>
        </div>
        <h2>My Account</h2>
        <form method="post" action="update_account.php">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" placeholder="Enter your phone number (e.g., 123-456-789)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
            
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter new password" required>

            <input type="submit" value="Update Details">
        </form>

        <h3>My Listings</h3>
        <div class="listings-container">
            <?php
            session_start();
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbdatabase = "projekt";

            $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user_email = $_SESSION['email'];
            $sql = "SELECT listings.id, listings.title, listings.description, listings.price, listings.currency 
                    FROM listings 
                    JOIN users ON listings.user_id = users.id 
                    WHERE users.email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="listing-item">';
                    echo '<p>Title: ' . $row['title'] . '</p>';
                    echo '<p>Description: ' . $row['description'] . '</p>';
                    echo '<p>Price: ' . $row['price'] . ' ' . $row['currency'] . '</p>';
                    echo '<form method="post" action="delete_listing.php" class="delete-form">';
                    echo '<input type="hidden" name="listing_id" value="' . $row['id'] . '">';
                    echo '<input type="submit" value="Delete Listing">';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo "No listings.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
