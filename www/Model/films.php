<?php
Class Films{
    private $insert;
    private $select;

    public function __construct($db)
    {
        // Préparation de la requête d'insertion
        $this->insert = $db->prepare(
            "INSERT INTO films (titre_film, description_film, affiche_film, lien_film, duree_film) 
             VALUES (:titre_film, :description_film, :affiche_film, :lien_film, :duree_film);"
        );
        
    }

    public function insertFilms($titre, $description, $affiche, $lien, $duree)
    {
        $r = true;
        // Exécution de la requête avec les paramètres
        $this->insert->execute([
            ":titre_film" => $titre,
            ":description_film" => $description,
            ":affiche_film" => $affiche,
            ":lien_film" => $lien,
            ":duree_film" => $duree
        ]);
        

        // Vérification des erreurs
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectFilms()
    {
        // Exécution de la requête de sélection
        $this->select->execute();

        // Vérification des erreurs
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }

        // Retour des résultats sous forme de tableau associatif
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }


}