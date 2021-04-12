<?php include "include/header.php"; ?>

<?php

if(isset($_POST['signup'])) {
    
    $first_name = trim($_POST['firstname']);
}
    validate_user_registration();
    
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>SignUp</title>

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
    <section id="signup-bg-img">
        <div id="bg-img">
            <img src="images/pre-login/banner-with-overlay.jpg" class="img-resposive">
        </div>
    </section>
    <section id="signup">
        <div id="content" class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-4 offset-md-4">
                    <!-- Logo -->
                    <div id="signup-top-logo" class="text-center">
                        <img src="images/pre-login/top-logo.png" alt="Logo" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3">
                    <div id="signup-box-white">
                          <div id="signup-box-head" class="text-center">
                            <h3>Create an Account</h3>
                            <p>Enter your details to signup</p>
                            
                        </div>

                        <div id="signup-form">
                            <form action="" method="post">
                               <div class="form-group">
                                    <label for="First Name">First Name *</label>
                                    <input type="text" name="firstname" class="form-control" id="signup-first-name" placeholder="Enter your first name" pattern="[a-zA-Z]+" required
                                    value="<?php echo isset($first_name) ? $first_name : '' ?>"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="Last Name">Last Name *</label>
                                    <input type="text"  name="lastname" class="form-control" id="signup-last-name" placeholder="Enter your last name">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email *</label>
                                    <input type="email" name="email" class="form-control" id="signup-email" placeholder="Enter your email address">
                                </div>
                                <div class="form-group">
                                    <label for="Password">Password</label>
                                    <input type="password" name="password" class="form-control" id="signup-password" placeholder="Enter your password"  pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,24}$" required>
                                    <span toggle="#password-field" class="field-icon toggle-signup-password"><img src="images/pre-login/eye.png"></span>
                                </div>
                                <div class="form-group">
                                    <label for="Confirm Password">Confirm Password</label>
                                    <input type="password" name="confirmpassword" class="form-control" id="signup-confirm-password" placeholder="Re-enter your password">
                                    <span toggle="#password-field" class="field-icon toggle-signup-password-confirm"><img src="images/pre-login/eye.png"></span>
                                </div>
                                  <div class="form-group">
                                    <button type="submit" name="signup" class="btn btn-gneral btn-purple" id="login-button">Login</button>
                                </div>
                                <div id="login-link" class="text-center">
                                    <p>Already have an account?</p>
                                    <a href="login.php">Login</a>
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
<?php
    if(isset($_SESSION['registration_success'])){
            echo "<script>
                    document.getElementById('signup_success').style.display ='block';
                  </script>";
        
            unset($_SESSION['registration_success']);
    }
        
?>
</html>