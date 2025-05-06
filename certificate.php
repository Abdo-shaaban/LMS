<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: dash.php");
    exit();
}

include_once 'classes/Certificate.php';

$student_id = $_SESSION['student_id'];
$course_id = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

$certificateObj = new Certificate();
$certificates = $certificateObj->getCertificate($student_id, $course_id);
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4">My Certificates</h2>
    <div class="row g-4">
        <?php if (empty($certificates)): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">You have no certificates available.</div>
            </div>
        <?php else: ?>
            <?php foreach ($certificates as $cert): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <h5 class="card-title"><?= htmlspecialchars($cert['course_name']) ?></h5>
                        <p class="card-text">Issued on: <?= date("M d, Y", strtotime($cert['issue_date'])) ?></p>
                        <a href="certificates/<?= htmlspecialchars($cert['certificate_file']) ?>" target="_blank" class="card-link btn btn-primary">View / Download</a>
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