<?php
include_once 'Database.php';

class Notification {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getNotifications($student_id) {
        $sql = "SELECT message, created_at FROM notifications
                WHERE student_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $notes = [];
        while ($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }
        return $notes;
    }
}
?>
