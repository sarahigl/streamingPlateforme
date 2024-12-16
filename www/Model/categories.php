<?php
Class Categories{
    
    private $insert;
    private $select;

    public function __construct($db)
    {
        $this->insert = $db->prepare(
            "INSERT INTO categories (libelle_categorie) 
             VALUES (:libelle_categorie);"
        );

        $this->select = $db->prepare(
            "SELECT * 
             FROM categories;"
        );
    }

    public function insert($libelleCategorie)
    {
        $r = true;

        $this->insert->execute([
            ":libelle_categorie" => ucfirst(strtolower($libelleCategorie)) // Mise en forme du libellé
        ]);
 
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }

        return $r;
    }

    public function select()
    {
       
        $this->select->execute();

        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }

        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }

}