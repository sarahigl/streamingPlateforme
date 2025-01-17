<?php
require('../Model/connect.php');

if(!empty($_POST["form_connexion"]) && filter_var($_POST["form_email"], FILTER_VALIDATE_EMAIL)) {

    $mail = filter_var($_POST["form_email"], FILTER_SANITIZE_EMAIL);
    $select = $db->prepare("SELECT * FROM utilisateurs WHERE email_utilisateur=:email_utilisateur;");
    $select->bindParam(":email_utilisateur", $mail);
    $select->execute();
    // La fonction rowCount() permet de donner le nombre de lignes pour une requête
    if($select->rowCount() === 1) {
        $user = $select->fetch(PDO::FETCH_ASSOC);
        // Permet de vérifier le hash par rapport au mot de passe saisi
        if(password_verify($_POST["form_password"], $user['mot_de_passe_utilisateur'])) {
            // On affecte les données de notre utilisateur dans notre super globale $_SESSION
            $_SESSION['utilisateur'] = $user;
            // Le header permet d'effectuer une requête HTTP, la valeur Location permet la redirection vers un autre fichier
            header("Location: ../View/profil.php"); //com avec le html de la page 
            exit();
	    }else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect.";
        }
    } else {
        //unset($_SESSION['utilisateur']);
        //header("Location: ../View/connexion.php?error=email_invalid");    
        echo "Aucun compte trouvé pour cet utilisateur.<a href='../View/connexion.php'>Retour à la connexion</a>";
        //exit();
        
    }
}