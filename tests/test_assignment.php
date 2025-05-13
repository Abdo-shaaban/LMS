<?php
require_once '../classes/Database.php';
require_once '../classes/Assignment.php';

$db = Database::getInstance()->conn;

$query = "SELECT DISTINCT eb.student_id 
          FROM enrollments e
          JOIN EnrollmentBatch eb ON e.batch_id = eb.batch_id
          LIMIT 1";

$result = $db->query($query);

if ($row = $result->fetch_assoc()) {
    $student_id = $row['student_id'];

    $assignment = new Assignment();
    $assignments = $assignment->getAssignmentsByStudent($student_id);

    assert(is_array($assignments), "Expected assignments to be an array.");
    echo empty($assignments) 
        ? " No assignments found for student_id=$student_id (test still passed).\n" 
        : " Assignment test passed for student_id=$student_id.\n";
} else {
    echo " No student with enrollments found to test assignments.\n";
}
?>
