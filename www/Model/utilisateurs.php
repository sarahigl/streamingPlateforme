<?php
Class utilisateurs
{
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectByPseudo;

    public function __construct($db)
    {
        $this->insert = $db->prepare("INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, email_utilisateur, mot_de_passe_utilisateur, id_role)
                                    VALUES (:nom_utilisateur, :prenom_utilisateur, :pseudo_utilisateur, :email_utilisateur, :mot_de_passe_utilisateur, :id_role);");
        $this->select = $db->prepare("SELECT * 
                                      FROM utilisateurs
                                      JOIN roles ON (roles.id_role = utilisateurs.id_role);");
        $this->delete = $db->prepare("DELETE FROM utilisateurs WHERE email_utilisateur = :email_utilisateur");
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

    public function insert($sNom, $sPrenom, $sPseudo, $sEmail, $sMdp)
    {
        $r = true;
        $this->insert->execute(array(
            ":nom_utilisateur" => strtoupper($sNom),
            ":prenom_utilisateur" => ucfirst(strtolower($sPrenom)),
            ":pseudo_utilisateur" => $sPseudo,
            ":email_utilisateur" => strtolower($sEmail),
            ":mot_de_passe_utilisateur" => $sMdp,
            ":id_role" => 2 // Rôle par défaut pour un utilisateur
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

    public function delete($email_utilisateur){
        try {
            $this->delete->execute([":email_utilisateur" => $email_utilisateur]);
    
            // Vérifiez si la suppression a bien eu lieu
            if ($this->delete->rowCount() > 0) {
                return true; // Suppression réussie
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            print_r($this->delete->errorInfo());
            return false;
        }
    }
}