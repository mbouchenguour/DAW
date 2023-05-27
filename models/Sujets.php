<?php
    class Sujets extends Model
    {
        public function getSujetsByTopic($topic_id)
        {
            $sql = "SELECT * FROM sujets_forum WHERE topic_id = :topic_id";
            $query = Bdd::getInstance()->getConnection()->prepare($sql);
            $query->execute([':topic_id' => $topic_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addSujet($utilisateur_id, $topic_id, $titre)
        {
            $sql = "INSERT INTO sujets_forum (utilisateur_id, topic_id, titre, horodatage) VALUES (:utilisateur_id, :topic_id, :titre, NOW())";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $requete->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
            $requete->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
            $requete->bindParam(':titre', $titre, PDO::PARAM_STR);
            $requete->execute();

            return Bdd::getInstance()->getConnection()->lastInsertId();
        }



    }

