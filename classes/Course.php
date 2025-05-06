<?php
include_once 'Database.php';

class Course {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCourseMaterial($course_id) {
        $sql = "SELECT title, file_path FROM materials WHERE course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getCourseCalendar($course_id) {
        $sql = "SELECT deadline FROM courses WHERE course_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $course_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
