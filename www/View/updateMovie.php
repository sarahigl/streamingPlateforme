<?php
require_once('header.php');
require_once('../Model/_classes.php');

if (isset($_POST['id_film'])) {
    $filmId = $_POST['id_film'];
} else {
    die('Film non trouvé');
}
 $req = $db->prepare('SELECT * FROM films WHERE id_film = :id_film;');
 $req->execute(['id_film' => $filmId]);
 $data = $req->fetch(PDO::FETCH_ASSOC);
 $req->closeCursor();

 //var_dump($_POST['id_film']);
 ?>

<section class="sectionUpdateMovie">
            <h1 class="updateMovieTitle"> Modification d'un film : </h1>
            <form action="../Model/updateMovie.php" method="POST" class="updateForm">
                <input type="hidden" name="id_film" value="<?= $filmId ?>">
                <input type="hidden" name="form_update_movie" value="1">
                <label for="titleMovieForm">Titre :</label>
                <input type="text" name="form_title_movie" value="<?= htmlspecialchars($data['titre_film']) ?>" id="titleMovieForm" class="inputField">

                <label for="descMovieForm">Description :</label>
                <input type="text" name="form_desc_movie" value="<?= htmlspecialchars($data['description_film']) ?>" id="descMovieForm" class="inputField">

                <label for="imgMovieForm">Affiche :</label>
                <input type="file" name="form_img_movie"  accept=".png, .jpg" id="imgMovieForm" class="inputField" value="<?= htmlspecialchars($data['affiche_film']) ?>">
                

                <label for="linkMovieForm">Lien :</label>
                <input type="text" name="form_link_movie" value="<?= htmlspecialchars($data['lien_film']) ?>" id="linkMovieForm" class="inputField">

                <label for="TimeMovieForm">Durée :</label>
                <input type="text" name="form_time_movie" value="<?= htmlspecialchars($data['duree_film']) ?>" id="timeMovieForm" class="inputField">

                <input type="submit" id="button" value="Modifier">
            </form>
</section>
