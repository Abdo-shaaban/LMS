<?php
include_once 'Database.php';

class Exam {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getExam($course_id) {
        $sql = "SELECT * FROM exams WHERE course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function submitAnswers($student_id, $exam_id, $answers_json) {
        $sql = "INSERT INTO exam_submissions (student_id, exam_id, answers)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $student_id, $exam_id, $answers_json);
        return $stmt->execute();
    }
}
?>
