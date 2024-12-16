<?php
    session_start();

    try {
        $db = new PDO('mysql:host=localhost;dbname=bedflix', "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch(PDOException $e) {
        $db = NULL;
        echo ("Erreur: " . $e->getMessage());
    }
?>
