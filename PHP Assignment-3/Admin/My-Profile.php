<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    $the_admin_id = $_SESSION['user_id'];

    update_admin_profile();
    
    $select_admin_data_sql = "SELECT * FROM user_profile up JOIN users u ON up.profile_user_id=u.user_id WHERE profile_user_id = $the_admin_id";
    $select_admin_data_result = query($select_admin_data_sql);
    confirmQuery($select_admin_data_result);
    
    $admin_row = fetch_array($select_admin_data_result);

    $first_name = $admin_row['user_first_name'];
    $last_name = $admin_row['user_last_name'];
    $email = $admin_row['user_email_id'];
    $second_email = $admin_row['user_second_email_id'];
    $phone_code = $admin_row['user_phone_country_code'];
    $phone_number = $admin_row['user_phone_number'];
    
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section class="myprofile-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="myprofile-heading-bold">
                        <p>My Profile</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="myprofile-form-section">
        <div class="container">
            <form class="myprofile-form" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="First Name">First Name *</label>
                            <input type="text" name="admin_first_name" class="form-control" id="myprofile-first-name" placeholder="Enter your first name" value="<?php echo $first_name; ?>" pattern="[a-zA-Z]+" required>
                        </div>
                        <div class="form-group">
                            <label for="Last Name">Last Name *</label>
                            <input type="text" name="admin_last_name" class="form-control" id="myprofile-last-name" placeholder="Enter your last name" value="<?php echo $last_name; ?>" pattern="[a-zA-Z]+['-]*[a-zA-Z]+" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email *</label>
                            <input type="email" name="admin_email" class="form-control" id="myprofile-email" placeholder="Enter your email address" value="<?php echo $email; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Secondary Email">Secondary Email</label>
                            <input type="email" name="admin_second_email" class="form-control" id="myprofile-secondary-email" placeholder="Enter your secondary email" value="<?php echo $second_email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Phone Number">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="admin_phone_code" id="myprofile-phone-no-code">
                                            <option value="" disabled selected>Code</option>
                                                
                                            <?php
                                                $country_query = "SELECT * FROM note_country WHERE is_active = 1";
                                                $country_result = query($country_query);
                                                confirmQuery($country_result);

                                                while($row1 = fetch_array($country_result)) {
                                                    $country_value = $row1['country_code'];
                                                    if($phone_code === $country_value) {
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
                                    <input type="text" name="admin_phone" class="form-control" id="myprofile-phone-number" placeholder="Enter your phone number" pattern="[1-9]{1}[0-9]{9}" value="<?php echo $phone_number; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Profile Picture">Profile Picture</label>

                           <label class="custom-file-upload">
                                <input type="file" name="admin_profile_pic" id="myprofile-profile-picture"  onchange="return validate_edit_admin_profile_pic()"/>
                                <img src="images/addnotes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                            </label>
                            <div id="admin_edit_profile_file-upload-filename"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="myprofile-submit-btn">
                            <button type="submit" class="btn btn-gneral btn-purple" name="edit_admin_profile_submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include "Admin-page-footer.php"; ?> 