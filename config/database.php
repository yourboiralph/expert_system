<?php
class Database {
    // Singleton Instance
    private static $instance = null;
    private $conn;

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "expert_system";

    // Singleton Constructor
    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Get the instance of the Database class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Get the database connection
    public function getConnection() {
        return $this->conn;
    }
}
?>