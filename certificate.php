<?php
session_start();
include_once 'classes/Student.php';
include_once 'classes/Certificate.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$student_id = $_SESSION['user_id'];

$certificate = new Certificate();
$certificates = $certificate->getAllCertificatesForStudent($student_id);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">My Certificates</h2>
    <div class="row g-4">
        <?php if (empty($certificates)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">You have no certificates available.</div>
            </div>
        <?php else: ?>
            <?php foreach ($certificates as $cert): ?>
    <div class="col-md-6 col-lg-4">
        <div class="card3 p-3 border rounded shadow-sm text-center">
            <h5 class="card-title3 mb-2">Course: <?= htmlspecialchars($cert['course_id']) ?></h5>
            <p class="card-text3">Issued on: <?= date("M d, Y", strtotime($cert['issue_date'])) ?></p>
            <p class="card-text3">Grade: <?= htmlspecialchars($cert['grade']) ?></p>
            <p class="card-text3">GPA: <?= htmlspecialchars($cert['gpa']) ?></p>
            <a href="generate_certificate.php?course_id=<?= urlencode($cert['course_id']) ?>" target="_blank" class="btn btn-success">Download PDF</a>

        </div>
    </div>
<?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once 'includes/Footer.php';?>
   <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
