<?php
include ('lib/fpdf/fpdf.php');
session_start();

if (!isset($_SESSION['student_name']) || !isset($_GET['course'])) {
    die("Access denied.");
}

$student_name = $_SESSION['student_name'];
$course_name = htmlspecialchars($_GET['course']);
$issue_date = date("F d, Y");

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Title
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'Certificate of Completion', 0, 1, 'C');
$pdf->Ln(20);

// Student name
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(0, 10, "This is to certify that", 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, $student_name, 0, 1, 'C');

// Course name
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(0, 10, "has successfully completed the course", 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 10, $course_name, 0, 1, 'C');

// Date
$pdf->Ln(20);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Issued on: $issue_date", 0, 1, 'C');

// Output PDF
$pdf->Output('I', "Certificate_$student_name.pdf");
exit();
?>
