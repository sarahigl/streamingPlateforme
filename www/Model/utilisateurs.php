<?php
Class utilisateurs
{
    private $insert;
    private $select;
    private $selectByPseudo;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO utilisateurs(nom_utilisateur, prenom_utilisateur, email_utilisateur, pseudo_utilisateur, mots_de_passe_utilisateur, id_role) 
                                      VALUES(:nom_utilisateur, :prenom_utilisateur, :pseudo_utilisateur, :mots_de_passe_utilisateur, :id_role);");
        $this->select = $db->prepare("SELECT * 
                                      FROM utilisateurs
                                      JOIN roles ON (roles.id_role = utilisateurs.id_role);");
        $this->selectByPseudo = $db->prepare("SELECT utilisateurs.pseudo_utilisateur 
                                          FROM utilisateurs
                                          WHERE email_utilisateur = :email_utilisateur;");
    }
    public function selectByPseudo($email_utilisateur){
        $this->selectByPseudo->execute(array(':email_utilisateur' => $email_utilisateur));
        if ($this->selectByPseudo->errorCode() != 0) {
            print_r($this->select->errorInfo());
        }
            return $this->selectByPseudo->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($sNom, $sPrenom, $sPseudo, $sMdp, $iIdRole)
    {
        $r = true;
        $this->insert->execute(array(
            ":nom_utilisateur" => strtoupper($sNom),
            ":prenom_utilisateur" => ucfirst(strtolower($sPrenom)),
            ":pseudo_utilisateur" => $sPseudo,
            ":mots_de_passe_utilisateur" => $sMdp,
            ":id_role" => $iIdRole
        ));
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function select()
    {
        if ($this->select->errorCode() != 0) {
        $this->select->execute();
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll(PDO::FETCH_ASSOC);
    }
}