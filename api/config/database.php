<?php
    require_once 'config.php';

    class Database
    {
        // specify your own database credentials
        private $host = ENV_HOST;
        private $db_name = ENV_DB_NAME;
        private $username = ENV_USERNAME;
        private $password = ENV_PASSWD;
        public $conn;

        // get the database connection
        public function getConnection()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch (PDOException $exception) {
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }

    $database = new Database();

    $db = $database->getConnection();
?>
