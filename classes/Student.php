<?php
include_once 'Database.php';

class Student {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getProfile($student_id) {
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getEnrolledCourses($student_id) {
        $sql = "SELECT c.course_id, c.title FROM courses c
                JOIN enrollments e ON c.course_id = e.course_id
                WHERE e.student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        return $courses;
    }

    public function requestAssistance($student_id, $course_id, $message) {
        $sql = "INSERT INTO assistance_requests (student_id, course_id, message)
                VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iis", $student_id, $course_id, $message);
        return $stmt->execute();
    }
}
?>
