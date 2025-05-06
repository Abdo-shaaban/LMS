<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "lms_database";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("DB Connection failed: " . $this->conn->connect_error);
        }
    }

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
