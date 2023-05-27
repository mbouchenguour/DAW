<?php
    class Topics extends Model
    {
        public function getAllTopics()
        {
            $sql = "SELECT * FROM topics_forum";
            $query = Bdd::getInstance()->getConnection()->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }

