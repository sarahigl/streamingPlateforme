<?php
//(remplacer include par require pour sécurité)
session_start();

// Vérifie si l'utilisateur est co
if (!isset($_SESSION['utilisateur'])) {
    header("Location: ../View/connexion.php");
    exit();
}

// Récup les info de l'utilisateur
$user = $_SESSION['utilisateur'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?= uniqid() ?>">
    <title>Profil</title>
</head>
<body>
    <?php require_once('header.php');
    ?>

    <h1 style="text-align: center; padding:10px">
        Bienvenue, <?php echo htmlspecialchars($user['pseudo_utilisateur']); ?> !
    </h1>
    <form action="../Model/delete.php" method="POST">
        <input type="submit" id="button" value="Supprimer mon compte">
    </form>
    
</body>
</html>



