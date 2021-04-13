<?php  include "include/header.php"; ?>
<?php

  contact_us();

?>


<?php include("page_header.php"); ?>

  <!-- Navigation Bar -->
  <?php include("Navigation.php"); ?>


    <section id="contactus-top-img">
        <img src="images/Search/banner-with-overlay.jpg" alt="Image" class="img-responsive">
        <div id="contactus-top-content">
            <h1>Contact Us</h1>
        </div>
    </section>

    <section id="contactus-heading">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="contactus-heading-bold">
                        <p>Get in Touch</p>
                    </div>
                    <div class="contactus-heading-norm">
                        <p>Let us know how to get back to you</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contactus-form-section">
        <div class="container">
            <form action="" method="post" class="contactus-form-details">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" class="form-control" name="contactus-fullname" id="contactus-name" placeholder="Enter your full name"  value="<?php echo isset($_SESSION['user_first_name']) ? $_SESSION['user_first_name'].' '.$_SESSION['user_last_name'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email"  name="contactus-email" class="form-control" id="contactus-email" aria-describedby="emailHelp" placeholder="Enter your email address" value="<?php echo isset($_SESSION['user_email_id']) ? $_SESSION['user_email_id'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" name="contactus-subject" class="form-control" id="contactus-subject" placeholder="Enter your subject">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group comments">
                            <label for="Comments">Comments / Questions *</label>
                            <textarea class="form-control" name="contactus-comments" id="contactus-comment" rows="8" placeholder="Comments..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div id="contactus-submit-btn">
                             <button type="submit" name="contact-submit" class="btn btn-gneral btn-purple">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

   <?php include("page_footer.php"); ?>

<?php
   if(isset($_SESSION['user_email_id'])) {
       echo "<script>document.getElementById('contactus-email').readOnly = true;</script>";
   } 
?>