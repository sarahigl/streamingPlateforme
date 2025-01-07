<?php
require_once('../Model/connect.php'); 
require_once('../Model/films.php');

var_dump($_POST['id_film']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id_film'])) {
    $filmToUpdate = $_POST['id_film'];
    require_once('../Model/_classes.php');
    $currentData = $film->getFilmById($filmToUpdate);

    if ($currentData) {
        $updatedData = [
            'titre_film' => ($_POST['form_title_movie'] != $currentData['titre_film']) ? $_POST['form_title_movie'] : $currentData['titre_film'],
            'description_film' => ($_POST['form_desc_movie'] != $currentData['description_film']) ? $_POST['form_desc_movie'] : $currentData['description_film'],
            'affiche_film' => ($_FILES['form_img_movie']['name'] != '') ? $_FILES['form_img_movie'] : $currentData['affiche_film'],
            'lien_film' => ($_POST['form_link_movie'] != $currentData['lien_film']) ? $_POST['form_link_movie'] : $currentData['lien_film'],
            'duree_film' => ($_POST['form_time_movie'] != $currentData['duree_film']) ? $_POST['form_time_movie'] : $currentData['duree_film']
        ];
    }
    $result = $film->update($filmToUpdate, $updatedData);
    
    if ($result) {
        echo "Film mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour.";
    }
} else {
    echo "Film non trouvé.";
    
} 

