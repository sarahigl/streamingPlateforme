<?php
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css">
    <title>navigation</title>
</head>
<body>
    <header class="titleS">
        <h1 class="logo">Bedflix</h1>
        <?php
            session_start();
            if (!isset($_SESSION['utilisateur'])) { // If the user is not logged in
        ?>
            <div class="banner">
                <img src="../public/fond.png" alt="" id="imgBackCo">
                <h2 class="caption">Vos films et séries préférés, prêts à vous transporter dans des mondes inoubliables !</h2>
            </div>
        <?php
            }
            include_once('navigation.php');
        ?>
    </header>

</body>
</html>