<?php
session_start();
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbdatabase = "projekt";

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbdatabase);
echo "tak1";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listing_id = $_POST['listing_id'];
    echo "tak2";
    $sql = "DELETE  FROM listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);
    echo "tak3";
    if ($stmt->execute()) {
        echo "tak4";
        echo "Pass.";
        header("Location:../main/welcome.php");
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
