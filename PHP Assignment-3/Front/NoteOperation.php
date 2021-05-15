<?php  include "include/header.php"; ?>

<?php
    $the_user_id = $_SESSION['user_id'];
    
    if(isset($_GET['download_note_id'])) {
        $download_id = $_GET['download_note_id'];
        
        $download_note_sql = "SELECT * FROM downloads WHERE download_id = $download_id";
        $download_note_result = query($download_note_sql);
        confirmQuery($download_note_result);
        
        $row = fetch_array($download_note_result);
        $download_path = $row['attachment_path'];
        $attachment_downloaded = $row['is_attachment_downloaded'];
            
        if($attachment_downloaded == 0) {
            echo $attachment_downloaded;
            $update_downloads_sql = "UPDATE downloads SET is_attachment_downloaded = 1 WHERE download_id = $download_id";
            $update_downloads_result = query($update_downloads_sql);
            confirmQuery($update_downloads_result);
        }
        
        download_attachment($download_path);
        
    }
    
    if(isset($_GET['allow_download_id']) && isset($_GET['allow_download_note_id'])) {
        $the_user_id = $_SESSION['user_id'];
        $allow_download_id = $_GET['allow_download_id'];
        $allow_download_note_id = $_GET['allow_download_note_id'];
        
        $get_attachment_path_sql = "SELECT * FROM seller_notes_attachment WHERE attachment_note_id = $allow_download_note_id";
        $get_attachment_path_result = query($get_attachment_path_sql);
        confirmQuery($get_attachment_path_result);
        
        $row = fetch_array($get_attachment_path_result);
        
        $attachment_path = $row['attached_file_path'];
        
        $allow_downloads_sql = "UPDATE downloads SET is_allowed_download = 1, attachment_path = '{$attachment_path}', modified_date = now(), modified_by = $the_user_id WHERE download_id = $allow_download_id";
        
        $allow_downloads_result = query($allow_downloads_sql);
        confirmQuery($allow_downloads_result);
        
        $buyerinfo_sql = "SELECT * FROM downloads d JOIN users u ON d.downloader=u.user_id WHERE d.download_id = {$allow_download_id}";
        $buyerinfo_result = query($buyerinfo_sql);
        confirmQuery($buyerinfo_result);
        $row_info = fetch_array($buyerinfo_result);
        $buyername = $row_info['user_first_name']." ".$row_info['user_last_name'];
        $buyer_email = $row_info['user_email_id'];
        
        $sellername = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
        
        
        $subject = "$sellername Allows you to download a note";
        $msg = "Hello $buyername,<br/><br/>
                We would like to inform you that, $sellername Allows you to download a note.<br/>
                Please login and see My Download tabs to download particular note.<br/><br/>
                Regards,<br/>
                Notes Marketplace";
        $headers = "From: notesmarketplace1@gmail.com";

        send_email($buyer_email, $subject, $msg, $headers);
        
        redirect("BuyerRequest-page.php");
        
    }
    if(isset($_GET['delete_inprogress_note'])) {
        
        $delete_note_id = $_GET['delete_inprogress_note'];
        $delete_attachments_path = "../Uploads/Members/{$the_user_id}/{$delete_note_id}";
        rmdir($delete_attachments_path);
        
        $delete_attachment_DB_sql = "DELETE FROM seller_notes_attachment WHERE attachment_note_id = $delete_note_id";
        $delete_attachment_DB_result = query($delete_attachment_DB_sql);
        confirmQuery($delete_attachment_DB_result);
        
        $delete_note_sql = "DELETE FROM seller_notes WHERE note_id = $delete_note_id";
        $delete_note_result = query($delete_note_sql);
        confirmQuery($delete_note_result);
        
        redirect("Dashboard.php");
        
    }

?>