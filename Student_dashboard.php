<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include and get singleton DB connection
include_once 'classes/Database.php';
$db = Database::getInstance()->conn;
include_once 'classes/Student.php';
$student_obj = new Student();

$student_id = $_SESSION['user_id'];

$student = $student_obj->getProfile($student_id);
?>


<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<link rel="stylesheet" href="css/style2.css">
<body>
<div class="container">
        <h2 class="page-title">Student Module</h2>
        <div class="card-container">
            <a href="viewcourses.php" class="card-link2">
                <div class="card2">
                    <h3>View Courses</h3></a>
                </div>
            <a href="courseContent.php" class="card-link2">
                <div class="card2">
                    <h3>Access Course Content</h3></a>                   
                </div>      
                <a href="courseCalender.php" class="card-link2">
                <div class="card2">
                    <h3>View Courses Calender</h3>
                </a>                 
                </div>                           
            <a href="view_assignments.php" class="card-link2">
                <div class="card2">
                    <h3>View Assignments</h3></a>
                    
                </div>
                        <a href="notifications.php" class="card-link2">
                <div class="card2">
                    <h3>Notifications</h3> </a>
                </div>
            <a href="certificate.php" class="card-link2">
                <div class="card2">
                    <h3>View Certificate</h3></a>                   
                </div>          
            <a href="feedback.php" class="card-link2">
                <div class="card2">
                    <h3>Feedback</h3></a>                    
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