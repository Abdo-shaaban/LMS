<?php
class Database {
    private static $instance = null; //singleton pattern
    
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "lms_database";
    public $conn;

    private function __construct() { // constructor must be private
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("DB Connection failed: " . $this->conn->connect_error);
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    } 
    //$db = Database::getInstance()->conn 
    //Prevents redundant DB connections
    //Global access from all modules
    //Improves efficiency and memory usage


    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape($string) {
        return $this->conn->real_escape_string($string);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }
}
?>
