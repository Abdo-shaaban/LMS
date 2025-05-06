<?php
include_once 'Database.php';

class Assignment {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAssignments($course_id) {
        $sql = "SELECT * FROM assignments WHERE course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function submitAssignment($student_id, $assignment_id, $file_path) {
        $sql = "INSERT INTO assignment_submissions (student_id, assignment_id, file_path)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $student_id, $assignment_id, $file_path);
        return $stmt->execute();
    }
}
?>
