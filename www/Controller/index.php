<?php
    // On inclut notre connecteur à la base de données
    include('../Model/connect.php');
    var_dump($_SESSION);

    if(empty($_SESSION["user"])) {        
        // Permet de détruire la session PHP courante ainsi que toutes les données rattachées
        session_destroy();
        header("Location: ../View/connexion.php");
    }