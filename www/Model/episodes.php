<?php
class Episodes
{
    private $insert;
    private $select;

    public function __construct($db)
    {
        // Préparation de la requête d'insertion
        $this->insert = $db->prepare(
            "INSERT INTO episodes (numero_episode, titre_episode, duree_episode, id_saison) 
             VALUES (:numero_episode, :titre_episode, :duree_episode, :id_saison);"
        );
        $this->select = $db->prepare(
            "SELECT * 
             FROM episodes
             JOIN saisons ON saisons.id_saison = episodes.id_saison;"
        );
    }

    public function insertEpisodes($numero, $titre, $duree, $idSaison)
    {
        $r = true;
        // Exécution de la requête avec les paramètres
        $this->insert->execute([
            ":numero_episode" => $numero,
            ":titre_episode" => $titre,
            ":duree_episode" => $duree,
            ":id_saison" => $idSaison
        ]);

        // Vérification des erreurs
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectEpisodes()
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
