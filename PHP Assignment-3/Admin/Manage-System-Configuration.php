<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    manage_sys_config();

    $select_msc_data_sql = "SELECT * FROM system_config";
    $select_msc_data_result = query($select_msc_data_sql);
    confirmQuery($select_msc_data_result);

    $results = array();
    while($row = fetch_array($select_msc_data_result)) {
        $results[$row['key']] = $row['value'];
    }
    

?>
    <!-- Admin Navigation -->
     
    
    <section class="msc-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="msc-heading-bold">
                        <p>Manage System Configuration</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="msc-form-section">
        <div class="container">
            <form class="msc-form" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Support emails address">Support emails address *</label>
                            <input type="email" name="msc_support_email" class="form-control" id="msc-support-email" placeholder="Enter support email address" value="<?php echo $results['SupportEmailAddress']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Support Phone number">Support Phone number *</label>
                            <input type="text" name="msc_support_phone" class="form-control" id="msc-phone-number" pattern="[1-9]{1}[0-9]{9}" placeholder="Enter phone number" value="<?php echo $results['SupportContactNumber']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email Address(es) (for various events system will send notifications to these users)*</label>
                            <input type="email" name="msc_email_addresses" class="form-control" id="msc-email-addresses" placeholder="Enter email address" value="<?php echo $results['EmailAddresssesForNotify']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Facebook URL">Facebook URL</label>
                            <input type="text" name="msc_facebook_url" class="form-control" id="msc-facebook-url" placeholder="Enter facebook url" value="<?php echo $results['FBICON']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Twitter URL">Twitter URL</label>
                            <input type="text" name="msc_twitter_url" class="form-control" id="msc-twitter-url" placeholder="Enter twitter url" value="<?php echo $results['TWITTERICON']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Linkedin URL">Linkedin URL</label>
                            <input type="text" name="msc_linkedin_url" class="form-control" id="msc-linkedin-url" placeholder="Enter linkedin url" value="<?php echo $results['LNICON']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="default note image">Default image for notes (if seller do not upload)</label>
<!--                            <textarea class="form-control" id="msc-default-note-img" rows="4" placeholder="Upload a Picture"></textarea>-->
                            <label class="custom-file-upload">
                                <input type="file" name="default_note_img" id="msc-default-note-img"  onchange="return validate_msc_note_pic()"/>
                                <img src="images/Add-notes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                            </label>
                            <div id="default_note_img_file-upload-filename"></div>
                        </div>
                        <div class="form-group">
                            <label for="default profile picture">Default profile picture (if seller do not upload)</label>
<!--                            <textarea class="form-control" id="msc-default-profile-picture" rows="4" placeholder="Upload a Picture"></textarea>-->
                            <label class="custom-file-upload">
                                <input type="file" name="default_profile_pic" id="msc-default-profile-picture"  onchange="return validate_msc_profile_pic()"/>
                                <img src="images/Add-notes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                            </label>
                            <div id="default_profile_pic_file-upload-filename"></div>   
                           
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="msc-submit-btn">
                            <button type="submit" class="btn btn-gneral btn-purple" name="msc_submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   