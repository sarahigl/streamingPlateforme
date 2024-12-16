<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>connexion.PHP</h1>
    <?php
    session_start();
    // Vérifier si l'e-mail a été soumis
    if (isset($_POST['form_email'])) {
        $_SESSION['userEmail'] = $_POST['form_email'];
        $showPasswordStep = true; // Afficher le champ mdp
    } else {
        $showPasswordStep = false; // Ne pas afficher mdp
    }
    ?>
    <!-- Étape 1 : Email -->
    <?php if (!$showPasswordStep): ?>
        <form action="" method="post">
            <label for="form_email">Email:</label>
            <input type="text" name="form_email" id="form_email" placeholder="Ex: nomprenom@fournisseur.com" required>
            <input type="submit" value="Suivant">
        </form>
    <?php endif; ?>
         <!-- Étape 2 : Mot de passe -->
    <?php if ($showPasswordStep): ?>
        <form action="../Controller/connexion.php" method="post">
            <input type="hidden" name="form_connexion" value="1">
            <input type="hidden" name="form_email" value="<?php echo htmlspecialchars($_SESSION['userEmail']); ?>">
            <label for="form_password">Mot de passe:</label>
            <input type="password" name="form_password" id="form_password" placeholder="1234" required>
            <input type="submit" value="Se connecter">
        </form>
    <?php endif; ?>
    
    <h1>Inscription</h1>
    <form action="inscription.php" method="post">
        <input type="button" value="Inscription" onclick="window.location.href='inscription.php'">
    </form>
</body>
</html>