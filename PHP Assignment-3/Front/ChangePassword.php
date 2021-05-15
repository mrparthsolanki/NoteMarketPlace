<?php  include "include/header.php"; ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
    change_password();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Change Password</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Costom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>
    <section id="change-password-bg-img">
        <div id="bg-img">
            <img src="images/pre-login/banner-with-overlay.jpg" class="img-resposive">
        </div>
    </section>
    <section id="change-password">
        <div id="content" class="container">
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-4 offset-md-4">
                    <!-- Logo -->
                    <div id="change-password-top-logo" class="text-center">
                        <img src="images/pre-login/top-logo.png" alt="Logo" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3">
                    <div id="change-password-box-white">
                        <div id="change-password-box-head" class="text-center">
                            <h3>Change Password</h3>
                            <p>Enter your new password to change your password</p>
                        </div>

                        <div id="change-password-form">
                            <form action="" onsubmit="return validate_change_pass()" method="post">
                                <div class="form-group">
                                    <label for="Old Password">Old Password</label>
                                    <input type="password" name="old_pass" class="form-control" id="change-pass-old-password" placeholder="Enter your old password">
                                    <span toggle="#password-field" class="field-icon toggle-password-old"><img src="images/pre-login/eye.png"></span>
                                </div>
                                <div class="form-group">
                                    <label for="New Password">New Password</label>
                                    <input type="password" name="new_pass" class="form-control" id="change-pass-new-password" placeholder="Enter your new password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,24}$">
                                    <span toggle="#password-field" class="field-icon toggle-password-new"><img src="images/pre-login/eye.png"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Confirm Password">Confirm Password</label>
                                    <input type="password" name="confirm_pass" class="form-control" id="change-pass-confirm-password" placeholder="Enter your confirm password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,24}$">
                                    <span toggle="#password-field" class="field-icon toggle-password-confirm"><img src="images/pre-login/eye.png"></span>
                                </div>
                                <div id="change-password-submit-btn">
                                    <button class="btn btn-gneral btn-purple" type="submit" name="change_pass_submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>