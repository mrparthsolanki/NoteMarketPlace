<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    add_administrator();
    
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
                            <input type="text" name="add_admin_first_name" class="form-control" id="add-admin-first-name" placeholder="Enter your first name" pattern="[a-zA-Z]+" required>
                        </div>
                        <div class="form-group">
                            <label for="Last Name">Last Name *</label>
                            <input type="text" name="add_admin_last_name" class="form-control" id="add-admin-last-name" placeholder="Enter your last name" pattern="[a-zA-Z]+['-]*[a-zA-Z]+" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email *</label>
                            <input type="email" name="add_admin_email" class="form-control" id="add-admin-email" placeholder="Enter your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="Phone Number">Phone Number</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="add_admin_phone_code" id="add-admin-phone-no-code">
                                            <option value="" disabled selected>Code</option>
                                                
                                            <?php
                                                $country_query = "SELECT * FROM note_country WHERE is_active = 1";
                                                $country_result = query($country_query);
                                                confirmQuery($country_result);
    
                                                while($row1 = fetch_array($country_result)) {
                                                    $country_value = $row1['country_code'];
                                                    echo "<option value='{$country_value}'>{$country_value}</option>";
                                                }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="add_admin_phone_no" class="form-control" id="add-admin-phone-number" placeholder="Enter your phone number" pattern="[1-9]{1}[0-9]{9}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="add-admin-submit-btn">
                            <button class="btn btn-gneral btn-purple" name="add_admin_submit" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   