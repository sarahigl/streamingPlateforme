<?php

// Vérifie si l'utili id="listNav"sateur est connecté et s'il n'est pas sur la page de connexion ou d'inscription
$currentPage = basename($_SERVER['PHP_SELF']); // Récupère le nom de la page en cours
if (isset($_SESSION['userEmail']) && !in_array($currentPage, ['connexion.php', 'inscription.php'])) {
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css?v=<?= uniqid()?>">
    <title>navigation</title>
</head>
<body>
    <nav>
        <ul class="navigation">
            <li id="listNav"><a href="/index.php">Accueil</a></li>
            <li id="listNav"><a href="../View/series.php">Séries</a></li>
            <li id="listNav"><a href="../View/films.php">Films</a></li>
            <li id="listNav" class="dropdown">
                <a href="#" class="dropbtn">Catégorie</a>
                <!--
                <ul class="dropdown-content">
                    <li><a href="/View/categorie.php?type=action">Action</a></li>
                    <li><a href="/View/categorie.php?type=drama">Drama</a></li>
                    <li><a href="/View/categorie.php?type=comedy">Comédie</a></li>
                    <li><a href="/View/categorie.php?type=thriller">Thriller</a></li>
                </ul>
-->
            </li>
            <li id="listNav"><a href="../View/profil.php">Profil</a></li>
            <li id="listNav"><a href="../Controller/deconnexion.php">Déconnexion</a></li>
        </ul>
    </nav>
</body>
</html>
    <?php
    }
    ?>
