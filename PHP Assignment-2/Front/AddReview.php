<?php  include "include/header.php"; ?>
<?php
    if(!empty($_POST)) {
        
        $download_id = $_POST['review_download_id'];
        $comments = escape($_POST['review_comment']);
        $rating = $_POST['rate'];
        
        $note_review_sql = "SELECT * FROM downloads WHERE download_id = $download_id";
        $note_review_result = query($note_review_sql);
        confirmQuery($note_review_result);
        $row = fetch_array($note_review_result);
        
        $review_note_id = $row['downloaded_note_id'];
        $reviewer_id = $_SESSION['user_id'];
        
        $check_already_reviewed_sql = "SELECT * FROM note_reviews WHERE review_note_id = $review_note_id AND reviewer_id = $reviewer_id";
        $check_already_reviewed_result = query($check_already_reviewed_sql);
        
        if(row_count($check_already_reviewed_result) == 0) {
            
            $inser_review_sql = "INSERT INTO note_reviews(review_note_id, reviewer_id, against_downloads_id, review_rating, review_comment, created_by, modified_by) VALUES ($review_note_id, $reviewer_id, $download_id, $rating, '{$comments}', $reviewer_id, $reviewer_id)";
            $inser_review_result = query($inser_review_sql);
            confirmQuery($inser_review_result);
            
        }
        
        
    }
?>