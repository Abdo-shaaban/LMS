<?php
class Feedback {
    private $conn;

    
    public function __construct() {
        $this->conn = Database::getInstance()->conn;
        $this->conn->set_charset("utf8mb4");  
    }

   
    public function submitFeedback($teacher_rating, $teacher_comments) {
        
        $teacher_comments = Database::getInstance()->escape($teacher_comments);

        
        $sql = $this->conn->prepare("INSERT INTO studentfeedback (teacher_rating, teacher_comments) VALUES (?, ?)");
        $sql->bind_param("is", $teacher_rating, $teacher_comments);
        
        
        if ($sql->execute()) {
            $sql->close();
            return '<div class="alert alert-success" role="alert">Thank you for your feedback on the teacher!</div>';
        } else {
            $error_message = $sql->error; 
            $sql->close();
            return '<div class="alert alert-danger" role="alert">Error submitting feedback. Please try again later.</div>';
        }
    }
}
?>
