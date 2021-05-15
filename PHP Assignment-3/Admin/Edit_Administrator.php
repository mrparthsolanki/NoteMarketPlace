<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['admin_id_edit'])){
        $admin_id_edit = $_GET['admin_id_edit'];
        $select_admin_query = "SELECT * FROM users JOIN user_profile ON users.user_id=user_profile.profile_user_id WHERE user_id = $admin_id_edit";
        $select_admin_result = query($select_admin_query);
        confirmQuery($select_admin_result);
        
        $edit_admin_row = fetch_array($select_admin_result);
        $edited_admin_id = $edit_admin_row['user_id'];
        $admin_first_name = $edit_admin_row['user_first_name'];
        $admin_last_name = $edit_admin_row['user_last_name'];
        $admin_email = $edit_admin_row['user_email_id'];
        $admin_phone_code = $edit_admin_row['user_phone_country_code'];
        $admin_phone_no = $edit_admin_row['user_phone_number'];
        
            if(isset($_POST['edit_admin_submit'])){
                $super_admin_id = $_SESSION['user_id'];
                $first_name = $_POST['edit_admin_first_name'];
                $last_name = $_POST['edit_admin_last_name'];
                $email = $_POST['edit_admin_email'];
                $phone_code = "";
                if(isset($_POST['edit_admin_phone_code'])) {
                    $phone_code = $_POST['edit_admin_phone_code'];
                }

                $phone = $_POST['edit_admin_phone_no'];
            
                $edit_admin_query = "UPDATE users SET user_first_name='$first_name',user_last_name='$last_name',user_email_id='$email',modified_date=now(),modified_by=$super_admin_id,is_active=1 WHERE user_id = $admin_id_edit";
                
                $edit_admin_result = query($edit_admin_query);
                confirmQuery($edit_admin_result);
                
                $edit_user_profile_sql = "UPDATE user_profile SET user_phone_country_code='$phone_code',user_phone_number='$phone',modified_date=now(),modified_by = $super_admin_id WHERE profile_user_id = $admin_id_edit";
                $edit_user_profile_result = query($edit_user_profile_sql);
                confirmQuery($edit_user_profile_result);
                
                redirect("Manage-Administrator.php");
        
            }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section class="add-admin-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="add-admin-heading-bold">
                        <p>Add Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="add-admin-form-section">
        <div class="container">
            <form class="add-admin-form" action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="First Name">First Name *</label>
                            <input type="text" name="edit_admin_first_name" class="form-control" id="add-admin-first-name" placeholder="Enter your first name" pattern="[a-zA-Z]+" value="<?php echo $admin_first_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Last Name">Last Name *</label>
                            <input type="text" name="edit_admin_last_name" class="form-control" id="add-admin-last-name" placeholder="Enter your last name" pattern="[a-zA-Z]+['-]*[a-zA-Z]+" value="<?php echo $admin_last_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email *</label>
                            <input type="email" name="edit_admin_email" class="form-control" id="add-admin-email" placeholder="Enter your email address" value="<?php echo $admin_email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Phone Number">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="edit_admin_phone_code" id="add-admin-phone-no-code">
                                            <option value="" disabled selected>Code</option>
                                                
                                            <?php
                                                $country_query = "SELECT * FROM note_country WHERE is_active = 1";
                                                $country_result = query($country_query);
                                                confirmQuery($country_result);

                                                while($row1 = fetch_array($country_result)) {
                                                    $country_value = $row1['country_code'];
                                                    
                                                    if($admin_phone_code == $country_value) {
                                                        echo "<option value='{$country_value}' selected>{$country_value}</option>";
                                                    }
                                                    else {
                                                        echo "<option value='{$country_value}'>{$country_value}</option>";
                                                    }
                                                    
                                                }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="edit_admin_phone_no" class="form-control" id="add-admin-phone-number" placeholder="Enter your phone number" value="<?php echo $admin_phone_no; ?>" pattern="[1-9]{1}[0-9]{9}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="add-admin-submit-btn">
                            <button class="btn btn-gneral btn-purple" name="edit_admin_submit" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   
<?php
    }
else {
    redirect('Manageadministrator.php');
}
?>