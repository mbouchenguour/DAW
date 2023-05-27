<?php
    require_once 'Config.php';
    class Bdd
    {
        private static $instance = null;
        private $connection;

        private function __construct()
        {
            try {
                $this->connection = new PDO(
                    'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
                    DB_USER,
                    DB_PASS
                );
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new Bdd();
            }
            return self::$instance;
        }

        public function getConnection()
        {
            return $this->connection;
        }
    }
