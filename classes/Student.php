<?php
include_once 'Database.php';

class Student {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->conn;
    }
    
    public function getProfile($student_id) {  // used in Student_dashboard.php generate_certificate login 
        $sql = "SELECT s.*, u.Username, u.Email, u.Role, d.DepartmentName 
                FROM Student s
                JOIN User u ON s.student_id = u.UserId
                LEFT JOIN Department d ON s.Major = d.DepartmentId
                WHERE s.student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    public function getEnrolledCourses($student_id) {
        $sql = "SELECT c.course_id, c.course_name, c.description, c.CourseHours, 
                c.deadline, d.DepartmentName,
                u1.Username as primary_instructor_name,
                u2.Username as secondary_instructor_name,
                g.ExamScore, g.AssignmentScore, g.FinalGrade, g.GPA
                FROM courses c
                JOIN enrollments e ON c.course_id = e.course_id
                JOIN EnrollmentBatch eb ON e.batch_id = eb.batch_id
                LEFT JOIN Department d ON c.DepartmentId = d.DepartmentId
                LEFT JOIN Teacher t1 ON c.Primary_instructor_id = t1.TeacherId
                LEFT JOIN Teacher t2 ON c.Secondary_instructor_id = t2.TeacherId
                LEFT JOIN User u1 ON t1.TeacherId = u1.UserId
                LEFT JOIN User u2 ON t2.TeacherId = u2.UserId
                LEFT JOIN Grade g ON (g.CourseId = c.course_id AND g.StudentId = ?)
                WHERE eb.student_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $student_id, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $courses = [];
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
        return $courses;
    }

}