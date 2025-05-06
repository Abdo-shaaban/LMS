<?php
include_once 'Database.php';

class Evaluation {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function submitFeedback($student_id, $teacher_id, $comments, $ratings_json) {
        $sql = "INSERT INTO evaluations (student_id, teacher_id, comments, ratings)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iiss", $student_id, $teacher_id, $comments, $ratings_json);
        return $stmt->execute();
    }
}
?>
