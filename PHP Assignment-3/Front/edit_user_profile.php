<?php  include "include/header.php"; ?>
<?php

if(isset($_SESSION['user_id']) and $_SESSION['user_role_id'] === '1') {
    $user_id = $_SESSION['user_id'];
    
    update_user_profile();
    
    $select_user_data_sql = "SELECT * FROM user_profile up JOIN users u ON up.profile_user_id=u.user_id WHERE profile_user_id = $user_id";
    $select_user_data_result = query($select_user_data_sql);
    confirmQuery($select_user_data_result);
    
    $user_row = fetch_array($select_user_data_result);
    
    $first_name = $user_row['user_first_name'];
    $last_name = $user_row['user_last_name'];
    $email = $user_row['user_email_id'];
    $dob = $user_row['user_dob'];
    $gender = $user_row['user_gender'];
    $phone_code = $user_row['user_phone_country_code'];
    $phone_number = $user_row['user_phone_number'];
    $address1 = $user_row['user_address_line1'];
    $address2 = $user_row['user_address_line2'];
    $city = $user_row['user_city'];
    $state = $user_row['user_state'];
    $zipcode = $user_row['user_zipcode'];
    $country = $user_row['user_country'];
    $university = $user_row['user_university'];
    $college = $user_row['user_college'];
    
    
?>
<?php include("page_header.php"); ?>
    
    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>


    <section id="userprofile-top-img">
        <img src="images/Search/banner-with-overlay.jpg" alt="Image" class="img-responsive">
        <div id="userprofile-top-content">
            <p>User profile</p>
        </div>
    </section>

    <section class="userprofile-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="userprofile-heading-bold">
                        <p>Basic Profile Details</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <form action="" method="post" enctype="multipart/form-data">
        <section id="userprofile-profile-form-section">
            <div class="container">
                <div class="userprofile-profile-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="First Name">First Name *</label>
                                <input type="text" name="first_name" class="form-control" id="user-first-name" value="<?php echo $first_name; ?>" pattern="[a-zA-Z]+" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Last Name">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" id="user-last-name" value="<?php echo $last_name; ?>" pattern="[a-zA-Z]+['-]*[a-zA-Z]+"  placeholder="Enter your last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email">Email *</label>
                                <input type="email" name="email" class="form-control" id="user-email" value="<?php echo $email; ?>" placeholder="Enter your email address" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Date of Birth">Date of Birth</label>
                                <input type="date" name="dob" class="form-control custome-date" id="user-DOB" placeholder="Enter your date of birth" autocomplete="off" value="<?php echo $dob; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Gender">Gender</label>
                                <select class="form-control" name="gender" id="user-gender" required>
                                    <option value="" disabled selected>Select your gender</option>
                                    <?php
                                        $query = "SELECT * FROM reference_data WHERE ref_category = 'gender' AND is_active = 1";
                                        $result = query($query);
                                        confirmQuery($result);
                                        
                                        while($row = fetch_array($result)) {
                                            $value = $row['reference_id'];
                                            $name = $row['value'];
                                            if($gender === $value) {
                                                echo "<option value='{$value}' style='text-transform:capitalize;' selected>{$name}</option>";
                                            }
                                            else {
                                                echo "<option value='{$value}' style='text-transform:capitalize;'>{$name}</option>";
                                            }
                                            
                                            
                                        }
                                        
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Phone Number">Phone Number</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="form-control" name="phone_code" id="user-phone-no-code" required>
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
                                        <input type="text" name="phone" class="form-control" id="user-phone-number" pattern="[1-9]{1}[0-9]{9}"  placeholder="Enter your phone number" value="<?php echo $phone_number; ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="Profile Picture">Profile Picture</label>    
    <!--                            <textarea class="form-control" id="user-profile-picture" rows="4" placeholder="Upload a Picture"></textarea>-->
                                <label class="custom-file-upload">
                                    <input type="file" name="profile_pic" id="edit_profile_pic_file"  onchange="return validate_edit_user_profile11_pic()"/>
                                    <img src="images/addnotes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                                </label>
                                <div id="edit_profile_pic_file-upload-filename"></div>
                            </div>
                        </div>
                    </div>

                </div>    
            </div>
        </section>

        <section class="userprofile-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="userprofile-heading-bold">
                            <p>Address Details</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="userprofile-address-form-section">
            <div class="container">
                <div class="userprofile-address-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Address Line 1">Address Line 1 *</label>
                                <input type="text" name="address1" class="form-control" id="user-address-line-1" placeholder="Enter your address" value="<?php echo $address1; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Address Line 2">Address Line 2</label>
                                <input type="text" name="address2" class="form-control" id="user-address-line-2" placeholder="Enter your address" value="<?php echo $address2; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="City">City *</label>
                                <input type="text" name="city" class="form-control" id="user-city" pattern="[a-zA-Z]+['-]*[a-zA-Z]+"  placeholder="Enter your city" value="<?php echo $city; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="State">State *</label>
                                <input type="text" name="state" class="form-control" id="user-state" pattern="[a-zA-Z]+" placeholder="Enter your state" value="<?php echo $state; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ZipCode">ZipCode *</label>
                                <input type="text" name="zipcode" class="form-control" id="user-zipcode" pattern="[1-9]{1}[0-9]{5}" placeholder="Enter your zipcode" value="<?php echo $zipcode; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <select class="form-control" name="country" id="user-country" required>
                                    <option value="" disabled selected>Select your country</option>
                                        
                                    <?php
                                        $country_query_2 = "SELECT * FROM note_country WHERE is_active = 1";
                                        $country_result_2 = query($country_query_2);
                                        confirmQuery($country_result_2);

                                        while($row2 = fetch_array($country_result_2)) {
                                            $country_name = $row2['country_name'];
                                            if($country === $country_name) {
                                                echo "<option value='{$country_name}' selected>{$country_name}</option>";
                                            }
                                            else {
                                                echo "<option value='{$country_name}'>{$country_name}</option>";
                                            }
                                            
                                        }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="userprofile-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="userprofile-heading-bold">
                            <p>University and College Information</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="userprofile-uni-info-form-section">
            <div class="container">
                <div class="userprofile-uni-info-details">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">University</label>
                                <input type="text" name="university" class="form-control" id="user-university" placeholder="Enter your university" value="<?php echo $university; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="College">College</label>
                                <input type="text" name="college" class="form-control" id="user-college" placeholder="Enter your college" value="<?php echo $college; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="userprofile-submit-btn">
                                <button type="submit" class="btn btn-gneral btn-purple" name="edit_user_profile_submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    
<?php include("page_footer.php"); ?>

<?php 
}
else {
    redirect('login.php');
}
?>