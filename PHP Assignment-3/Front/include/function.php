<?php
    function clean($string){
        return htmlentities($string);
    }

    function redirect($location){
        return header("Location: {$location}");
    }
    
    function email_exists($email) {
        $email = escape($email);
        $email = clean($email);
        
        $query = "SELECT * FROM users WHERE user_email_id = '{$email}'";
        
        $result = query($query);
        
        if(row_count($result) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    function send_email($email, $subject, $msg, $headers) {
        
        require_once('sendmail.php');
        return (send_mail($email, $subject, $msg, $headers));
        
    }
    
     function password_generate() {
        
        $data_alphabets_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $data_alphabets_lower = 'abcefghijklmnopqrstuvwxyz';
        $data_digits = '1234567890';
        $data_symbols = '!@$%&?';
        
        $pass = substr(str_shuffle($data_alphabets_upper), 0, 1);
        $pass.= substr(str_shuffle($data_alphabets_lower), 0, 2);
        $pass.= substr(str_shuffle($data_digits), 0, 1);
        $pass.= substr(str_shuffle($data_symbols), 0, 1);
        
        return $pass;
        
    }



    function validate_user_registration(){
        
        if(isset($_POST['signup'])) {
            
            $first_name        =    clean($_POST['firstname']);
            $last_name         =    clean($_POST['lastname']);
            $email             =    clean($_POST['email']);
            $password          =    clean($_POST['password']);
            $confirm_password  =    clean($_POST['confirmpassword']);
            
            $email = strtolower($email);
            
            if(!email_exists($email)){
                
                if($password === $confirm_password){
                    if(register_user($first_name, $last_name, $email, $password)) {
                        
                        $_SESSION['registration_success'] = "Yes";
                    }
                    else {
                        echo "<script>alert('Registration is SucessFully.')</script>";
                    }
                }
                else{
                    echo "<script>alert('password and confirm password not matched')</script>";
                }
            }
            else {
                echo "<script>alert('email address already exists')</script>";
            }
            
        }
        
    }

     function download_attachment($download_path) {
        $path = $download_path;
        header("Content-Length: " . filesize ( $path ) ); 
        header("Content-type: application/pdf"); 
        header("Content-disposition: attachment; filename=".basename($path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        ob_clean();
        flush();
        readfile($path);
        exit();
    }

    function register_user($first_name, $last_name, $email, $password) {
        $first_name   = escape($first_name);
        $last_name    = escape($last_name);
        $email        = escape($email);
        $password     = escape($password);
        
        
       
       
        $quy = "INSERT INTO users (user_role_id, user_first_name, user_last_name, user_email_id, user_password)";
        $quy.= " VALUES(1,'{$first_name}','{$last_name}','{$email}','{$password}')";
        
        $result = query($quy);
        confirmQuery($result);
        
        $subject = "Note Market Place - Thank You For Signing";
        $msg = "Welcome To Our Website  " .$first_name. " ,<br/><br/>
            Please click on below link to verify your email address and to do login.<br/><br/>
            <a href='http://localhost/Akash/New Folder/PHP Assignment-3/Front/EmailVerification.php?email={$email}&name={$first_name}'>Email verification link</a><br/><br/>
            Regards,<br/>
            Parth R Solanki<br/>";
        $headers = "From: notemarketplace1946@gmail.com";
        
        if(send_email($email, $subject, $msg, $headers)) {
            return true;
        }
        else {
            return false;
        }
        
        
    }

    function update_user_profile() {
        if(isset($_POST['edit_user_profile_submit'])){
            
            $the_user_id = $_SESSION['user_id'];
            $firstname = escape($_POST['first_name']);
            $lastname = escape($_POST['last_name']);
            $email = escape($_POST['email']);
            $dob = escape($_POST['dob']);
            $phone_code = escape($_POST['phone_code']);
            $phone = escape($_POST['phone']);
            $gender = escape($_POST['gender']);
            $profile_pic = $_FILES['profile_pic']['name'];
            $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
            $address1 = escape($_POST['address1']);
            $address2 = escape($_POST['address2']);
            $country = escape($_POST['country']);
            $zipcode = escape($_POST['zipcode']);
            $city = escape($_POST['city']);
            $state = escape($_POST['state']);
            $university =  escape($_POST['university']);
            $college = escape($_POST['college']);
            
            $error_check = 1;
            
            $second_mail = "";
            
            $select_db_profile_sql = "SELECT * FROM user_profile WHERE profile_user_id = $the_user_id";
            $select_db_profile_result = query($select_db_profile_sql);
            confirmQuery($select_db_profile_result);
            
            $db_row = fetch_array($select_db_profile_result);
            $dp_picture = $db_row['user_profile_picture'];
            
            if(!empty($profile_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$profile_pic);
                $ext = pathinfo($profile_pic, PATHINFO_EXTENSION);
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    
                    if(!empty($dp_picture)) {
                        unlink($dp_picture);
                    }
                    
                    $profile_pic = "DP_". time() . "." . $ext;
                    $path = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file($profile_pic_tmp, "{$path}/{$profile_pic}");
                    $image_path_to_store = "{$path}/{$profile_pic}";
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
                
            }
            else {
               $image_path_to_store = $dp_picture; 
            }
            
            if($error_check === 1) {
                
                $update_user_name_sql = "UPDATE users SET user_first_name='{$firstname}',user_last_name='{$lastname}',modified_date=now(),modified_by=$the_user_id WHERE user_id = $the_user_id";
                $update_user_name_result = query($update_user_name_sql);
                confirmQuery($update_user_name_result);
                
                $update_query = "UPDATE user_profile SET user_dob='{$dob}', user_gender=$gender, user_second_email_id='{$second_mail}', user_phone_country_code='{$phone_code}', user_phone_number='{$phone}', user_profile_picture='{$image_path_to_store}', user_address_line1='{$address1}', user_address_line2='{$address2}', user_city='{$city}', user_state='{$state}', user_zipcode='{$zipcode}', user_country='{$country}', user_university='{$university}', user_college='{$college}', modified_date=now(), modified_by=$the_user_id WHERE profile_user_id = $the_user_id";

                $update_query_result = query($update_query);
                confirmQuery($update_query_result);

                echo "<script>alert('Your Profile Updated successfully.');window.location.href = 'Dashboard.php';</script>";
            }
            
        }
    }
       

    function forgot_password() {
        if(isset($_POST['forgot_pass_submit'])) {
            $email = $_POST['forgot_pass_email'];
            
            if(email_exists($email)) {
                
                $new_password = password_generate();
                
                
                $subject = "New Password has been created";
                $msg = "Hello,<br/><br/>
                        We have generated a new password for you<br/>
                        Password: {$new_password}<br/><br/>
                        Regards,<br/>
                        Parth R Solanki";
                $headers = "From: notemarketplace1946@gmail.com";

                send_email($email, $subject, $msg, $headers);
                
                $query = "SELECT * FROM users WHERE user_email_id = '{$email}'";
                $result = query($query);
                confirmQuery($result);
                    
               $new_password = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 12));
                if(row_count($result) == 1) {
                    
                    while($row = fetch_array($result)) {
                        $user_id = $row['user_id'];
                        $user_role_id = $row['user_role_id'];
                        $is_user_email_verified = $row['is_user_email_verified'];
                        $is_active = $row['is_active'];
                    }

                    if($is_active === '1' and $is_user_email_verified === '1') {
                        
                            $sql = "UPDATE users SET user_password = '{$new_password}' WHERE user_id = '{$user_id}'";
                            $result2 = query($sql);
                            confirmQuery($result2);
                        
                            echo "<script>alert('Your password has been changed successfully and new password is generated and sent on your registered email address.');window.location.href = 'login.php';</script>";
                        
                    }
                    else {
                        echo "<script>alert('You are not a member');</script>";
                    }

                }
                
                
                
            }
            else {
                echo "<script>alert('email address is incorrect');</script>";
            }
        }
    }
    


     function contact_us() {
        
        if(isset($_POST['contact-submit'])) {
            
            $fullname =  escape($_POST['contactus-fullname']);
            $mail_address = escape($_POST['contactus-email']);
            $subject = escape($_POST['contactus-subject']);
            $comments = escape($_POST['contactus-comments']);
            
            $comments = str_replace('\r\n', '<br/>', $comments);
            
            $subject_new = "{$fullname} - {$subject}";
            
            $msg = "Hello,<br/><br/>
                    {$comments}<br/><br/>
                    Regards,<br/>
                    {$fullname}<br/>";
            
            $headers = "From: notemarketplace1946@gmail.com";
            $email = "notemarketplace1946@gmail.com";
            
            if(send_email($email, $subject_new, $msg, $headers)) {
                echo "<script>alert('Thanks for contacting us.');</script>";
            }
            else {
                echo "<script>alert('Thanks for contacting us..');</script>";
            }
            
        }
        
    }

    function activate_user() {
        
        if(isset($_GET['email'])) {
            $email = clean($_GET['email']);
            
            $query = "SELECT * FROM users WHERE user_email_id = '{$email}'";
            $result = query($query);
            confirmQuery($result);

            if(row_count($result) == 1) {
                while($row = fetch_array($result)) {
                    $user_id = $row['user_id'];
                    $user_role_id = $row['user_role_id'];
                    $is_user_email_verified = $row['is_user_email_verified'];
                    $is_active = $row['is_active'];
                }
            
                if(isset($_POST['verify_email'])){
                    

                    if($is_active === '1'){
                        if($is_user_email_verified === '0'){
                            $sql = "UPDATE users SET is_user_email_verified = 1, modified_date = now(), modified_by = '{$user_id}' WHERE user_id = '{$user_id}'";
                            $result2 = query($sql);
                            confirmQuery($result2);
                            echo "<script>alert('Your email verification is Done please Login');window.location.href = 'login.php';</script>";
                        }
                        else {
                            echo "<script>alert('email address already verified');window.location.href = 'login.php';</script>";
                        }
                    }
                    else {
                        echo "<script>alert('Your email verification is Failed');window.location.href = 'login.php';</script>";
                    }
                    
                }
            }
            else {
                redirect("SignUp.php");
            }
        }
        else {
            redirect("SignUp.php");
        }
        
    }


     function check_profile($user_id) {
        $check_user_query = "SELECT * FROM user_profile WHERE profile_user_id = {$user_id}";
        $result = query($check_user_query);
        
        if(row_count($result) == 1) {
            return true;
        }
        else {
            return false;
        }
    }

     function insert_user_profile() {
        if(isset($_POST['user_profile_submit'])){
            
            $the_user_id = $_SESSION['user_id'];
            $firstname = escape($_POST['first_name']);
            $lastname = escape($_POST['last_name']);
            $email = escape($_POST['email']);
            $dob = escape($_POST['dob']);
            $phone_code = escape($_POST['phone_code']);
            $phone = escape($_POST['phone']);
            $gender = escape($_POST['gender']);
            $profile_pic = $_FILES['profile_pic']['name'];
            $profile_pic_tmp = $_FILES['profile_pic']['tmp_name'];
            $address1 = escape($_POST['address1']);
            $address2 = escape($_POST['address2']);
            $country = escape($_POST['country']);
            $zipcode = escape($_POST['zipcode']);
            $city = escape($_POST['city']);
            $state = escape($_POST['state']);
            $university =  escape($_POST['university']);
            $college = escape($_POST['college']);
            
            $error_check = 1;
            
            $second_mail = "";
            if(!empty($profile_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$profile_pic);
                $ext = pathinfo($profile_pic, PATHINFO_EXTENSION);
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    $profile_pic = "DP_". time() . "." . $ext;
                    $path = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file($profile_pic_tmp, "{$path}/{$profile_pic}");
                    $image_path_to_store = "{$path}/{$profile_pic}";
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
                
            }
            else {
               $image_path_to_store = ""; 
            }
            
            
            if($error_check === 1) {
                $query = "INSERT INTO user_profile (profile_user_id, user_dob, user_gender, user_second_email_id, user_phone_country_code, user_phone_number, user_profile_picture, user_address_line1, user_address_line2, user_city, user_state, user_zipcode, user_country, user_university, user_college, created_by, modified_by) ";
            
                $query.= "VALUES ('{$the_user_id}', '{$dob}', '{$gender}', '{$second_mail}', '{$phone_code}', '{$phone}', '{$image_path_to_store}', '{$address1}', '{$address2}', '{$city}', '{$state}', '{$zipcode}', '{$country}', '{$university}', '{$college}', '{$the_user_id}', '{$the_user_id}')";

                $result = query($query);
                confirmQuery($result);

                redirect("search.php");
            }
            
        }
    }

      function add_note() {
        
        if(isset($_POST['save']) or isset($_POST['publish'])) {
         
            $the_user_id = $_SESSION['user_id'];
            $title = $_POST['title'];
            $category = $_POST['category'];

            $note_display_pic = $_FILES['note_display_pic']['name'];
            $note_display_pic_tmp = $_FILES['note_display_pic']['tmp_name'];

            $note_pdf = $_FILES['note_pdf']['name'];
            $note_pdf_tmp = $_FILES['note_pdf']['tmp_name'];
            
            $type = $_POST['type'];
            $no_of_pages = $_POST['no_of_pages'];
            $description = escape($_POST['description']);
            $country = $_POST['country'];
            $institute = $_POST['institute'];
            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];
            $professor = $_POST['professor'];
            $sell_mode = $_POST['sell_mode'];
            

            $note_preview_pdf = $_FILES['note_preview_pdf']['name'];
            $note_preview_pdf_tmp = $_FILES['note_preview_pdf']['tmp_name'];
            
            $error_check = 1;
            
            if(isset($_POST['save'])) {
                $note_status = "draft";
                $status_id_query = "SELECT reference_id FROM reference_data WHERE ref_category = 'note status' AND value = '{$note_status}' AND is_active = '1'";
                $result_status_id = query($status_id_query);
                confirmQuery($result_status_id);
                while($row = fetch_array($result_status_id)) {
                    $note_status_id = $row['reference_id'];    
                }
                 

            }
            else {
                $note_status = "submitted for review";
                $status_id_query = "SELECT reference_id FROM reference_data WHERE ref_category = 'note status' AND value = '{$note_status}' AND is_active = '1'";
                $result_status_id = query($status_id_query);
                confirmQuery($result_status_id);
                while($row = fetch_array($result_status_id)) {
                    $note_status_id = $row['reference_id'];    
                }
            }
            
            
            if($sell_mode == "paid") {
                $sell_price = $_POST['sell_price'];
                $is_paid = 1;
            }
            else {
                $sell_price = 0;
                $is_paid = 0;
            }            
            
            

            if(!empty($note_pdf)){
                
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_pdf);
                $ext = pathinfo($note_pdf, PATHINFO_EXTENSION);
                
                if($ext === "pdf" || $ext === "PDF"){
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('only pdf files are allowed')</script>";
                }
                
            }
            
            if(!empty($note_display_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_display_pic);
                $ext = pathinfo($note_display_pic, PATHINFO_EXTENSION);
                
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
            }
            
            
            if(!empty($note_preview_pdf)){
                
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_preview_pdf);
                $ext = pathinfo($note_preview_pdf, PATHINFO_EXTENSION);
                
                if($ext === "pdf" || $ext === "PDF") {
                    $error_check =1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('only pdf files for preview are allowed')</script>";
                }
                
            }
            if($error_check === 1){
                
                $add_note_sql = "INSERT INTO seller_notes(seller_id, note_status, note_title,                              note_category, note_type, note_number_of_pages, note_description,                        note_university_name, note_country, note_course, note_course_code,                        note_professor, is_note_paid, note_price, created_by, modified_by) ";
                $add_note_sql.= "VALUES ($the_user_id, $note_status_id, '{$title}', $category, $type, '{$no_of_pages}', '{$description}', '{$institute}', $country, '{$course_name}', '{$course_code}', '{$professor}', $is_paid, '{$sell_price}', $the_user_id, $the_user_id)";

                $add_note_result = query($add_note_sql);
                confirmQuery($add_note_result);
                $the_note_id = last_inserted_id();
                
                if(!empty($note_pdf)){
                    $file_name_note_pdf = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_pdf);
                    $ext1 = pathinfo($note_pdf, PATHINFO_EXTENSION);
                    $note_pdf = "Attachment_". time() . "." . $ext1;
                    $attachement_path1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($attachement_path1)) {
                        mkdir($attachement_path1);
                    }
                    $attachement_path2 = "../Uploads/Members/{$the_user_id}/{$the_note_id}";
                    if(!is_dir($attachement_path2)) {
                        mkdir($attachement_path2);
                    }
                    $attachement_path = $attachement_path2."/Attachments";
                    if(!is_dir($attachement_path)) {
                        mkdir($attachement_path);
                    }
                    move_uploaded_file($note_pdf_tmp, "{$attachement_path}/{$note_pdf}");
                    $attachement_path_to_store = "{$attachement_path}/{$note_pdf}";
                }
                
                $note_attach_sql = "INSERT INTO seller_notes_attachment(attachment_note_id, attached_file_name, attached_file_path, created_by, modified_by) VALUES ('{$the_note_id}','{$note_pdf}','{$attachement_path_to_store}','{$the_user_id}','{$the_user_id}')";
                $note_attach_result = query($note_attach_sql);
                confirmQuery($note_attach_result);
                
                if(!empty($note_display_pic)) {
                    $file_name_note_display_pic = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_display_pic);
                    $ext2 = pathinfo($note_display_pic, PATHINFO_EXTENSION);
                    $note_display_pic = "DP_". time() . "." . $ext2;

                    $path1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($path1)) {
                        mkdir($path1);
                    }
                    $path2 = "../Uploads/Members/{$the_user_id}/{$the_note_id}";
                    if(!is_dir($path2)) {
                        mkdir($path2);
                    }
                    move_uploaded_file($note_display_pic_tmp, "{$path2}/{$note_display_pic}");
                    $note_displaypic_path_to_store = "{$path2}/{$note_display_pic}";
                }
                else {
                   $note_displaypic_path_to_store = ""; 
                }
                
                if(!empty($note_preview_pdf)){
                
                    $file_name_note_preview = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_preview_pdf);
                    $ext3 = pathinfo($note_preview_pdf, PATHINFO_EXTENSION);
                    $note_preview_pdf = "Preview_". time() . "." . $ext3;
                    $attachement_path_preview1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($attachement_path_preview1)) {
                        mkdir($attachement_path_preview1);
                    }
                    $attachement_path_preview = "../Uploads/Members/{$the_user_id}/{$the_note_id}";
                    if(!is_dir($attachement_path_preview)) {
                        mkdir($attachement_path_preview);
                    }
                    move_uploaded_file($note_preview_pdf_tmp, "{$attachement_path_preview}/{$note_preview_pdf}");
                    $preview_path_to_store = "{$attachement_path_preview}/{$note_preview_pdf}";
                }
                else {
                    $preview_path_to_store = ""; 
                }
                
                $add_note_preview_dp_sql = "UPDATE seller_notes SET note_display_picture = '{$note_displaypic_path_to_store}', note_preview = '{$preview_path_to_store}' WHERE note_id = '{$the_note_id}'";
                $add_note_preview_dp_result = query($add_note_preview_dp_sql);
                confirmQuery($add_note_preview_dp_result);
                
                if($check_note_status_for_mail === "submitted for review") {
                        
                        $email = "parthsolanki1295@gmail.com";
                        $sellername = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
                        $subject = "$sellername sent his note for review";
                        $msg = "Hello Admins,<br/><br/>
                                We want to inform you that, $sellername sent his note
                                $title for review.<br/>
                                Please look at the notes and take required actions.<br/><br/>
                                Regards,<br/>
                                Notes Marketplace";
                        $headers = "From: notemarketplace1946@gmail.com";

                        send_email($email, $subject, $msg, $headers);
                    
                }
                redirect('Dashboard.php');
                
            }
            
        
        }
    }
        
      function DownloadNote() {
        
        if(isset($_POST['download'])) {
            if(isset($_SESSION['user_id'])) {
                
                $note_id = $_POST['note_id'];
                $the_user_id = $_SESSION['user_id'];
//                $_SESSION['download_attachment'] = "true";
                
                $attachment_sql = "SELECT * FROM seller_notes sn JOIN seller_notes_attachment sna ON sn.note_id=sna.attachment_note_id JOIN note_category nc ON sn.note_category=nc.category_id JOIN users u ON sn.seller_id=u.user_id WHERE sn.note_id = '{$note_id}' AND sn.is_note_active = '1'";
                $attachment_result = query($attachment_sql);
                confirmQuery($attachment_result);
                
                $row = fetch_array($attachment_result);
                $seller_id = $row['seller_id'];
                $note_title = $row['note_title'];
                $note_sell_mode = $row['is_note_paid'];
                $note_price = $row['note_price'];
                $attachment_path = $row['attached_file_path'];
                $note_category_name = $row['category_name'];
                $seller_full_name = $row['user_first_name']." ".$row['user_last_name'];
                $seller_email = $row['user_email_id'];
                
                if($note_sell_mode == 0 or $the_user_id === $seller_id) {
                    
                    $check_already_downloaded_sql = "SELECT * FROM downloads WHERE downloaded_note_id = '{$note_id}' AND downloader = '{$the_user_id}'";
                    
                    $check_already_downloaded_result = query($check_already_downloaded_sql);
                    
                    if(row_count($check_already_downloaded_result) == 0) {
                        
                        $free_download_sql = "INSERT INTO downloads(downloaded_note_id, seller, downloader, is_allowed_download, attachment_path, is_attachment_downloaded, attachment_downloaded_date, is_note_paid, note_title, note_category, created_by, modified_by) VALUES ({$note_id}, {$seller_id}, {$the_user_id}, 1, '{$attachment_path}', 1, now(), {$note_sell_mode}, '{$note_title}', '{$note_category_name}', {$the_user_id}, {$the_user_id})";
                    
                        $free_download_result = query($free_download_sql);
                        confirmQuery($free_download_result);
                    
                    }
                    download_attachment($attachment_path);
                }
                else {
                    $check_already_downloaded_sql = "SELECT * FROM downloads WHERE downloaded_note_id = '{$note_id}' AND downloader = '{$the_user_id}'";
                    
                    $check_already_downloaded_result = query($check_already_downloaded_sql);
                    
                    if(row_count($check_already_downloaded_result) == 0) {
                    
                        $paid_download_sql = "INSERT INTO downloads(downloaded_note_id, seller, downloader, is_allowed_download, is_attachment_downloaded, attachment_downloaded_date, is_note_paid, purchased_price, note_title, note_category, created_by, modified_by) VALUES ({$note_id}, {$seller_id}, {$the_user_id}, 0, 0, now(), {$note_sell_mode}, '{$note_price}', '{$note_title}', '{$note_category_name}', {$the_user_id}, {$the_user_id})";

                        $paid_download_result = query($paid_download_sql);
                        confirmQuery($paid_download_result);
                        
                        $buyername = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
                        $subject = "$buyername wants to purchase your notes";
                        $msg = "Hello $seller_full_name,<br/><br/>
                                We would like to inform you that, $buyername wants to purchase your notes.<br/>
                                Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him.<br/><br/>
                                Regards,<br/>
                                Notes Marketplace";
                        $headers = "From: notesmarketplace1946@gmail.com";

                        send_email($seller_email, $subject, $msg, $headers);
                        
                    }
                    
                    echo "<script> $('#modal_seller_name').text('$seller_full_name'); </script>";
                    echo "<script> $('#thanksModal').modal('show'); </script>";
                    
                }                                        
                
            }
            else {
                echo "<script>if(confirm('Please sign in/register to download this note.')){window.location.href = 'login.php';}</script>";
            }
        }
        
    } 
        
        
    function edit_note() {
        
        if(isset($_POST['save']) or isset($_POST['publish'])) {
            $note_id = $_GET['edit_note_id'];
            $the_user_id = $_SESSION['user_id'];
            $title = $_POST['title'];
            $category = $_POST['category'];

            $note_display_pic = $_FILES['note_display_pic']['name'];
            $note_display_pic_tmp = $_FILES['note_display_pic']['tmp_name'];

            $note_pdf = $_FILES['note_pdf']['name'];
            $note_pdf_tmp = $_FILES['note_pdf']['tmp_name'];
            
            $type = $_POST['type'];
            $no_of_pages = $_POST['no_of_pages'];
            $description = escape($_POST['description']);
            $country = $_POST['country'];
            $institute = $_POST['institute'];
            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];
            $professor = $_POST['professor'];
            $sell_mode = $_POST['sell_mode'];
            

            $note_preview_pdf = $_FILES['note_preview_pdf']['name'];
            $note_preview_pdf_tmp = $_FILES['note_preview_pdf']['tmp_name'];
            
            $error_check = 1;
            $check_note_status_for_mail = "";
            
            if(isset($_POST['save'])) {
                $note_status = "draft";
                $status_id_query = "SELECT reference_id FROM reference_data WHERE ref_category = 'note status' AND value = '{$note_status}' AND is_active = '1'";
                $result_status_id = query($status_id_query);
                confirmQuery($result_status_id);
                while($row = fetch_array($result_status_id)) {
                    $note_status_id = $row['reference_id'];    
                }
                $check_note_status_for_mail = "draft";

            }
            else {
                $note_status = "submitted for review";
                $status_id_query = "SELECT reference_id FROM reference_data WHERE ref_category = 'note status' AND value = '{$note_status}' AND is_active = '1'";
                $result_status_id = query($status_id_query);
                confirmQuery($result_status_id);
                while($row = fetch_array($result_status_id)) {
                    $note_status_id = $row['reference_id'];    
                }
                $check_note_status_for_mail = "submitted for review";
            }
            
            
            if($sell_mode == "paid") {
                $sell_price = $_POST['sell_price'];
                $is_paid = 1;
            }
            else {
                $sell_price = 0;
                $is_paid = 0;
            }
            
            if(!empty($note_pdf)){
                
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_pdf);
                $ext = pathinfo($note_pdf, PATHINFO_EXTENSION);
                
                if($ext === "pdf" || $ext === "PDF"){
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('only pdf files are allowed')</script>";
                }
                
            }
            
            if(!empty($note_display_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_display_pic);
                $ext = pathinfo($note_display_pic, PATHINFO_EXTENSION);
                
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
            }
            
            
            if(!empty($note_preview_pdf)){
                
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_preview_pdf);
                $ext = pathinfo($note_preview_pdf, PATHINFO_EXTENSION);
                
                if($ext === "pdf" || $ext === "PDF") {
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('only pdf files for preview are allowed')</script>";
                }
                
            }
            if($error_check === 1){
                
                if(!empty($note_display_pic)) {
                    
                    $select_old_DP_sql = "SELECT * FROM seller_notes WHERE note_id = $note_id";
                    $select_old_DP_result = query($select_old_DP_sql);
                    confirmQuery($select_old_DP_result);
                    $row_DP = fetch_array($select_old_DP_result);
                    
                    $DP_path = $row_DP['note_display_picture'];
                    unlink($DP_path);
                    
                    $file_name_note_display_pic = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_display_pic);
                    $ext2 = pathinfo($note_display_pic, PATHINFO_EXTENSION);
                    $note_display_pic = "DP_". time() . "." . $ext2;

                    $path1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($path1)) {
                        mkdir($path1);
                    }
                    $path2 = "../Uploads/Members/{$the_user_id}/{$note_id}";
                    if(!is_dir($path2)) {
                        mkdir($path2);
                    }
                    move_uploaded_file($note_display_pic_tmp, "{$path2}/{$note_display_pic}");
                    $note_displaypic_path_to_store = "{$path2}/{$note_display_pic}";
                }
                else {
                    $select_old_DP_sql = "SELECT * FROM seller_notes WHERE note_id = $note_id";
                    $select_old_DP_result = query($select_old_DP_sql);
                    confirmQuery($select_old_DP_result);
                    $row_DP = fetch_array($select_old_DP_result);
                    
                    $note_displaypic_path_to_store = $row_DP['note_display_picture'];
                }
                
                if(!empty($note_preview_pdf)){
                    
                    $select_old_preview_sql = "SELECT * FROM seller_notes WHERE note_id = $note_id";
                    $select_old_preview_result = query($select_old_preview_sql);
                    confirmQuery($select_old_preview_result);
                    
                    $row_preview = fetch_array($select_old_preview_result);
                    
                    $preview_path = $row_preview['note_preview'];
                    unlink($preview_path);
                    
                    $file_name_note_preview = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_preview_pdf);
                    $ext3 = pathinfo($note_preview_pdf, PATHINFO_EXTENSION);
                    $note_preview_pdf = "Preview_". time() . "." . $ext3;
                    $attachement_path_preview1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($attachement_path_preview1)) {
                        mkdir($attachement_path_preview1);
                    }
                    $attachement_path_preview = "../Uploads/Members/{$the_user_id}/{$note_id}";
                    if(!is_dir($attachement_path_preview)) {
                        mkdir($attachement_path_preview);
                    }
                    move_uploaded_file($note_preview_pdf_tmp, "{$attachement_path_preview}/{$note_preview_pdf}");
                    $preview_path_to_store = "{$attachement_path_preview}/{$note_preview_pdf}";
                }
                else {
                    $select_old_preview_sql = "SELECT * FROM seller_notes WHERE note_id = $note_id";
                    $select_old_preview_result = query($select_old_preview_sql);
                    confirmQuery($select_old_preview_result);
                    
                    $row_preview = fetch_array($select_old_preview_result);
                    
                    $preview_path_to_store = $row_preview['note_preview'];
                }
                
                $update_note_sql = "UPDATE seller_notes SET note_status=$note_status_id,note_title='{$title}',note_category=$category,note_display_picture='{$note_displaypic_path_to_store}',note_type=$type,note_number_of_pages='{$no_of_pages}',note_description='{$description}',note_university_name='{$institute}',note_country=$country,note_course='{$course_name}',note_course_code='{$course_code}',note_professor='{$professor}',is_note_paid=$is_paid,note_price='{$sell_price}',note_preview='{$preview_path_to_store}',modified_date=now(),modified_by=$the_user_id WHERE note_id = $note_id";
                
                $update_note_result = query($update_note_sql);
                confirmQuery($update_note_result);
                
                if(!empty($note_pdf)) {
                    
                    $select_attachment_path_sql = "SELECT * FROM seller_notes_attachment WHERE attachment_note_id = $note_id";
                    $select_attachment_path_result = query($select_attachment_path_sql);
                    confirmQuery($select_attachment_path_result);
                    $row_path = fetch_array($select_attachment_path_result);
                    
                    $attachment_id = $row_path['attachment_id'];
                    $path = $row_path['attached_file_path'];    
                    unlink($path);
                    
                    $file_name_note_pdf = preg_replace('/\\.[^.\\s]{3,4}$/', '',$note_pdf);
                    $ext1 = pathinfo($note_pdf, PATHINFO_EXTENSION);
                    $note_pdf = "Attachment_". time() . "." . $ext1;
                    $attachement_path1 = "../Uploads/Members/{$the_user_id}";
                    if(!is_dir($attachement_path1)) {
                        mkdir($attachement_path1);
                    }
                    $attachement_path2 = "../Uploads/Members/{$the_user_id}/{$note_id}";
                    if(!is_dir($attachement_path2)) {
                        mkdir($attachement_path2);
                    }
                    $attachement_path = $attachement_path2."/Attachments";
                    if(!is_dir($attachement_path)) {
                        mkdir($attachement_path);
                    }
                    move_uploaded_file($note_pdf_tmp, "{$attachement_path}/{$note_pdf}");
                    $attachement_path_to_store = "{$attachement_path}/{$note_pdf}";
                    
                    $update_attachment_sql = "UPDATE seller_notes_attachment SET attached_file_name='{$note_pdf}',attached_file_path='{$attachement_path_to_store}',modified_date=now(),modified_by=$the_user_id WHERE attachment_id=$attachment_id";
                    $update_attachment_result = query($update_attachment_sql);
                    confirmQuery($update_attachment_result);
                    
                }
                
                if($check_note_status_for_mail === "submitted for review") {
                        
                        $email = "parthsolanki1295@gmail.com";
                        $sellername = $_SESSION['user_first_name']." ".$_SESSION['user_last_name'];
                        $subject = "$sellername sent his note for review";
                        $msg = "Hello Admin,<br/><br/>
                                We want to inform you that, $sellername sent his note
                                $title for review.<br/>
                                Please look at the notes and take required actions.<br/><br/>
                                Regards,<br/>
                                Parth R Solanki";
                        $headers = "From: notesmarketplace1946@gmail.com";

                        send_email($email, $subject, $msg, $headers);
                    
                }
                
                redirect('Dashboard.php');
            }
        }
    }

       function change_password() {
        
        if(isset($_POST['change_pass_submit'])) {
        
            $the_user_id = $_SESSION['user_id'];

            $select_user_pass_sql = "SELECT * FROM users WHERE user_id = $the_user_id";
            $select_user_pass_result = query($select_user_pass_sql);
            confirmQuery($select_user_pass_result);

            $row = fetch_array($select_user_pass_result);

            $db_pass = $row['user_password'];
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];

            if($new_pass === $confirm_pass) {
                
                
                
                $change_password_sql = "UPDATE users SET user_password = '{$new_pass}', modified_date = now(), modified_by = $the_user_id WHERE user_id = $the_user_id";
                $change_password_result = query($change_password_sql);
                confirmQuery($change_password_result);

                echo "<script>alert('Your Password has been changed successfully');window.location.href = 'login.php';</script>";
            }
            else {
                echo "<script>alert('please enter correct password')</script>";
            }
        }

    }  
        
      function add_administrator() {
        
        if(isset($_POST['add_admin_submit'])){
            $admin_id = $_SESSION['user_id'];
            $first_name = $_POST['add_admin_first_name'];
            $last_name = $_POST['add_admin_last_name'];
            $email = $_POST['add_admin_email'];
            $phone_code = "";
            if(isset($_POST['add_admin_phone_code'])) {
                $phone_code = $_POST['add_admin_phone_code'];
            }

            $phone = $_POST['add_admin_phone_no'];
            
            if(!email_exists($email)) {
                $new_password = password_generate();
                
                
                $subject = "Notes Marketplace Administrator Password";
                $msg = "Hello $first_name $last_name,<br/><br/>
                        You are now Admin in Notes Marketplace, Please Login to your account using Below password.<br/><br/>
                        Password: {$new_password}<br/><br/>
                        Regards,<br/>
                        Notes Marketplace";
                $headers = "From: notesmarketplace1946@gmail.com";
                
                send_email($email, $subject, $msg, $headers);
                
             
                
                $select_admin_role_sql = "SELECT role_id FROM user_roles WHERE role_name='admin'";
                $select_admin_role_result = query($select_admin_role_sql);
                confirmQuery($select_admin_role_result);
                $admin_role_row = fetch_array($select_admin_role_result);
                $admin_role_id = $admin_role_row['role_id'];

                $add_admin_query = "INSERT INTO users(user_role_id, user_first_name, user_last_name, user_email_id, user_password, is_user_email_verified, created_by, modified_by) VALUES ($admin_role_id, '$first_name', '$last_name', '$email', '$new_password', 1, $admin_id, $admin_id)";

                $add_admin_result = query($add_admin_query);
                confirmQuery($add_admin_result);
                $the_user_insert_id = last_inserted_id();

                $add_admin_query_2 = "INSERT INTO user_profile(profile_user_id, user_phone_country_code, user_phone_number, created_by, modified_by) VALUES ($the_user_insert_id, '$phone_code', '$phone', $admin_id, $admin_id)";

                $add_admin_result_2 = query($add_admin_query_2);
                confirmQuery($add_admin_result_2);
                

                redirect("Manage-Administrator.php");
            }
            else {
                echo "<script>alert('email address already exists.');</script>";
            }
            
            

        }
    }    
    
         
    function update_admin_profile() {
        if(isset($_POST['edit_admin_profile_submit'])){
            
            $the_admin_id = $_SESSION['user_id'];
            $firstname = escape($_POST['admin_first_name']);
            $lastname = escape($_POST['admin_last_name']);
            $email = escape($_POST['admin_email']);
            $second_email = escape($_POST['admin_second_email']);
            $phone_code = escape($_POST['admin_phone_code']);
            $phone = escape($_POST['admin_phone']);
            $admin_profile_pic = $_FILES['admin_profile_pic']['name'];
            $admin_profile_pic_tmp = $_FILES['admin_profile_pic']['tmp_name'];
            
            $error_check = 1;
            
            $select_db_profile_sql = "SELECT * FROM user_profile WHERE profile_user_id = $the_admin_id";
            $select_db_profile_result = query($select_db_profile_sql);
            confirmQuery($select_db_profile_result);
            
            $db_row = fetch_array($select_db_profile_result);
            $dp_picture = $db_row['user_profile_picture'];
            
            if(!empty($admin_profile_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$admin_profile_pic);
                $ext = pathinfo($admin_profile_pic, PATHINFO_EXTENSION);
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    
                    if(!empty($dp_picture)) {
                        unlink($dp_picture);
                    }
                    
                    $admin_profile_pic = "DP_". time() . "." . $ext;
                    $path = "../Uploads/Members/{$the_admin_id}";
                    if(!is_dir($path)) {
                        mkdir($path);
                    }
                    move_uploaded_file($admin_profile_pic_tmp, "{$path}/{$admin_profile_pic}");
                    $image_path_to_store = "{$path}/{$admin_profile_pic}";
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
                
            }
            else {
               $image_path_to_store = $dp_picture; 
            }
            
            if($error_check === 1) {
                
                $update_user_name_sql = "UPDATE users SET user_first_name='{$firstname}',user_last_name='{$lastname}',modified_date=now(),modified_by=$the_admin_id WHERE user_id = $the_admin_id";
                $update_user_name_result = query($update_user_name_sql);
                confirmQuery($update_user_name_result);
                
                $update_query = "UPDATE user_profile SET user_second_email_id='{$second_email}', user_phone_country_code='{$phone_code}', user_phone_number='{$phone}', user_profile_picture='{$image_path_to_store}', modified_date=now(), modified_by=$the_admin_id WHERE profile_user_id = $the_admin_id";

                $update_query_result = query($update_query);
                confirmQuery($update_query_result);

                echo "<script>alert('Your Profile Updated successfully.');window.location.href = 'Dashboard.php';</script>";
            }
            
        }
    } 



    function manage_sys_config() {
        if(isset($_POST['msc_submit'])) {
            
            $the_admin_id = $_SESSION['user_id'];
            $msc_support_email = escape($_POST['msc_support_email']);
            $msc_support_phone = escape($_POST['msc_support_phone']);
            $msc_email_addresses = escape($_POST['msc_email_addresses']);
            $msc_facebook_url = escape($_POST['msc_facebook_url']);
            $msc_twitter_url = escape($_POST['msc_twitter_url']);
            $msc_linkedin_url = escape($_POST['msc_linkedin_url']);
            
            $msc_note_img = $_FILES['default_note_img']['name'];
            $msc_note_img_tmp = $_FILES['default_note_img']['tmp_name'];
            
            $msc_profile_pic = $_FILES['default_profile_pic']['name'];
            $msc_profile_pic_tmp = $_FILES['default_profile_pic']['tmp_name'];
            
            $error_check = 1;
            
            if(!empty($msc_note_img)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$msc_note_img);
                $ext = pathinfo($msc_note_img, PATHINFO_EXTENSION);
            
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for note Default Picture')</script>";
                }
            }
            if(!empty($msc_profile_pic)) {
                $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '',$msc_profile_pic);
                $ext = pathinfo($msc_profile_pic, PATHINFO_EXTENSION);
                
                if( $ext === "jpg" || $ext === "JPG" ||$ext === "png" ||$ext === "PNG" ) {
                    $error_check = 1;
                }
                else {
                    $error_check = 0;
                    echo "<script>alert('file formate not supported for Display Picture')</script>";
                }
            }
            
            if($error_check === 1) {
                
                if(!empty($msc_note_img)) {
                    
                    $select_old_msc_note_img_sql = "SELECT `value` FROM `system_config` WHERE `key` = 'DefaultNoteDisplayPicture'";
                    $select_old_msc_note_img_result = query($select_old_msc_note_img_sql);
                    confirmQuery($select_old_msc_note_img_result);
                    $row_note_img = fetch_array($select_old_msc_note_img_result);
                    
                    $note_img_path = $row_note_img['value'];
                    unlink($note_img_path);
                    
                    $file_name_note_img = preg_replace('/\\.[^.\\s]{3,4}$/', '',$msc_note_img);
                    $ext2 = pathinfo($msc_note_img, PATHINFO_EXTENSION);
                    $msc_note_img = "Default_note_image" . "." . $ext2;

                    $path1 = "../Uploads/Admin/System_config";
                    if(!is_dir($path1)) {
                        mkdir($path1);
                    }
                    
                    move_uploaded_file($msc_note_img_tmp, "{$path1}/{$msc_note_img}");
                    $default_note_img_path_to_store = "{$path1}/{$msc_note_img}";
                }
                else {
                    $select_old_msc_note_img_sql = "SELECT `value` FROM `system_config` WHERE `key` = 'DefaultNoteDisplayPicture'";
                    $select_old_msc_note_img_result = query($select_old_msc_note_img_sql);
                    confirmQuery($select_old_msc_note_img_result);
                    $row_note_img = fetch_array($select_old_msc_note_img_result);
                    
                    $default_note_img_path_to_store = $row_note_img['value'];
                }
                
                if(!empty($msc_profile_pic)) {
                    
                    $select_old_default_profile_sql = "SELECT `value` FROM `system_config` WHERE `key` = 'DefaultMemberDisplayPicture'";
                    $select_old_default_profile_result = query($select_old_default_profile_sql);
                    confirmQuery($select_old_default_profile_result);
                    $row_old_profile = fetch_array($select_old_default_profile_result);
                    
                    $default_profile_path = $row_old_profile['value'];
                    unlink($default_profile_path);
                    
                    $file_name_profile_pic= preg_replace('/\\.[^.\\s]{3,4}$/', '',$msc_profile_pic);
                    $ext3 = pathinfo($msc_profile_pic, PATHINFO_EXTENSION);
                    $msc_profile_pic = "Default_Profile_picture" . "." . $ext3;

                    $path2 = "../Uploads/Admin/System_config";
                    if(!is_dir($path2)) {
                        mkdir($path2);
                    }
                    
                    move_uploaded_file($msc_profile_pic_tmp, "{$path2}/{$msc_profile_pic}");
                    $default_profile_pic_path_to_store = "{$path2}/{$msc_profile_pic}";
                }
                else {
                    $select_old_default_profile_sql = "SELECT `value` FROM `system_config` WHERE `key` = 'DefaultMemberDisplayPicture'";
                    $select_old_default_profile_result = query($select_old_default_profile_sql);
                    confirmQuery($select_old_default_profile_result);
                    $row_old_profile = fetch_array($select_old_default_profile_result);
                    
                    $default_profile_pic_path_to_store = $row_old_profile['value'];
                }
                
                $update_msc_data_sql_1 = "UPDATE system_config  SET `value`='$msc_support_email',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'SupportEmailAddress';";
                $update_msc_data_result_1 = query($update_msc_data_sql_1);
                confirmQuery($update_msc_data_result_1);
                
                $update_msc_data_sql_2 = "UPDATE system_config  SET `value`='$msc_support_phone',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'SupportContactNumber';";
                $update_msc_data_result_2 = query($update_msc_data_sql_2);
                confirmQuery($update_msc_data_result_2);
                
                $update_msc_data_sql_3 = "UPDATE system_config  SET `value`='$msc_email_addresses',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'EmailAddresssesForNotify';";
                $update_msc_data_result_3 = query($update_msc_data_sql_3);
                confirmQuery($update_msc_data_result_3);
                
                $update_msc_data_sql_4 = "UPDATE system_config  SET `value`='$default_note_img_path_to_store',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'DefaultNoteDisplayPicture';";
                $update_msc_data_result_4 = query($update_msc_data_sql_4);
                confirmQuery($update_msc_data_result_4);
                
                $update_msc_data_sql_5 = "UPDATE system_config  SET `value`='$default_profile_pic_path_to_store',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'DefaultMemberDisplayPicture';";
                $update_msc_data_result_5 = query($update_msc_data_sql_5);
                confirmQuery($update_msc_data_result_5);
                
                $update_msc_data_sql_6 = "UPDATE system_config  SET `value`='$msc_facebook_url',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'FBICON';";
                $update_msc_data_result_6 = query($update_msc_data_sql_6);
                confirmQuery($update_msc_data_result_6);
                
                $update_msc_data_sql_7 = "UPDATE system_config  SET `value`='$msc_twitter_url',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'TWITTERICON';";
                $update_msc_data_result_7 = query($update_msc_data_sql_7);
                confirmQuery($update_msc_data_result_7);
                
                $update_msc_data_sql_8 = "UPDATE system_config  SET `value`='$msc_linkedin_url',modified_date=now(),modified_by=$the_admin_id WHERE `key` = 'LNICON';";
                $update_msc_data_result_8 = query($update_msc_data_sql_8);
                confirmQuery($update_msc_data_result_8);
                
                
                echo "<script>alert('Data Inserted Successfully.');window.location.href = 'Dashboard-admin.php';</script>";
            }
        }
    }


?>