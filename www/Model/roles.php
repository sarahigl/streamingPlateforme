<?php
class Roles{
    private $insert;
    private $select;
    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO roles(libelle_role) 
                                      VALUES(:libelle_role);");
    }
    public function insertRole($libelle_role)
    {
        $r = true;
        $this->insert->execute([':libelle_role' => $libelle_role]);
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectRole()
    {
        $this->select->execute();
        if ($this->select->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }
}