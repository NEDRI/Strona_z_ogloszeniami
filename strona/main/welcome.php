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
        <h2>Witaj, <?php echo $_SESSION['username']; ?>!</h2>
        <h3>Ogłoszenia</h3>
        <div class="ads-table">
            <table>
                <thead>
                    <tr>
                        <th>Zdjęcie</th>
                        <th>Nazwa produktu</th>
                        <th>Cena</th>
                        <th>Stan</th>
                        <th>Sprzedający</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Telefon komórkowy</td>
                        <td>1200 PLN</td>
                        <td>Nowy</td>
                        <td>Jan Kowalski</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Laptop</td>
                        <td>2500 PLN</td>
                        <td>Używany</td>
                        <td>Alicja Nowak</td>
                    </tr>
                    <!-- Dodaj więcej ogłoszeń -->
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Konsola do gier</td>
                        <td>1500 PLN</td>
                        <td>Używana</td>
                        <td>Michał Wiśniewski</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Smartwatch</td>
                        <td>800 PLN</td>
                        <td>Nowy</td>
                        <td>Katarzyna Nowak</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Telewizor LED</td>
                        <td>3500 PLN</td>
                        <td>Nowy</td>
                        <td>Andrzej Kowalczyk</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Aparat fotograficzny</td>
                        <td>2000 PLN</td>
                        <td>Używany</td>
                        <td>Marta Nowak</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Rowerek dziecięcy</td>
                        <td>150 PLN</td>
                        <td>Używany</td>
                        <td>Anna Kowalska</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Głośniki Bluetooth</td>
                        <td>250 PLN</td>
                        <td>Nowe</td>
                        <td>Mariusz Wiśniewski</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Książka "Wiedźmin"</td>
                        <td>30 PLN</td>
                        <td>Nowa</td>
                        <td>Krzysztof Nowak</td>
                    </tr>
                    <tr>
                        <td><img src="example_product_image.jpg" alt="Zdjęcie produktu"></td>
                        <td>Krzesło biurowe</td>
                        <td>200 PLN</td>
                        <td>Używane</td>
                        <td>Monika Kowalczyk</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
