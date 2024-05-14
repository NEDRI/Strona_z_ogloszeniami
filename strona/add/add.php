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

function getCategories($conn, $parent_id = NULL, $sub_mark = ''){
    $sql = "SELECT * FROM categories WHERE parent_category_id " . ($parent_id ? "= ?" : "IS NULL");
    $stmt = $conn->prepare($sql);
    if ($parent_id) {
        $stmt->bind_param("i", $parent_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["id"] . '">' . $sub_mark . $row["name"] . '</option>';
            getCategories($conn, $row["id"], $sub_mark.'-');
        }
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Advertisement</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>

<div class="welcome-container">
    <div class="top-panel">
        <h2>Add Advertisement</h2>
        <div class="button-container">
            <a href="../main/welcome.php" class="back-btn">Back</a>
        </div>
    </div>
    <div class="add-form-container">
        <form method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
            
            <label for="currency">Currency:</label>
            <select id="currency" name="currency" required>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="PLN">PLN</option>
            </select>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select Category</option>
                <?php getCategories($conn); ?>
            </select>

            <label for="status">Status:</label>
            <select id="status" name="status" onchange="showDescription()">
                <option value="active">Active</option>
                <option value="pending">Pending</option>
            </select>

            <div id="description_until" style="display: none;">
                <label for="description_until_input">Description Until When:</label>
                <input type="text" id="description_until_input" placeholder="dd.mm.yy" name="description_until_input">
            </div>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image[]" accept="image/*" onchange="previewImage(event)" required>
            <div id="img-preview" class="img-preview"></div>

            <input type="submit" name="submit" value="Submit" id="submit-btn">
        </form>
    </div>
</div>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = $_POST['price'];
    $currency = $_POST['currency'];
    $user_email = $_SESSION['email'];
    $category_id = $_POST['category'];
    $status = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        if ($status === 'pending') {
            $description_until = $_POST['description_until_input'];
            $sql = "INSERT INTO listings (title, description, price, currency, user_id, category_id, status, created_at, description_until)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsiisss", $title, $description, $price, $currency, $user_id, $category_id, $status, $created_at, $description_until);
        } else {
            $sql = "INSERT INTO listings (title, description, price, currency, user_id, category_id, status, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsiiss", $title, $description, $price, $currency, $user_id, $category_id, $status, $created_at);
        }

        if ($stmt->execute()) {
            $listing_id = $conn->insert_id;
            $target_dir = "../uploads/";
            foreach($_FILES['image']['name'] as $key=>$val){
                $target_file = $target_dir . basename($_FILES["image"]["name"][$key]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $newfilename = $listing_id . '_' . $key . '.' . $imageFileType;
                $target_file = $target_dir . $newfilename;
                if (move_uploaded_file($_FILES["image"]["tmp_name"][$key], $target_file)) {
                    $sql = "INSERT INTO images (url, listing_id) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("si", $newfilename, $listing_id);
                    $stmt->execute();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
            echo "<p>Added successfully</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
