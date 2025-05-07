<?php
session_start();

// Check login
if (!isset($_SESSION['student_id'])) {
    header("Location: dash.php");
    exit();
}
 
// Include required files
include_once 'classes/Notification.php';
include_once 'classes/Student.php';

$student_id = $_SESSION['student_id'];
$notificationObj = new Notification();
$notifications = $notificationObj->getNotifications($student_id);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>

<body>
<div class="container mt-5">
    <h2 class="mb-4">Your Notifications</h2>
    <div class="row g-4">
        <?php if (empty($notifications)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">You have no notifications at the moment.</div>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $note): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <h5 class="card-title">Notification</h5>
                        <p class="card-text"><?= htmlspecialchars($note['message']) ?></p>
                        <small class="text-muted"><?= date("M d, Y H:i", strtotime($note['created_at'])) ?></small>
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
