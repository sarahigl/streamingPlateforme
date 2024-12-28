<?php
include_once('../Model/connect.php');
include_once('../Model/_classes.php');
 if (isset($_POST['films'])) {
    $filmCurrent = $_POST['films'];
    // Modifiez la requête pour utiliser id_film au lieu de link_film
    $select = $db->prepare("SELECT id_film, titre_film FROM films WHERE id_film = :id_film;");
    $select->bindParam(":id_film", $filmCurrent);
    $select->execute();
    if (!empty($select->fetch(PDO::FETCH_COLUMN))) {
        //var_dump($_POST);
        $result = $film->delete($filmCurrent);
        if ($result) {
            die('<p style="color: green;">suppression prise en compte.</p>');
        } else {
            die('<p style="color: red;">Erreur lors de la suppression.</p>');
        }
    } 
} else {
    die('<p style="color: red;">Aucun film sélectionné.</p>');
}