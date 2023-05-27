<?php
    class Cours extends Model
    {
        public function getCours()
        {
            $query = "SELECT * FROM cours";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCoursUser($id)
        {
            $query = "SELECT cours.id, cours.titre, cours.description FROM cours INNER JOIN recommandations ON cours.id = recommandations.cours_id where utilisateur_id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCoursById($id)
        {
            $query = "SELECT * FROM cours where id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getCoursByIdChapitre($id_chapitre)
        {
            $query = "SELECT c.*
                  FROM cours c
                  JOIN chapitres ch ON c.id = ch.cours_id
                  WHERE ch.id = :id_chapitre";
            $stmt =  Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id_chapitre', $id_chapitre, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function addCours($titre, $description)
        {
            $sql = "INSERT INTO cours (titre, description) VALUES (:titre, :description)";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $requete->bindParam(':titre', $titre, PDO::PARAM_STR);
            $requete->bindParam(':description', $description, PDO::PARAM_STR);
            $requete->execute();
        }

        public function supprimerCours($id) {
            $sql = "DELETE FROM cours WHERE id = :id";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $parameters = array(':id' => $id);
            $requete->execute($parameters);
        }

        public function modifierCours($id, $titre, $description)
        {
            $sql = "UPDATE cours SET titre = :titre, description = :description WHERE id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();
        }

        

    }

