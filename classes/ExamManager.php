<?php
class ExamManager {
    private $conn;

    // Constructor to initialize the database connection using the Database singleton
    public function __construct() {
        $this->conn = Database::getInstance()->conn; // Get the connection from the Database class
    }

    // Method to get course details by course_id
    public function getCourseById($course_id) {
        $stmt = $this->conn->prepare("SELECT * FROM courses WHERE course_id = ?");
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Method to get exam questions for a specific course
    public function getExamQuestions($course_id) {
        $stmt = $this->conn->prepare("SELECT * FROM exams WHERE course_id = ?");
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Method to check student's answers against the correct ones
    public function checkAnswers($answers) {
        $score = 0;
        foreach ($answers as $qid => $ans) {
            $stmt = $this->conn->prepare("SELECT correct_option FROM exams WHERE id = ?");
            $stmt->bind_param("i", $qid);
            $stmt->execute();
            $correct = $stmt->get_result()->fetch_assoc();
            if ($correct && $correct['correct_option'] == $ans) {
                $score++;
            }
        }
        return ['score' => $score, 'total' => count($answers)];
    }
}
?>
