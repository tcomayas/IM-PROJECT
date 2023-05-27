<?php
    class Config {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $db_name = "juan_rental";

        public $connection;

        public function __construct() {
            $this->connection = null;
            try {
                $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
        }

        public function getConnection() {
            return $this->connection;
        }
    }
?>
