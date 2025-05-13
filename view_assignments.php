<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include_once 'classes/Assignment.php';
$assignmentObj = new Assignment();
$assignments = $assignmentObj->getAssignmentsByStudent($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; ?>
<body>
<?php include_once 'includes/navbar.php'; ?>
<?php include_once 'includes/header.php'; ?><div class="container mt-5">
    <h2 class="mb-4">My Assignments</h2>

    <?php if (empty($assignments)): ?>
        <div class="alert alert-info text-center">No assignments found for your enrolled courses.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Assignment ID</th>
                        <th>Course Name</th>
                        <th>Total Marks</th>
                        <th>Required Assignments</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assignments as $a): ?>
                        <tr>
                            <td><?= htmlspecialchars($a['AssignmentId']) ?></td>
                            <td><?= htmlspecialchars($a['course_name']) ?></td>
                            <td><?= htmlspecialchars($a['TotalMarks']) ?></td>
                            <td><?= htmlspecialchars($a['required_assignments']) ?></td>
                            <td><?= date('d-m-Y', strtotime($a['deadline'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php include_once 'includes/Footer.php'; ?>

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
