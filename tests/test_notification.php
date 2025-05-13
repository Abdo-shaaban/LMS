<?php
require_once '../classes/Database.php';
require_once '../classes/Notification.php';

$db = Database::getInstance()->conn;

$query = "SELECT user_id FROM notifications LIMIT 1";
$result = $db->query($query);

if ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];

    $note = new Notification();
    $notifications = $note->getNotifications($user_id);

    assert(is_array($notifications), "Expected notifications to be an array.");
    echo empty($notifications) 
        ? " No notifications found for user_id=$user_id (test still passed).\n" 
        : " Notification test passed for user_id=$user_id.\n";
} else {
    echo " No data in the notifications table to test.\n";
}
?>
