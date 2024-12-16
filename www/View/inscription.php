<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>inscription.PHP</h1>
    
    <form action="../Model/inscription.php" method="post">
        <input type="hidden" name="form_inscription" value="1">
        <label for="form_email">Email:</label>
        <input type="text" name="form_email" placeholder="Ex: nomprenom@fournisseur.com">
        <label for="form_password">Mot de passe:</label>
        <input type="password" name="form_password" placeholder="1234">
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>