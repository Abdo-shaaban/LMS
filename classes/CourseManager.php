<?php

class CourseManager {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->conn;
        $this->conn->set_charset("utf8mb4"); 
    }

    
    public function getAllCourses() {
        $query = "SELECT * FROM courses";
        $result = $this->conn->query($query);
        return $result;
    }

    
    public function getMaterialsByCourseId($courseId) {
        $stmt = $this->conn->prepare("SELECT * FROM course_materials WHERE course_id = ?");
        
        $stmt->bind_param("s", $courseId); 
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
