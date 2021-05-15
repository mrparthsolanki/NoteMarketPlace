<?php  include "include/header.php"; ?>
<?php
     if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $email = strtolower($email);
        $email = trim(clean($email));
        $password = trim(clean($password));

        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
         
        $query = "SELECT * FROM users WHERE user_email_id = '{$email}'";
        $select_user_query = mysqli_query($connection, $query);
        confirmQuery($select_user_query);
        
        if(mysqli_num_rows($select_user_query)>0){
            while($row = mysqli_fetch_array($select_user_query)){
                $db_user_id = $row['user_id'];
                $db_user_role_id = $row['user_role_id'];
                $db_user_first_name = $row['user_first_name'];
                $db_user_last_name = $row['user_last_name'];
                $db_user_email_id = $row['user_email_id'];
                $db_user_password = $row['user_password'];
                $db_is_user_email_verified = $row['is_user_email_verified'];
                $db_is_active = $row['is_active'];
            }
            if($db_is_active === '1' and $db_user_email_id === $email and $db_user_password === $password ){

                if($db_is_user_email_verified === '1') {
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['user_role_id'] = $db_user_role_id;
                    $_SESSION['user_first_name'] = $db_user_first_name;
                    $_SESSION['user_last_name'] = $db_user_last_name;
                    $_SESSION['user_email_id'] = $db_user_email_id;
                    
                    if($_SESSION['user_role_id'] === '1') {
                        redirect("User-Profile page.php");
                    }
                    else if($_SESSION['user_role_id'] === '2' or $_SESSION['user_role_id'] === '3') {
                        redirect("../Admin/Dashboard.php");
                    }
                
                }
                else {
                    echo "<script>alert('Please verify your email')</script>";
                }

            }
            else{
                
                $_SESSION['password_error'] = array("The password that you\'ve entered is incorrect");
                
            }
            
        }
        else{
            echo "<script>alert('incorrect email address')</script>";
        }
        
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Login</title>

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
    <section id="login-bg-img">
        <div id="bg-img">
            <img src="images/pre-login/banner-with-overlay.jpg" class="img-resposive">
        </div>
    </section>
    <section id="login">
        <div id="content" class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-4 offset-md-4">
                    <!-- Logo -->
                    <div id="login-top-logo" class="text-center">
                        <img src="images/pre-login/top-logo.png" alt="Logo" class="img-responsive">
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3">
                    <div id="login-box-white">
                        <div id="login-box-head" class="text-center">
                            <h3>Login</h3>
                            <p>Enter your email address and password to login</p>
                        </div>

                        <div id="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="email" class="form-control" id="login-email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <div id="password-row">
                                        <label for="Password">Password</label>
                                        <a id="forgot-pass-link" href="ForgotPassword.php">Forgot Password?</a>
                                    </div>
                                    <input type="password" name="password" class="form-control" id="login-password" placeholder="Enter your password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,24}$" required>
                                    <span toggle="#password-field" class="field-icon toggle-password"><img src="images/pre-login/eye.png"></span>
                                    <div id="pass-validate">
                                        
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="login_checkbox" class="form-check-input" id="login-checkbox">
                                    <label class="form-check-label" for="Remember Me">Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" class="btn btn-gneral btn-purple" id="login-button">Login</button>
                                </div>
<!--
                                <div id="login-btn">
                                    <a class="btn btn-gneral btn-purple" href="home.php">Login</a>
                                </div>
-->
                                <div id="signup-link" class="text-center">
                                    <p>Don't have an account?</p>
                                    <a href="SignUp.php">Sign Up</a>
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
    if(isset($_SESSION['password_error'])){
        foreach($_SESSION['password_error'] as $pass_error){
            echo $password_error_msg = "<script>
                                document.getElementById('pass-validate').style.display ='block';    
                                document.getElementById('pass-validate').innerHTML='{$pass_error}';
                                document.getElementById('login-password').focus();
                                </script>";
            unset($_SESSION['password_error']);
        }
        
    }
    else {
        echo $password_error_msg = "<script>
                                document.getElementById('pass-validate').style.display ='none';    
                                document.getElementById('pass-validate').innerHTML='';
                                </script>";
    }
?>


</html>