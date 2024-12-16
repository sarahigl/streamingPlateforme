<?php
    include('../Model/connect.php');

    // Comme dans la page d'index, sauf qu'ici c'est forcé
    session_destroy();
    // Puis on redirige l'utilisateur vers la page de notre choix (ici connexion.php)
    header("Location: ../View/connexion.php"); //comm avec la view de connexion

