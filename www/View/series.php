<?php
session_start();
if (!isset($_SESSION['userEmail'])) {
    header("Location: /streamingPlateforme/www/View/connexion.php");
    exit();
}

include('../View/navigation.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css">
    <title>Séries</title>
</head>
<body>
    <h1>Bienvenue sur la page Séries</h1>
    <p>Contenu spécifique aux séries...</p>
</body>
</html>