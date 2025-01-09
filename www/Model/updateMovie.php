<?php
require_once('../Model/connect.php'); 
require_once('../Model/films.php');

// var_dump($_POST['id_film']);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['id_film'])) {
    $filmToUpdate = $_POST['id_film'];
    require_once('../Model/_classes.php');
    $currentData = $film->getFilmById($filmToUpdate);

    if ($currentData) {
        $updatedData = [
            'titre_film' => ($_POST['form_title_movie'] != $currentData['titre_film']) 
                    ? $_POST['form_title_movie'] 
                    : $currentData['titre_film'],
    
            'description_film' => ($_POST['form_desc_movie'] != $currentData['description_film']) 
                                ? $_POST['form_desc_movie'] 
                                : $currentData['description_film'],
            
            'affiche_film' => (!empty($_FILES['form_img_movie']['name'])) 
                            ? $_FILES['form_img_movie']['name']  // Nouvelle img téléchargée
                            : $_POST['current_image'],           // Conserver l'img actuelle
            
            'lien_film' => ($_POST['form_link_movie'] != $currentData['lien_film']) 
                        ? $_POST['form_link_movie'] 
                        : $currentData['lien_film'],
            
            'duree_film' => ($_POST['form_time_movie'] != $currentData['duree_film']) 
                            ? $_POST['form_time_movie'] 
                            : $currentData['duree_film']
        ];
    }
    $result = $film->update($filmToUpdate, $updatedData);
    
    if ($result) {
        $_SESSION['success_message'] = "Film mis à jour avec succès.";
        header("Location: ../View/films.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Erreur lors de la mise à jour.";
        header("Location: films.php");
        exit;
    }
} else {
    echo "Film non trouvé.";
    
} 

