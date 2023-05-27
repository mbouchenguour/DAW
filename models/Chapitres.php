<?php
    class Chapitres extends Model
    {
        public function getChapitresByCourse($id_cours)
        {
            $query = "SELECT * FROM chapitres where cours_id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id', $id_cours);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getChapitreById($id_chapitre)
        {
            $sql = 'SELECT * FROM chapitres WHERE id = :id_chapitre';
            $query = Bdd::getInstance()->getConnection()->prepare($sql);
            $query->execute([':id_chapitre' => $id_chapitre]);
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function addChapitre($cours_id, $titre, $type_fichier, $url_fichier)
        {
            // Insérer le nouveau chapitre dans la base de données
            $sql = 'INSERT INTO chapitres (cours_id, titre, type_fichier, url_fichier)
                    VALUES (:cours_id, :titre, :type_fichier, :url_fichier)';
            $stmt = Bdd::getInstance()->getConnection()->prepare($sql);
            $stmt->bindValue(':cours_id', $cours_id, PDO::PARAM_INT);
            $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindValue(':type_fichier', $type_fichier, PDO::PARAM_STR);
            $stmt->bindValue(':url_fichier', $url_fichier, PDO::PARAM_STR);
            $stmt->execute();
        }

        public function supprimerChapitre($id_chapitre) {
            $sql = "DELETE FROM chapitres WHERE id = :id_chapitre";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $parameters = array(':id_chapitre' => $id_chapitre);
            $requete->execute($parameters);
        }

        public function modifierChapitre($id, $titre, $type_fichier, $url_fichier) {
            $sql = "UPDATE chapitres SET titre = :titre, type_fichier = :type_fichier, url_fichier = :url_fichier WHERE id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':type_fichier', $type_fichier, PDO::PARAM_STR);
            $stmt->bindParam(':url_fichier', $url_fichier, PDO::PARAM_STR);

            $stmt->execute();
        }

        

    }

