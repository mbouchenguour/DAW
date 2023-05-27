<?php
    class QCM extends Model
    {
        public function getQCMByIdCours($id_cours)
        {
            $query = "SELECT * FROM qcm WHERE id_cours = :id_cours";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id_cours', $id_cours);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getQCMById($id_qcm)
        {
            $query = "SELECT * FROM qcm WHERE id = :id_qcm";
            $stmt = Bdd::getInstance()->getConnection()->prepare($query);
            $stmt->bindParam(':id_qcm', $id_qcm);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addQCM($id_cours, $titre, $url)
        {
                $sql = 'INSERT INTO qcm (id_cours, titre, url)
                        VALUES (:id_cours, :titre, :url)';
                $stmt = Bdd::getInstance()->getConnection()->prepare($sql);
                $stmt->bindValue(':id_cours', $id_cours, PDO::PARAM_INT);
                $stmt->bindValue(':titre', $titre, PDO::PARAM_STR);
                $stmt->bindValue(':url', $url, PDO::PARAM_STR);
                $stmt->execute();
        }

        public function modifierQCM($id, $titre, $url)
        {
            $sql = "UPDATE qcm SET titre = :titre, url = :url WHERE id = :id";
            $stmt = Bdd::getInstance()->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->execute();
        }

        public function supprimerQCM($id)
        {
            $sql = "DELETE FROM qcm WHERE id = :id";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $parameters = array(':id' => $id);
            $requete->execute($parameters);
        }

        

    }

