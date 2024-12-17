<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
    

<?php
    include_once('../Model/Utilisateurs.php');

    include_once('../Model/connect.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (!isset($_SESSION['utilisateur'])) {
        // Redirect to login if the user is not logged in
        header("Location: /streamingPlateforme/www/View/connexion.php");
        exit();
    }
    
    // Get the email 
    $email = $_SESSION['utilisateur']['email_utilisateur'];

    //user existant ?
    $select = $db->prepare("SELECT email_utilisateur FROM utilisateurs WHERE email_utilisateur = :email_utilisateur;");
    $select->bindParam(":email_utilisateur", $email);
    $select->execute();
    
   
        if (!empty($select->fetch(PDO::FETCH_COLUMN))) {
            include_once('../Model/_classes.php');
            //var_dump($_POST);
            
            $result = $utilisateur->delete($email);

            if ($result) {
                session_destroy();
                die('<p style="color: green;">Votre compte suppression a bien été prise en compte.</p><a href="../View/connexion.php" id="button">Retour sur accueil.</a>');
            } else {
                die('<p style="color: red;">Erreur lors de la suppression.</p><a href="../View/connexion.php" id="button">Retour sur accueil.</a>');
            }
        } else {
            die('<p style="color: red;">veuillez vous connecter</p><a href="../View/connexion.php" id="button">Retour sur accueil.</a>');
        }
        
?>
