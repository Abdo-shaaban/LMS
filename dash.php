<?php
session_start();

// Check if student is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit();
}

include_once 'classes/Database.php';
$db = new Database();

$student_id = $_SESSION['student_id'];

// Get student info
$sql = "SELECT * FROM students WHERE student_id = ?";
$stmt = $db->conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed (students): " . $db->conn->error);
}
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

// Get enrolled courses
$courses_sql = "SELECT * FROM courses WHERE student_id = ?";
$courses_stmt = $db->conn->prepare($courses_sql);
if (!$courses_stmt) {
    die("Prepare failed (courses): " . $db->conn->error);
}
$courses_stmt->bind_param("s", $student_id);
$courses_stmt->execute();
$courses_result = $courses_stmt->get_result();
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);
$courses_stmt->close();

// Get notifications
$notifications_sql = "SELECT * FROM notifications WHERE student_id = ? ORDER BY date DESC LIMIT 5";
$notifications_stmt = $db->conn->prepare($notifications_sql);
if (!$notifications_stmt) {
    die("Prepare failed (notifications): " . $db->conn->error);
}
$notifications_stmt->bind_param("s", $student_id);
$notifications_stmt->execute();
$notifications_result = $notifications_stmt->get_result();
$notifications = $notifications_result->fetch_all(MYSQLI_ASSOC);
$notifications_stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<link rel="stylesheet" href="css/style2.css">
<body>
<div class="container">
        <h2 class="page-title">Student Module</h2>
        <div class="card-container">
            <a href="view_courses.php" class="card-link2">
                <div class="card2">
                    <h3>View Courses</h3></a>
            
                </div>
            
            <a href="courseCalender.php" class="card-link2">
                <div class="card2">
                    <h3>View Course Calender</h3>
                </a>
                  
                </div>
            
            <a href="submit_feedback.php" class="card-link2">
                <div class="card2">
                    <h3>Evaluate Teacher</h3></a>
                    
                </div>
            
            <a href="view_results.php" class="card-link2">
                <div class="card2">
                    <h3>View Evaluation Results</h3></a>
                    
                </div>
            
            <a href="certificate.php" class="card-link2">
                <div class="card2">
                    <h3>View Certificate</h3></a>
                   
                </div>
            
            <a href="notifications.php" class="card-link2">
                <div class="card2">
                    <h3>Notifications</h3> </a>
                </div>
            
        </div>
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