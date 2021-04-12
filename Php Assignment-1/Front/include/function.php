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



    function register_user($first_name, $last_name, $email, $password) {
        $first_name   = escape($first_name);
        $last_name    = escape($last_name);
        $email        = escape($email);
        $password     = escape($password);
        
        
       
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        $quy = "INSERT INTO users (user_role_id, user_first_name, user_last_name, user_email_id, user_password)";
        $quy.= " VALUES(1,'{$first_name}','{$last_name}','{$email}','{$password}')";
        
        $result = query($quy);
        confirmQuery($result);
        
        $subject = "Note Market Place - Thank You For Signing";
        $msg = "Welcome To Our Website  " .$first_name. " ,<br/><br/>
            Please click on below link to verify your email address and to do login.<br/><br/>
            <a href='http://localhost/Project/parth/PHP Assignment-1/Front/EmailVerification.php?email={$email}&name={$first_name}'>Email verification link</a><br/><br/>
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
                        
                        $email = "18mca046@nirmauni.ac.in";
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
        
        
        






?>