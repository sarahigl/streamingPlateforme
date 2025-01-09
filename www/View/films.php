<?php
require_once('header.php');
require_once('../Model/_classes.php');

if (!isset($_SESSION['utilisateur'])) {
    header("Location: View/connexion.php");
    exit();
}

$user = $_SESSION['utilisateur'];
//display errors
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css?v=<?= uniqid()?>">
    <link rel="stylesheet" href=".\style\films.css?v=<?= uniqid()?>">
    <title>Films</title>
</head>
<body>
    <h1>Films :</h1>
    <?php
        // Vérifier si l'utilisateur a un ID_role égal à 1 (administrateur)
        if ($user['id_role'] == 1) {
            //echo "<p>Administrateur</p>";
    ?>
        <section class="sectionAddMovie">
            <h1 class="addMovieTitle"> Ajout d'un film : </h1>
            <form action="../Model/films.php" method="post" class="addForm">
                <input type="hidden" name="form_add_movie" value="1">

                <label for="titleMovieForm">Titre :</label>
                <input type="text" name="form_title_movie" placeholder="titre" id="titleMovieForm" class="inputField">

                <label for="descMovieForm">Description :</label>
                <input type="text" name="form_desc_movie" placeholder="Description" id="descMovieForm" class="inputField">

                <label for="imgMovieForm">Affiche :</label>
                <input type="file" name="form_img_movie"  accept=".png, .jpg" id="imgMovieForm" class="inputField">
                

                <label for="linkMovieForm">Lien :</label>
                <input type="text" name="form_link_movie" placeholder="link" id="linkMovieForm" class="inputField">

                <label for="TimeMovieForm">Durée :</label>
                <input type="text" name="form_time_movie" id="timeMovieForm" class="inputField">

                <input type="submit" value="Valider" id="button">
            </form>
        </section>
    <?php       
        } else {
           // echo "<p>Bienvenue, utilisateur !</p>";
            
    ?><?php
        }

        //fetch data from bdd
        $req = $db->query('SELECT id_film, titre_film, description_film, affiche_film, duree_film FROM films;');
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if (isset($_SESSION['success_message'])) {
            echo "<div style='color: green;'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']); 
        }
        
        if (isset($_SESSION['error_message'])) {
            echo "<div style='color: red;'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']); // Supprime le message après affichage
        }
        ?>
        
        <table class="movies">
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Affiche</th>
                <th>Duree</th>
                <?php if ($user['id_role'] == 1) { ?>
                <th>Supprimer</th>
                <th>Modifier</th>
                <?php } ?>
            </tr>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td class="details"><?= $row['titre_film'] ?></td>
                <td class="details"><?= $row['description_film'] ?></td>
                <td class="details"><img src="<?= $row['affiche_film'] ?>" alt="<?= $row['titre_film'] ?>" class="imgDisplay"></td>
                <td class="details"><?= $row['duree_film'] ?> min</td>

                <?php if ($user['id_role'] == 1) { ?>
                <td class="details">
                    <form action="../Model/deleteMovie.php" method="POST">
                        <input type="hidden" name="films" value="<?= $row['id_film'] ?>">
                        <input type="submit" id="button" value="Supprimer">
                    </form> 
                </td>
                <td class="details">
                    <form action="updateMovie.php" method="POST">
                        <input type="hidden" name="id_film" value="<?= $row['id_film'] ?>">
                        <input type="submit" id="button" value="Modifier">
                    </form>
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </table>
</body>
</html>
    


   
    
