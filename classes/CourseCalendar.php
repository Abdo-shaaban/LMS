<?php
include_once 'Database.php';

class CourseCalendar {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getDeadlinesByStudent($student_id) {
        $sql = "SELECT course_name, deadline FROM course_calendar WHERE student_id = ?";
        $stmt = $this->db->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->db->conn->error);
        }

        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $deadlines = [];
        while ($row = $result->fetch_assoc()) {
            $deadlines[] = $row;
        }

        $stmt->close();
        return $deadlines;
    }
}
?>
