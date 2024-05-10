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
    $sql = "SELECT * FROM categories WHERE parent_category_id " . ($parent_id ? "= $parent_id" : "IS NULL");
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["id"] . '">' . $sub_mark . $row["name"] . '</option>';
            getCategories($conn, $row["id"], $sub_mark.'-');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Advertisement</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="welcome-container">
    <div class="top-panel">
        <h2>Add Advertisement</h2>
        <div class="button-container">
            <a href="#" class="back-btn">Back</a>
        </div>
    </div>
    <div class="add-form-container">
        <form method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="currency">Currency:</label>
            <select id="currency" name="currency" required>
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="PLN">PLN</option>
            </select>

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
                <label for="description_until">Description Until When:</label>
                <input type="text" id="description_until" name="description_until">
            </div>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
            <div id="img-preview"></div>

            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.createElement("img");
        img.src = reader.result;
        var preview = document.getElementById("img-preview");
        preview.innerHTML = '';
        preview.appendChild(img);
        preview.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function showDescription() {
    var status = document.getElementById("status").value;
    var descriptionUntil = document.getElementById("description_until");

    if (status === "pending") {
        descriptionUntil.style.display = "block";
    } else {
        descriptionUntil.style.display = "none";
    }
}
</script>

</body>
</html>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $currency = $_POST['currency'];
    $user_email = $_SESSION['email'];
    $category_id = $_POST['category'];
    $status = $_POST['status'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "SELECT id FROM users WHERE email = '$user_email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        if ($status === 'pending') {
            $description_until = $_POST['description_until'];
            $sql = "INSERT INTO listings (title, description, price, currency, user_id, category_id, status, created_at, description_until)
                    VALUES ('$title', '$description', '$price', '$currency', '$user_id', '$category_id', '$status', '$created_at', '$description_until')";
        } else {
            $sql = "INSERT INTO listings (title, description, price, currency, user_id, category_id, status, created_at)
                    VALUES ('$title', '$description', '$price', '$currency', '$user_id', '$category_id', '$status', '$created_at')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
