<?php
ob_start(); // Start output buffering
session_start();
require('lib/fpdf/fpdf.php');
include_once 'classes/Student.php';
include_once 'classes/Certificate.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

$student_id = $_SESSION['user_id'];

// Get course_id from URL
if (!isset($_GET['course_id'])) {
    die("Course ID is required.");
}
$course_id = $_GET['course_id'];

$student = new Student();
$certificate = new Certificate();

// Get student profile
$profile = $student->getProfile($student_id);
if (!$profile) {
    die("Student not found.");
}

// Get enrolled courses
$courses = $student->getEnrolledCourses($student_id);
$course = null;
foreach ($courses as $c) {
    if ($c['course_id'] == $course_id) {
        $course = $c;
        break;
    }
}
if (!$course) {
    die("You are not enrolled in this course.");
}

// Get certificate info
$certInfo = $certificate->getCertificate($student_id, $course_id);
if (!$certInfo || count($certInfo) == 0) {
    die("Certificate not found.");
}
$cert = $certInfo[0];

// Create the certificate using FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Set styles
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 20, 'Certificate of Completion', 0, 1, 'C');

$pdf->SetFont('Arial', '', 14);
$pdf->Ln(10);
$pdf->MultiCell(0, 10, "This certifies that " . $profile['student_id'] . " has successfully completed the course '" . $course['course_name'] . "' with the following results:", 0, 'C');

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Final Grade: ' . $cert['grade'], 0, 1, 'C');
$pdf->Cell(0, 10, 'GPA: ' . $cert['gpa'], 0, 1, 'C');
$pdf->Ln(20);
$pdf->Cell(0, 10, 'Issued on: ' . $cert['issue_date'], 0, 1, 'C');

// Optional: Add logos or signature line
$pdf->Ln(20);
$pdf->Cell(0, 10, 'Authorized Signature: ____________________', 0, 1, 'C');

$pdf->Output('I', 'Certificate_' . $course['course_name'] . '.pdf');
