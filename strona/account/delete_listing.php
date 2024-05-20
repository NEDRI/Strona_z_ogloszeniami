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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listing_id = $_POST['listing_id'];

    $sql = "DELETE FROM listings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);

    if ($stmt->execute()) {
        echo "Ogłoszenie usunięte pomyślnie.";
    } else {
        echo "Błąd: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
