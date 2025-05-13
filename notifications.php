<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Student_dashboard.php");
    exit();
}
include_once 'classes/Notification.php'; 
// In your DB, notifications.user_id refers to User.UserId
$user_id = $_SESSION['user_id']; // student_id == UserId
$notificationObj = new Notification();
$notifications = $notificationObj->getNotifications($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Your Notifications</h2>
    <div class="row g-4">
        <?php if (empty($notifications)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center">You have no notifications at the moment.</div>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $note): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Notification</h5>
                            <p class="card-text"><?= htmlspecialchars($note['message']) ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            <small><?= date("M d, Y H:i", strtotime($note['created_at'])) ?></small>
                        </div>
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
