<?php  include "include/header.php"; ?>
<?php   
    activate_user();
?>        

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>Email Verification</title>

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
    <!-- Verify Email Modal -->
    <form action="" method="post">
        <div id="verifyemail">
            <div class="verifyemail-content-inner">
                <div class="emailverification-logo">
                    <img src="images/Homepage/logo.png" alt="Logo" class="img-responsive">
                </div>
                <div class="emailverification-head">
                    <h5>Email Verification</h5>
                </div>
                <div class="">
                    <div id="emailverification-content-bold">
                        <p>Dear <?php echo $_GET['name']; ?>,</p>
                    </div>
                    <div id="emailverification-content-normal">
                        <p>Thanks for Signing up!</p>
                        <p>Simply click below for email verification.</p>
                    </div>
                </div>
                <div class="">
                    <div id="verify-email-btn">
                        <button class="btn btn-gneral btn-purple" type="submit" name="verify_email">Verify Email Address</button>
                    </div>
                </div>
            </div>
        </div>
    </form>




    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>