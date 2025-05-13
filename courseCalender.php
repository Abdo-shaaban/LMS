<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include_once 'classes/Database.php';
include_once 'classes/Student.php';

$student_id = $_SESSION['user_id'];
$student = new Student();
$enrolledCourses = $student->getEnrolledCourses($student_id);

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Course Calendar (Enrollment Deadlines)</h2>
    <?php if (empty($enrolledCourses)): ?>
        <div class="alert alert-info text-center">No enrolled courses or deadlines found.</div>
    <?php else: ?>
        <div class="table-responsive"> 
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>Course Hours</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrolledCourses as $course): ?>
                        <tr>
                            <td><?= htmlspecialchars($course['course_name']) ?></td>
                            <td><?= htmlspecialchars($course['DepartmentName'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($course['CourseHours']) ?></td>
                            <td><?= date("M d, Y", strtotime($course['deadline'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php include_once 'includes/Footer.php';?>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JS Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
