

<?php
    // Inclure la classe Utilisateurs
    include_once('../Model/Utilisateurs.php');

    include_once('../Model/connect.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if(!empty($_POST["form_inscription"])) {
        // Récupérer les données du form
        $nom = $_POST['form_nom'];
        $prenom = $_POST['form_prenom'];
        $pseudo = $_POST['form_pseudo'];
        $email = $_POST['form_email'];
        $password = password_hash($_POST['form_password'], PASSWORD_BCRYPT, ['cost' => 12]);

        // Vérifier si l'email est déjà dans la base
        $select = $db->prepare("SELECT email_utilisateur FROM utilisateurs WHERE email_utilisateur=:email_utilisateur;");
        $select->bindParam(":email_utilisateur", $email);
        $select->execute();

        if (empty($select->fetch(PDO::FETCH_COLUMN))) {
            // Créer un objet Utilisateur
            include_once('../Model/_classes.php');
            var_dump($_POST);
            // Appeler la méthode insert pour insérer les données
            $result = $utilisateur->insert($nom, $prenom, $pseudo, $email, $password);

            if ($result) {
                echo('<p style="color: green;">Inscription réussie.</p>');
                header("Location: /streamingPlateforme/www/View/connexion.php");
                exit();
            } else {
                die('<p style="color: red;">Erreur lors de l\'inscription.</p><a href="/View/inscription.php">Réessayer.</a>');
            }
        } else {
            die('<p style="color: red;">L\'email est déjà utilisé.</p>');
        }
    }


