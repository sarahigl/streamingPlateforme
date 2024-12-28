<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".\style\connexion.css?v=<?= uniqid()?>">
    <link rel="stylesheet" href="..\style.css?v=<?= uniqid()?>">
    <title>Connexion</title>
</head>
<body>

    <?php
    //session_start();
    include_once('header.php');
    // Vérifier si l'e-mail a été soumis
    if (isset($_POST['form_email'])) {
        $_SESSION['userEmail'] = $_POST['form_email'];
        $showPasswordStep = true; // Afficher le champ mdp
    } else {
        $showPasswordStep = false; // Ne pas afficher mdp
    }
      
    
    ?>
    <?php
        
    ?>
    <div class="auth">
        <!-- Étape 1 : Email -->
        <?php if (!$showPasswordStep): ?>
            <form action="" method="post" class="connexion">
                <h2 class="titleCo">Connexion</h2>
                <label for="form_email">Email:</label>
                <input type="text" name="form_email" id="form_email" placeholder="email@exemple.com" required>
                <input type="submit" value="Suivant" id="button">
            </form>
        <?php endif; ?>
            <!-- Étape 2 : Mot de passe -->
        <?php if ($showPasswordStep): ?>
            <form action="/streamingPlateforme/www/Controller/connexion.php" method="post">
                <input type="hidden" name="form_connexion" value="1">
                <input type="hidden" name="form_email" value="<?php echo htmlspecialchars($_SESSION['userEmail']); ?>">
                <label for="form_password">Mot de passe:</label>
                <input type="password" name="form_password" id="form_password" placeholder="1234" required>
                <input type="submit" value="Se connecter" id="button">
            </form>
        <?php endif; ?>
        
        <form action="inscription.php" method="post">
            <input type="button" value="Inscription" onclick="window.location.href='inscription.php'" class="signup" id="button">
        </form>
    </div>
</body>
</html>