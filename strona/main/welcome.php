<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj - Strona Główna</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="welcome-container">
        <div class="top-panel">
            <div class="logout-container">
                <form action="logout.php" method="post">
                    <input class="logout-btn" type="submit" value="logout">
                </form>
            </div>
            <div class="add-container">
                    <input class="add-btn" type="submit" value="add">
            </div>
            <h2>Witaj, <?php session_start(); echo $_SESSION['username']; ?>!</h2>
        </div>    
        <h3>Ogłoszenia</h3>
        <div class="ads-table">
            <div class="grid-container">
                <div class="grid-item">1</div>
                <div class="grid-item">2</div>
                <div class="grid-item">3</div>
                <div class="grid-item">4</div>
                <div class="grid-item">5</div>
                <div class="grid-item">6</div>
                <div class="grid-item">7</div>
                <div class="grid-item">8</div>
                <div class="grid-item">9</div>
                <div class="grid-item">10</div>
            </div>
        </div>
    </div>
</body>
</html>
