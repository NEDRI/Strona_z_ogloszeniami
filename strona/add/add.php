<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="script.js"></script>
    <title>Add Advertisement</title>
</head>
<body>
    <div class="welcome-container">
        <div class="top-panel">
            <h2>Add Advertisement</h2>
            <div class="button-container">
                <a class="back-btn" href="../main/welcome.php">Back</a>
            </div>
        </div>
        <div class="add-form-container">
            <form action="add_process.php" method="post" enctype="multipart/form-data">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description"></textarea><br><br>
                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
                <label for="currency">Currency:</label><br>
                <select id="currency" name="currency" required>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="PLN">PLN</option>
                </select><br><br>
                <label for="category_id">Category:</label><br>
                <select id="category_id" name="category_id" required>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                </select><br><br>
                <label for="status">Status:</label><br>
                <select id="status" name="status" required>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select><br><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)"><br><br>
                <img id="img-preview" src="#" alt="Image Preview" style="display: none; max-width: 200px; margin-top: 10px;"><br><br>
                <input type="submit" class="back-btn" value="Add Advertisement">
            </form>
        </div>
    </div>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var img = document.getElementById('img-preview');
                img.style.display = 'block';
                img.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
