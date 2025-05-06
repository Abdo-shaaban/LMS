<?php
include_once 'Database.php';

class Certificate {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCertificate($student_id, $course_id) {
        $sql = "SELECT * FROM certificates WHERE student_id = ? AND course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $student_id, $course_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function issueCertificate($student_id, $course_id, $path) {
        $sql = "INSERT INTO certificates (student_id, course_id, file_path)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $student_id, $course_id, $path);
        return $stmt->execute();
    }
}
?>
