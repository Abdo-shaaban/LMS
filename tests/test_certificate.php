<?php
require_once '../classes/Database.php';
require_once '../classes/Certificate.php';

$db = Database::getInstance()->conn;
//Developmental (Unit) Testing white-box 

$query = "SELECT student_id, course_id FROM certificates LIMIT 1";
$result = $db->query($query);

if ($row = $result->fetch_assoc()) {
    $student_id = $row['student_id'];
    $course_id = $row['course_id'];

    $cert = new Certificate();
    $certificates = $cert->getCertificate($student_id, $course_id);

    assert(is_array($certificates), "Expected an array.");
    assert(!empty($certificates), "No certificate found for student_id=$student_id and course_id=$course_id.");

    echo " Certificate test passed for student_id=$student_id, course_id=$course_id.\n";
} else {
    echo " No data found in the certificates table to run the test.\n";
}
?>
