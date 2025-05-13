<?php
include_once 'Database.php';

class Certificate {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->conn;
    }

    public function getCertificate($student_id, $course_id) {
        $sql = "SELECT * FROM certificates WHERE student_id = ? AND course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $student_id, $course_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $certificates = [];
        while ($row = $result->fetch_assoc()) {
            $certificates[] = $row;
        }
        return $certificates;
    }

    public function getAllCertificatesForStudent($student_id) {
        $sql = "SELECT c.*, co.course_name 
                FROM certificates c 
                JOIN courses co ON c.course_id = co.course_id
                WHERE c.student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $certificates = [];
        while ($row = $result->fetch_assoc()) {
            $certificates[] = $row;
        }
        return $certificates;
    }
}
