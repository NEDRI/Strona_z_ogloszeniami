<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href="<?php session_start(); $_SESSION["motyw"] ?> ">
    <script type="text/javascript" src="script.js"></script>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="button" value="Start machine" />
    </form>
    <p>The machine is stopped.</p>
    <script>
    const button = document.querySelector("input");
    const paragraph = document.querySelector("p");

    button.addEventListener("click", updateButton);

    function updateButton() {
        if (button.value === "Start machine") {
        button.value = "Stop machine";
        paragraph.textContent = "The machine has started!";
        <?php session_start(); $_SESSION["motyw"] = "stylesW.css"; ?>
        } else {
        button.value = "Start machine";
        paragraph.textContent = "The machine is stopped.";
        <?php session_start(); $_SESSION["motyw"] = "stylesB.css"; ?>
        }
    }
    </script>
</body>
</html>