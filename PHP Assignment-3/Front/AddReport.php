<?php  include "include/header.php"; ?>
<?php
    if(!empty($_POST)) {
        $download_id = $_POST['report_note_download_id'];
        $remark = escape($_POST['report_remark']);
        
        $note_report_sql = "SELECT * FROM downloads d JOIN users u ON d.seller=u.user_id WHERE download_id = $download_id";
        $note_report_result = query($note_report_sql);
        confirmQuery($note_report_result);
        $row = fetch_array($note_report_result);
        
        $report_note_id = $row['downloaded_note_id'];
        $reported_by_id = $_SESSION['user_id'];
        $reported_by_name = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
        $note_title = $row['note_title'];
        $seller_name = $row['user_first_name']." ".$row['user_last_name'];
        
        $check_already_reported_sql = "SELECT * FROM reported_note WHERE reported_note_id = $report_note_id AND reported_by_id = $reported_by_id";
        
        $check_already_reported_result = query($check_already_reported_sql);
        
        if(row_count($check_already_reported_result) == 0) {
            $insert_report_sql = "INSERT INTO reported_note(reported_note_id, reported_by_id, against_download_id, report_remarks, created_by, modified_by) VALUES ($report_note_id, $reported_by_id, $download_id, '{$remark}', $reported_by_id, $reported_by_id)";
            
            $insert_report_result = query($insert_report_sql);
            confirmQuery($insert_report_result);
            
            $subject = "$reported_by_name Reported an issue for $note_title";
            $msg = "Hello Admins,<br/><br/>
                    We want to inform you that, $reported_by_name Reported an issue for $seller_name"."’s Note with title $note_title.<br/>
                    Please look at the notes and take required actions.<br/><br/>
                    Regards,<br/>
                    Notes Marketplace";
            $headers = "From: notesmarketplace1946@gmail.com";
            
            $select_admin_email_sql = "SELECT * FROM system_config";
            $select_admin_email_result = query($select_admin_email_sql);
            confirmQuery($select_admin_email_result);
            $results_email = array();
            while($admin_email_row = fetch_array($select_admin_email_result)) {
                $results_email[$admin_email_row['key']] = $admin_email_row['value'];
            }
            $email = $results_email['EmailAddresssesForNotify'];
            
            send_email($email, $subject, $msg, $headers);
            
        }
        
    }
?>