<?php
    class Messages extends Model
    {
        public function getMessagesBySujet($sujet_id)
        {
            $connexion = Bdd::getInstance()->getConnection();
            $requete = "SELECT messages_forum.*, utilisateurs.nom_utilisateur, sujets_forum.topic_id
                        FROM messages_forum
                        INNER JOIN utilisateurs ON messages_forum.utilisateur_id = utilisateurs.id
                        INNER JOIN sujets_forum ON messages_forum.sujet_id = sujets_forum.id
                        WHERE messages_forum.sujet_id = :sujet_id";
            $stmt = $connexion->prepare($requete);
            $stmt->bindParam(':sujet_id', $sujet_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addMessage($utilisateur_id, $sujet_id, $message)
        {
            $sql = "INSERT INTO messages_forum (utilisateur_id, sujet_id, message, horodatage) VALUES (:utilisateur_id, :sujet_id, :message, NOW())";
            $requete = Bdd::getInstance()->getConnection()->prepare($sql);
            $requete->bindParam(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
            $requete->bindParam(':sujet_id', $sujet_id, PDO::PARAM_INT);
            $requete->bindParam(':message', $message, PDO::PARAM_STR);
            $requete->execute();
        }

    }

