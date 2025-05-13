<?php
include_once 'Database.php';

class Notification {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->conn;
    }
    public function getNotifications($user_id) {
        $sql = "SELECT message, created_at FROM notifications
                WHERE user_id = ? ORDER BY created_at DESC";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            die("Prepare failed (notifications): " . $this->db->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $notes = [];
        while ($row = $result->fetch_assoc()) {
            $notes[] = $row;
        }

        $stmt->close();
        return $notes;
    }
}
?>
