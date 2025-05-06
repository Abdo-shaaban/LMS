<?php
class CourseCalendar {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEventsByStudent($student_id) {
        $sql = "SELECT * FROM course_events WHERE student_id = ?"; // Make sure 'student_id' exists in your table!
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die("Prepare failed (CourseCalendar): " . $this->db->conn->error);
        }

        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $events = [];
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }

        $stmt->close();
        return $events;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; include_once 'includes/navbar.php'; include_once 'includes/header.php';?>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Course Calendar</h2>

    <?php if (empty($events)): ?>
        <div class="alert alert-info text-center">No upcoming events found.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Course</th>
                        <th>Event</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= date("M d, Y", strtotime($event['event_date'])) ?></td>
                            <td><?= date("H:i", strtotime($event['start_time'])) ?> - <?= date("H:i", strtotime($event['end_time'])) ?></td>
                            <td><?= htmlspecialchars($event['course_name']) ?></td>
                            <td><?= htmlspecialchars($event['event_title']) ?></td>
                            <td><?= htmlspecialchars($event['location']) ?></td>
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