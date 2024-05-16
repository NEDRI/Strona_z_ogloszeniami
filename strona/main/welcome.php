<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <header class="header">
        <div class="header-left">
            <a href="webinfo/webinformation.html">More Information</a>
        </div>
        <div class="header-center">
            <img src="logo.png" alt="Logo" class="logo">
        </div>
        <div class="header-right">
            <a href="../account/account.php">My Account</a>
        </div>
    </header>

    <div class="welcome-container">
        <div class="top-panel">
            <div class="button-container">
                <div class="logout-container">
                    <form action="logout.php" method="post">
                        <input class="logout-btn" type="submit" value="logout">
                    </form>
                </div>
                <div class="add-container">
                    <a href="../add/add.php" class="add-btn">Add</a>
                </div>
            </div>
            <h2>Welcome, <?php session_start(); echo $_SESSION['email']; ?>!</h2>
        </div>    
        <h3>Advertisements:</h3>
        <div class="grid-container">
            <?php
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbdatabase = "projekt";

            $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT listings.*, users.email, images.url AS image_url 
                    FROM listings 
                    LEFT JOIN users ON listings.user_id = users.id
                    LEFT JOIN images ON listings.id = images.listing_id
                    GROUP BY listings.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="grid-item">';
                    if ($row['image_url']) {
                        echo '<a href="mailto:' . $row['email'] . '">';
                        echo '<img class="grid-img" src="../uploads/' . $row['image_url'] . '" alt="Advertisement photo">';
                        echo '</a>';
                    } else {
                        echo '<p>Image not found</p>';
                    }
                    echo '<p>Title: ' . $row['title'] . '</p>';
                    echo '<p>Description: ' . $row['description'] . '</p>';
                    echo '<p>Price: ' . $row['price'] . ' ' . $row['currency'] . '</p>';
                    if ($row['description_until'] != NULL) {
                        echo '<p>Until: ' . $row['description_until'] . '</p>';
                    }
                    echo '</div>';
                }
            } else {
                echo "No advertisements found";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
