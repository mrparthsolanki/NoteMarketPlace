<?php include "../Front/include/header.php"; ?>
<?php
    $admin_id = $_SESSION['user_id'];

    if(isset($_POST['reject_note'])) {
        
        $reject_note_id = $_POST['reject_note_value'];
        $note_remarks = escape($_POST['reject_remarks']);
        
        $status_sql = "SELECT `reference_id` FROM `reference_data` WHERE `ref_category`='note status' AND `value`='rejected'";
        $status_result = query($status_sql);
        confirmQuery($status_result);
        $status_row = fetch_array($status_result);
        
        $status_id = $status_row['reference_id'];
        
        $reject_note_sql = "UPDATE seller_notes SET note_status=$status_id,actioned_by=$admin_id,admin_remarks='{$note_remarks}', modified_date=now(), modified_by=$admin_id WHERE note_id=$reject_note_id";
        $reject_note_result = query($reject_note_sql);
        confirmQuery($reject_note_result);
        
    }
    
    if(isset($_POST['action'])) {
        
        $approve_note_id = $_POST['note_id'];
        
        $status_sql_2 = "SELECT `reference_id` FROM `reference_data` WHERE `ref_category`='note status' AND `value`='published'";
        $status_result_2 = query($status_sql_2);
        confirmQuery($status_result_2);
        $status_row_2 = fetch_array($status_result_2);
        
        $status_id_2 = $status_row_2['reference_id'];
        
        $approve_note_sql = "UPDATE seller_notes SET note_status=$status_id_2,actioned_by=$admin_id,note_published_date=now(),modified_date=now(), modified_by=$admin_id WHERE note_id=$approve_note_id";
        $approve_note_result = query($approve_note_sql);
        confirmQuery($approve_note_result);
    }
    
    if(isset($_POST['in_review_note_action'])) {    
        $inReview_note_id = $_POST['note_id'];
        
        $status_sql_3 = "SELECT `reference_id` FROM `reference_data` WHERE `ref_category`='note status' AND `value`='in review'";
        $status_result_3 = query($status_sql_3);
        confirmQuery($status_result_3);
        $status_row_3 = fetch_array($status_result_3);
        
        $status_id_3 = $status_row_3['reference_id'];
        
        $inReview_note_sql = "UPDATE seller_notes SET note_status=$status_id_3,actioned_by=$admin_id,modified_date=now(), modified_by=$admin_id WHERE note_id=$inReview_note_id";
        $inReview_note_result = query($inReview_note_sql);
        confirmQuery($inReview_note_result);
    }

     if(isset($_POST['unpublish_note'])) {
        
        $unpublish_note_id = $_POST['unpublish_note_value'];
        $note_remarks = $_POST['unpublish_remarks'];
        
        $status_sql_4 = "SELECT `reference_id` FROM `reference_data` WHERE `ref_category`='note status' AND `value`='removed'";
        $status_result_4 = query($status_sql_4);
        confirmQuery($status_result_4);
        $status_row_4 = fetch_array($status_result_4);
        
        $status_id_4 = $status_row_4['reference_id'];
        
        $unpublish_note_sql = "UPDATE seller_notes SET note_status=$status_id_4,actioned_by=$admin_id,admin_remarks='{$note_remarks}', modified_date=now(), modified_by=$admin_id WHERE note_id=$unpublish_note_id";
        $unpublish_note_result = query($unpublish_note_sql);
        confirmQuery($unpublish_note_result);
        
    }
?>