<?php
include('../Model/utilisateurs.php');
include('../Model/_classes.php');
require_once('./View/connexion.php');

session_start();
require_once'../Controller/connexion.php';
if (isset($_SESSION['userEmail'])) {
    $userEmail = $_SESSION['userEmail'];
    try{
        //prepare & execute et fetch
        $user = $utilisateur->selectByPseudo($userEmail);
        // Vérifier si l'utilisateur existe
        if ($user) {
            // Afficher les informations de l'utilisateur
            echo "Bienvenue, " . htmlspecialchars($user['pseudo_utilisateur']) ."!";
        } else {
            echo "Utilisateur non trouvé.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur
        echo "Erreur de connexion ou de requête : " . $e->getMessage();
    }
} else {
    echo "Aucun utilisateur connecté.";
}
