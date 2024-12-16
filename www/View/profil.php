<?php


session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur'])) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: /streamingPlateforme/www/View/connexion.php");
    exit();
}

// Récupère les informations de l'utilisateur
$user = $_SESSION['utilisateur'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css">
    <title>navigation</title>
</head>
<body>
    <?php
    include_once('header.php');
    //include_once('navigation.php');
    ?>
    <h1 style="text-align: center; padding:10px">Bienvenue, <?php echo htmlspecialchars($user['email_utilisateur']); ?> !</h1>
</body>
</html>
<style>


