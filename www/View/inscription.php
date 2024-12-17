<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=".\style\inscription.css?v=<?= uniqid()?>">
    <link rel="stylesheet" href="..\style.css?v=<?= uniqid()?>">

    <title>Inscription</title>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <section class="sectionSignup">
        <h1 class="signupTitle">Inscription : </h1>
        <form action="../Model/inscription.php" method="post" class="signupForm">
            <input type="hidden" name="form_inscription" value="1">

            <label for="nomForm">Nom :</label>
            <input type="text" name="form_nom" placeholder="Votre nom" id="nomForm" class="inputField">

            <label for="prenomForm">Prénom :</label>
            <input type="text" name="form_prenom" placeholder="Votre prénom" id="prenomForm" class="inputField">

            <label for="emailForm">Email :</label>
            <input type="text" name="form_email" placeholder="email@exemple.com" id="emailForm" class="inputField">

            <label for="pseudoForm">Pseudo :</label>
            <input type="text" name="form_pseudo" placeholder="Votre pseudo" id="pseudoForm" class="inputField">

            <label for="passwordForm">Mot de passe :</label>
            <input type="password" name="form_password" placeholder="1234" id="passwordForm" class="inputField">

            <input type="submit" value="S'inscrire" id="button">
        </form>
    </section>
</body>
</html>