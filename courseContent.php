<?php
include 'classes/Database.php';
include 'classes/CourseManager.php';

$courseManager = new CourseManager(Database::getInstance()->conn);

$courses = $courseManager->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Course Materials</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
</head>
<body>
<?php include_once 'includes/navbar.php'; ?>
<?php include_once 'includes/header.php'; ?>

<div class="container mt-4">
    <h1>📚 All Course Materials & Exams</h1>

    <?php while($course = mysqli_fetch_assoc($courses)): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h3><?= $course['course_name'] ?></h3>
                <p><?= $course['description'] ?></p>

                <h5>Materials:</h5>
                <ul>
                <?php
                    $materials = $courseManager->getMaterialsByCourseId($course['course_id']);
                    while($m = mysqli_fetch_assoc($materials)):
                ?>
                    <li><a href="<?= $m['file_path'] ?>" download><?= $m['file_name'] ?></a></li>
                <?php endwhile; ?>
                </ul>

                <a href="exam.php?course_id=<?= $course['course_id'] ?>" class="btn btn-primary mt-2">Go to Exam</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include_once 'includes/Footer.php'; ?>  
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
