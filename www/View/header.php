<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?= uniqid() ?>">
    <title>Header</title>
</head>
<body>
    <header class="titleS">
        <h1 class="logo">Bedflix</h1>
        <?php
        // Affiche la bannière uniquement si l'utilisateur n'est pas connecté
        if (!isset($_SESSION['utilisateur'])) { 
        ?>
            <div class="banner">
                <img src="../public/fond.png" alt="" id="imgBackCo">
                <h2 class="caption">
                    Vos films et séries préférés, prêts à vous transporter dans des mondes inoubliables !
                </h2>
            </div>
        <?php } ?>
        <?php require_once('navigation.php'); ?>
    </header>
</body>
</html>
