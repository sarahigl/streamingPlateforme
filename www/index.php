<?php
session_start(); // Démarre la session une seule fois au début
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
    <body>
        <h1>index.PHP</h1>

        <?php
            header(header: "Location: ./View/connexion.php");
            exit();
        ?>

    </body> 
</html>