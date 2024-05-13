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
    <div class="welcome-container">
        <div class="top-panel">
            <div class="button-container">
                <div class="logout-container">
                    <form action="logout.php" method="post">
                        <input class="logout-btn" type="submit" value="logout">
                    </form>
                </div>
                <div class="add-container">
                    <form action="../add/add.php">
                        <input class="add-btn" type="submit" value="add">
                    </form>
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

            $sql = "SELECT * FROM listings";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="grid-item">';
                    $imagePath = "add/uploads/" . $row['image'];
                    if (file_exists($imagePath)) {
                        echo '<img class="grid-img" src="' . $imagePath . '" alt="Advertisement photo">';
                    } else {
                        echo '<p>Image not found</p>';
                    }
                    echo '<p>Title: ' . $row['title'] . '</p>';
                    echo '<p>Description: ' . $row['description'] . '</p>';
                    echo '<p>Price: ' . $row['price'] . ' ' . $row['currency'] . '</p>';
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
