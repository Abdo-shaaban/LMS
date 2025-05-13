<?php
include 'classes/Database.php';
include 'classes/ExamManager.php';

$course_id = $_GET['course_id'] ?? 0;
if ($course_id == 0) die("Invalid course ID");

$examManager = new ExamManager(Database::getInstance()->conn);

$course = $examManager->getCourseById(course_id: $course_id);
if (!$course) die("Course not found");

$exam = $examManager->getExamQuestions($course_id);

$score_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $result = $examManager->checkAnswers($_POST['answers']);
    $score_msg = "Your score: {$result['score']} / {$result['total']}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/head.php'; ?>
    <title><?= htmlspecialchars($course['course_name']) ?> | Exam</title>
</head>
<body>
<?php include_once 'includes/navbar.php'; ?>
<?php include_once 'includes/header.php'; ?>

<div class="container">
    <h1><?= htmlspecialchars($course['course_name']) ?> - Exam</h1>
    <p><?= htmlspecialchars($course['description']) ?></p>

    <?php if ($score_msg): ?>
        <p><strong><?= htmlspecialchars($score_msg) ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <?php while ($q = $exam->fetch_assoc()): ?>
            <div>
                <p><strong><?= htmlspecialchars($q['question']) ?></strong></p>
                <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="A"> <?= htmlspecialchars($q['option_a']) ?></label><br>
                <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="B"> <?= htmlspecialchars($q['option_b']) ?></label><br>
                <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="C"> <?= htmlspecialchars($q['option_c']) ?></label><br>
                <label><input type="radio" name="answers[<?= $q['id'] ?>]" value="D"> <?= htmlspecialchars($q['option_d']) ?></label>
            </div>
            <hr>
        <?php endwhile; ?>
        <button type="submit" class="btn btn-primary">Submit Exam</button>
    </form>
</div>

<?php include_once 'includes/Footer.php'; ?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
