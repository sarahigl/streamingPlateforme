<?
//(remplacer include par require pour X affiché toutes les rapports d'erreurs)
require_once('connect.php');
Class Films{
    private $db;
    private $insert;
    private $select;
    private $selectByID;
    private $update;
    private $delete;
    private $title;
    private $desc;
    private $img;
    private $link;
    private $time;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($nTitle) {
        $this->title = $nTitle;
    }
    public function getDesc() {
        return $this->desc;
    }

    public function setDesc($nDesc) {
        $this->desc = $nDesc;
    }

    public function getImg() {
        return $this->img;
    }

    public function setImg($nImg) {
        $this->img = $nImg;
    }

   
    public function getLink() {
        return $this->link;
    }

    public function setLink($nLink) {
        $this->link = $nLink;
    }


    public function getTime() {
        return $this->time;
    }

    public function setTime($nTime) {
        $this->time = $nTime;
    }
   
    public function __construct($db, $title = null, $desc = null, $img = null, $link = null, $time = null) {
        $this->db = $db;
        $this->title = $title;
        $this->desc = $desc;
        $this->img = $img;
        $this->link = $link;
        $this->time = $time;
    
        $this->prepareQueries();
    }
    
    private function prepareQueries() {
        $this->insert = $this->db->prepare(
            "INSERT INTO films (titre_film, description_film, affiche_film, lien_film, duree_film) 
            VALUES (:titre_film, :description_film, :affiche_film, :lien_film, :duree_film);"
        );
        $this->select = $this->db->prepare("SELECT * FROM films");
        $this->selectByID = $this->db->prepare(
            "SELECT * 
            FROM films 
            WHERE id_film = :id_film;"
        );
        $this->update = $this->db->prepare('UPDATE films 
                                            SET titre_film = :titrefilm, description_film = :description_film, affiche_film= :affiche_film, lien_film= :lien_film, duree_film= :duree_film
                                            WHERE id_film = :id_film;');
        $this->delete = $this->db->prepare("DELETE FROM films WHERE id_film = :id_film;");
    }
    

    public function insert($titre, $description, $affiche, $lien, $duree)
    {
        $r = true;
        $this->insert->execute([
            ":titre_film" => $titre,
            ":description_film" => $description,
            ":affiche_film" => $affiche,
            ":lien_film" => $lien,
            ":duree_film" => $duree
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
    public function getFilmByID($id_film){
        $this->selectByID->execute([':id_film' => $id_film]);
        return $this->selectByID->fetch(PDO::FETCH_ASSOC);
    }
    public function update($id_film, $data){
        $result = $this->update->execute([
            ':titre_film' => $data['titre_film'],
            ':description_film' => $data['description_film'],
            ':affiche_film' => $data['affiche_film'],
            ':lien_film' => $data['lien_film'],
            ':duree_film' => $data['duree_film'],
            ':id_film' => $id_film
        ]);

        if ($this->update->errorCode() != 0) {
            print_r($this->update->errorInfo());
            return false;
        }
        return $result;
    }

    public function delete($id_film){
        try {
            $this->delete->execute([":id_film" => $id_film]);
            
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
//insertion data
if(!empty($_POST['form_add_movie'])){
    $title = htmlspecialchars($_POST['form_title_movie'], ENT_QUOTES, 'UTF-8');
    $desc = htmlspecialchars($_POST['form_desc_movie'], ENT_QUOTES, 'UTF-8');
    $img = htmlspecialchars($_POST['form_img_movie'], ENT_QUOTES, 'UTF-8'); //sanitize the name
    $link = htmlspecialchars($_POST['form_link_movie'], ENT_QUOTES, 'UTF-8');
    $time = htmlspecialchars($_POST['form_time_movie'], ENT_QUOTES, 'UTF-8');

    //upload img
    if(isset($_FILES['form_img_movie'])){
        $extensions_ok= array('png','jpg');
        for($i=0; $i < sizeof($_FILES['form_img_movie']['name']); $i++){
            //extension ok ?
            $fileExtension = strtolower(pathinfo($_FILES['form_img_movie']['name'][$i], PATHINFO_EXTENSION));
            if (!in_array($fileExtension, $extensions_ok)) {
                echo '<span style="color: red;">Extension non autorisée</span>';
                //size img ok ?
            } else if (filesize($_FILES['form_img_movie']['tmp_name'][$i]) > 3145728) {
                echo '<span style="color: red;">La taille du fichier dépasse les 3Mo</span>';
            }else{
                //sanitizing
                // original file name
                $file_name = basename($_FILES['form_img_movie']['name']);
                $file_name = preg_replace('/[^a-zA-Z0-9\-_\.]/', '', $file_name);
                //where to save
                $targetDir = '/imgs/';
                $file_path = $targetDir . $file_name;
                //saving bdd
                if (move_uploaded_file($_FILES['form_img_movie']['tmp_name'], $file_path)) {
                    echo "Affiche téléchargé avec succés !";
                    
                    // Insertion BDD
                    $sql = "INSERT INTO films (affiche_film) VALUES (:file_path)";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':file_path', $file_path);
                    $stmt->execute();
                } else {
                    echo "Erreur d'enregistrement de l'affiche.";
                }
            }
        }

    }

    //verifier si le film existe dans la base
    $select = $db->prepare("SELECT id_film FROM films WHERE titre_film = :titre_film OR lien_film = :lien_film;");
    $select->bindParam(":titre_film", $title);
    $select->bindParam(":lien_film", $link);
    $select->execute();

    //condition
    if ($select->rowCount() <= 0) {
        var_dump($_POST);
        include_once('_classes.php');
        $adding=$film->insert($title, $desc,$img,$link,$time);
        if($adding){
            die('<p> Ajout fait avec succés </p>');
        }else{
            die('<p> Une erreur est survenue le films est impossible à enregistrer</p>');
        }
    } else {
        echo "Ce film existe déjà dans la base de données.";
    }

}



