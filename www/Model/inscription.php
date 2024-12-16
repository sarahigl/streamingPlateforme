<?php
    // On inclut notre connecteur à la base de données
    include('../Model/connect.php');

    // On entre dans la boucle seulement lors de l’envoi du formulaire
    if(!empty($_POST["form_inscription"])) {
        // On recherche si l'adresse email existe déjà en BDD
        $select = $db->prepare("SELECT email_utilisateur FROM utilisateurs WHERE email_utilisateur=:email_utilisateur;");
        $select->bindParam(":email_utilisateur", $_POST["form_email"]);
        $select->execute();
        if(empty($select->fetch(PDO::FETCH_COLUMN))) {
            // Si ce n'est pas le cas, on vient l'insérer
            $insert = $db->prepare("INSERT INTO utilisateurs(email_utilisateur, mot_de_passe_utilisateur)
                                    VALUES(:email_utilisateur, :mot_de_passe_utilisateur);");
            $insert->bindParam(":email_utilisateur", $_POST['form_email']);
            // Nous hachons notre mdp avec l'algo BCRYPT et un coût algorithmique (par défaut à 10)
            $user_password = password_hash($_POST['form_password'], PASSWORD_BCRYPT, array("cost" => 12));
            $insert->bindParam(":mot_de_passe_utilisateur", $user_password);

            if($insert->execute()) {
                // Si aucune erreur ne se produit, on propose de se connecter
                die('<p style=”color: green;”>Inscription réussie.</p><a href="/View/connexion.php">Se connecter.</a>');
            }
            die('<p style=”color: red;”>Inscription échouée.</p><a href="/View/inscription.php">Réessayer.</a>');
        }
    }