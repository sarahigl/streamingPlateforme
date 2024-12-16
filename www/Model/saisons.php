<?php
Class Saisons{
    
    private $insert;
    private $select;
    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO saisons(numero_saison, titre_saison, id_serie) 
                                      VALUES(:libelle_role, :titre_saison, :id_serie)");
        $this->select = $db->prepare("SELECT * 
                                      FROM saisons
                                      JOIN series ON (series.id_serie = saisons.id_serie);");
    }
    public function insertSaisons($snumero_saison, $stitre_saison, $sid_serie)
    {
        $r = true;

        $this->insert->execute([
            ':numero_saison' => $snumero_saison,
            ':titre_saison' => $stitre_saison,
            ':id_serie' => $sid_serie,
        ]);
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectSaisons()
    {
        $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }

}