<?php 
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: dash.php");
    exit();
}

include_once 'classes/Database.php';
include_once 'classes/CourseCalendar.php';

$calendar = new CourseCalendar();
$deadlines = $calendar->getDeadlinesByStudent($_SESSION['student_id']);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Course Calendar (Enrollment Deadlines)</h2>

    <?php if (empty($deadlines)): ?>
        <div class="alert alert-info text-center">No deadlines found.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Course Name</th>
                        <th>Enrollment Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($deadlines as $deadline): ?>
                        <tr>
                            <td><?= htmlspecialchars($deadline['course_name']) ?></td>
                            <td><?= date("M d, Y", strtotime($deadline['deadline'])) ?></td>
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
