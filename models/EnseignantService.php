<?php
require_once('Provider.php');

class EnseignantService {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // Stocke l'objet PDO
    }

    public function add($id, $nom, $prenom, $sexe, $email, $adresse) {
        $stmt = $this->pdo->prepare("INSERT INTO enseignants (id, nom, prenom, sexe, email, adresse) VALUES (:id, :nom, :prenom, :sexe, :email, :adresse)");
        $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'email' => $email,
            'adresse' => $adresse
        ]);
    }
}



class EnseignantService
{
    private $connexion;

    function __construct()
    {
        $p = new Provider();
        $this->connexion = $p->getconnection();
    }
    


    public function edit($id, $nom, $prenom, $sexe, $email, $adresse)
    {

        $requete='update enseignants set nom=:nm, prenom=:pr, sexe=:sx, email=:email, adresse=:adresse where id=:id';
        $stmt=$this->connexion->prepare($requete);
        $result=$stmt->execute([
            'nm'=> $nom,
            'pr'=> $prenom,
            'sx'=> $sexe,
            'email'=> $email,
            'adresse'=> $adresse,
            'id'=> $id
        ]);

    }


    public function getByid($id)
    {
        $requete="select * from enseignants where id=:id";
        $stmt=$this->connexion->prepare($requete);
        $res=$stmt->execute([
            'id'=> $id
        ]);
        $Enseignant=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if (isset($Enseignant[0])){
            return $enseignant[0];
        }
        else
        return null;
    }
    public function getAll()
    {
        $requete = 'select * from enseignants order by id desc';
        $st = $this->connexion->query($requete);
        $enseignant = $st->fetchAll(PDO::FETCH_ASSOC);
        return $enseignant;
    }

    public function delete($id)
    {
        $requete='delete from enseignants where id=:id';
        $sta=$this->connexion->prepare($requete);
        $res=$sta->execute([
            'id'=> $id
        ]);
    }

}