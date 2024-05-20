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
    $sql = "DELETE FROM images WHERE listing_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $listing_id);
    if ($stmt->execute()){
        $sql = "DELETE FROM listings WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $listing_id);
        echo "tak1";
        if ($stmt->execute()) {
            header("Location:../main/welcome.php");
        } else {
            echo "error: " . $sql . "<br>" . $conn->error;
        }
    }
    else{
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    echo "tak3";
    $stmt->close();
}

$conn->close();
?>
