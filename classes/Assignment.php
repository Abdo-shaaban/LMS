<?php
include_once 'Database.php';

class Assignment {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->conn;
    }
public function getAssignmentsByStudent($student_id) {
    $sql = "
        SELECT 
            a.AssignmentId, 
            a.TotalMarks, 
            c.course_name, 
            a.required_assignments,
            a.deadline
        FROM Assignment a
        JOIN courses c ON a.CourseId = c.course_id
        JOIN enrollments e ON e.course_id = c.course_id
        JOIN EnrollmentBatch eb ON eb.batch_id = e.batch_id
        JOIN Student s ON s.student_id = eb.student_id
        WHERE s.student_id = ?
    ";

    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        die("Prepare failed (assignments): " . $this->db->error);
    }

    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $assignments = [];
    while ($row = $result->fetch_assoc()) {
        $assignments[] = $row;
    }

    $stmt->close();
    return $assignments;
}

}
?>
