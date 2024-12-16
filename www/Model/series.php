<?php
Class Series{
    private $insert;
    private $select;
    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO series(titre_serie, description_serie, affiche_serie, lien_serie) 
                                      VALUES(:libelle_role, :description_serie, :affiche_serie), :lien_serie;");
    }
    public function insertSeries($titre_serie, $description_serie, $affiche_serie, $lien_serie)
    {
        $r = true;

        $this->insert->execute([
            ':titre_serie' => $titre_serie,
            ':description_serie' => $description_serie,
            ':affiche_serie' => $affiche_serie,
            ':lien_serie' => $lien_serie,
        ]);
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectSeries()
    {
        $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }


}