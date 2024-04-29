<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
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
                    <input class="add-btn" type="submit" value="add">
                </div>
            </div>
            <h2>Welcome, <?php session_start(); echo $_SESSION['username']; ?>!</h2>
        </div>    
        <h3>Advertisements:</h3>
        <div class="grid-container">
            <?php
            $advertisements = [
                [
                    'photo' => '../photo/kaczka.jpg',
                    'name' => 'name1',
                    'price' => 100
                ],
                [
                    'photo' => '../photo/test.png',
                    'name' => 'name2',
                    'price' => 200
                ],
                [
                    'photo' => '../photo/kaczka.jpg',
                    'name' => 'name3',
                    'price' => 300
                ],
            ];
            foreach ($advertisements as $advertisement) {
                echo '<div class="grid-item">';
                echo '<img class="grid-img" src="' . $advertisement['photo'] . '" alt="Advertisement photo">';
                echo '<p>Name: ' . $advertisement['name'] . '</p>';
                echo '<p>Price: ' . $advertisement['price'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
