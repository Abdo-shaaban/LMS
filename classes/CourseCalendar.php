<?php
include_once 'Database.php';

class CourseCalendar {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getEventsByStudent($student_id) {
        $sql = "SELECT course_name, event_title, event_date, start_time, end_time, location
                FROM course_calendar
                WHERE student_id = ? AND event_date >= CURDATE()
                ORDER BY event_date, start_time";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
        return $events;
    }
}
?>
