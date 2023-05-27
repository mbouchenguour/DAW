<?php
require_once 'Model.php';


class Utilisateur extends Model
{
    private $id;
    private $nom_utilisateur;
    private $email;
    private $mot_de_passe;
    private $premiere_connexion;
    private $role;
    private $niveau;

    public function getByEmail($email)
    {
        $db = Bdd::getInstance()->getConnection();
        $query = $db->prepare('SELECT * FROM utilisateurs WHERE email = :email LIMIT 1');
        $query->execute(['email' => $email]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }
        $this->createFromRow($row);
    }

    public function getById($id)
    {
        $db = Bdd::getInstance()->getConnection();
        $query = $db->prepare('SELECT * FROM utilisateurs WHERE id = :id LIMIT 1');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createFromRow($row)
    {
        $this->id = $row['id'];
        $this->nom_utilisateur = $row['nom_utilisateur'];
        $this->email = $row['email'];
        $this->mot_de_passe = $row['mot_de_passe'];
        $this->premiere_connexion = $row['premiere_connexion'];
        $this->role = $row['role'];
    }

    public function saveRecommandation($userId, $coursId)
    {
        $db = Bdd::getInstance()->getConnection();
        $query = $db->prepare('INSERT INTO recommandations (utilisateur_id, cours_id) VALUES (:utilisateur_id, :cours_id)');
        $query->execute([
            'utilisateur_id' => $userId,
            'cours_id' => $coursId
        ]);
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'nom_utilisateur' => $this->getNomUtilisateur(),
            'email' => $this->getEmail(),
            'mot_de_passe' => $this->getMotDePasse(),
            'premiere_connexion' => $this->getPremiereConnexion(),
            'role' => $this->getRole(),
            'niveau' => $this->getNiveau()
        ];
    }

    public function updatePCO($userId)
    {
        $db = Bdd::getInstance()->getConnection();
        $query = $db->prepare('UPDATE utilisateurs SET premiere_connexion = 0 WHERE id = :id');
        $query->execute([
            'id' => $userId
        ]);
    }

    public function supprimerUtilisateur($id) {
        $sql = "DELETE FROM utilisateurs WHERE id = :id";
        $requete = Bdd::getInstance()->getConnection()->prepare($sql);
        $parameters = array(':id' => $id);
        $requete->execute($parameters);
    }

    public function addUtilisateur($nom, $email, $mdp, $role) {
        $query = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe, role) VALUES (:nom, :email, :mdp, :role)";
        $requete = Bdd::getInstance()->getConnection()->prepare($query);
        $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $requete->bindParam(':nom', $nom, PDO::PARAM_STR);
        $requete->bindParam(':email', $email, PDO::PARAM_STR);
        $requete->bindParam(':mdp', $hashed_mdp, PDO::PARAM_STR);
        $requete->bindParam(':role', $role, PDO::PARAM_STR);
        $requete->execute();
    }

    public function modifierUtilisateur($id, $nom_utilisateur, $email, $role) {
        $sql = "UPDATE utilisateurs SET nom_utilisateur = :nom_utilisateur, email = :email, role = :role WHERE id = :id";
        $stmt = Bdd::getInstance()->getConnection()->prepare($sql);

        // Associer les paramètres à la requête
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getUtilisateurs()
    {
        $query = "SELECT * FROM utilisateurs";
        $stmt = Bdd::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getId()
    {
        return $this->id;
    }

    public function getNomUtilisateur()
    {
        return $this->nom_utilisateur;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function getPremiereConnexion()
    {
        return $this->premiere_connexion;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getNiveau()
    {
        return $this->niveau;
    }

}
