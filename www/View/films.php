<?php
include_once('header.php');
include_once('../Model/_classes.php');

if (!isset($_SESSION['utilisateur'])) {
    header("Location: /streamingPlateforme/www/View/connexion.php");
    exit();
}

$user = $_SESSION['utilisateur'];
//display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style.css?v=<?= uniqid()?>">
    <title>Séries</title>
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
        ?>

        <table class="movies">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>affiche</th>
                <th>Duree</th>
                <th> # </th>
            </tr>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td class="details"><?= $row['id_film'] ?></td>
                <td class="details"><?= $row['titre_film'] ?></td>
                <td class="details"><?= $row['description_film'] ?></td>
                <td class="details"><?= $row['affiche_film'] ?></td>
                <td class="details"><?= $row['duree_film'] ?> min</td>
                <td class="details">
                    <form action="../Model/deleteMovie.php" method="POST">
                        <input type="hidden" name="films" value="<?= $row['id_film'] ?>">
                        <input type="submit" id="button" value="Supprimer">
                    </form>
                    
                </td>
            </tr>
        <?php } ?>
        </table>

        

</body>
</html>
    <style>
        .sectionAddMovie{
            display: flex;
            flex-direction: column;
        }
        input{
            border-radius: 10px;
        }
        .movies{
            display: flex;
            justify-content: center;
            padding: 10px;
        }
        .details{
        margin: 15px;
        border: 2px solid white;
        padding: 10px;
        border-radius: 10px;
        align-content: center;
        }
    </style>


   
    
