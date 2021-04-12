<?php  include "include/header.php"; ?>

<?php

if(isset($_SESSION['user_id']) and $_SESSION['user_role_id'] === '1') {
    
    if(check_profile($_SESSION['user_id'])) {
        redirect("search.php");
    }
    insert_user_profile();
    
?>
<?php include("page_header.php"); ?>

     <!-- Navigation Bar -->
     <nav class="navbar fixed-top navbar-expand-lg navbar-light" id="mynav">
        <div class="container">
            <a class="navbar-brand" href=""><img src="images/Homepage/logo.png" alt="logo" class="img-responsive"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Sell Your Notes</a>
                    </li>
                    
                    <?php 
                        if(isset($_SESSION['user_id'])) {
                            echo '<li class="nav-item">
                                    <a class="nav-link" href="">Buyer Requests</a>
                                </li>';
                        }
                    
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Contatct Us</a>
                    </li>
                    <li class="nav-item">
                        <div class="login-btn">
                            <a class="nav-link btn btn-general btn-purple" onclick="javascript: return confirm('Are you sure you want to logout');" href="logout.php" id="home-login-btn" role="button">Logout</a>
                        </div>
                    </li>
                        
                </ul>
            </div>
        </div>
    </nav>


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
                                <input type="text" name="first_name" class="form-control" id="user-first-name" value="<?php echo $_SESSION['user_first_name']; ?>" pattern="[a-zA-Z]+" placeholder="Enter your first name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Last Name">Last Name *</label>
                                <input type="text" name="last_name" class="form-control" id="user-last-name" value="<?php echo $_SESSION['user_last_name']; ?>" pattern="[a-zA-Z]+['-]*[a-zA-Z]+"  placeholder="Enter your last name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Email">Email *</label>
                                <input type="email" name="email" class="form-control" id="user-email" value="<?php echo $_SESSION['user_email_id']; ?>" placeholder="Enter your email address" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Date of Birth">Date of Birth</label>
                                <input type="date" name="dob" class="form-control custome-date" id="user-DOB" placeholder="Enter your date of birth" autocomplete="off">
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
                                        $query = "SELECT * FROM reference_data WHERE ref_category = 'gender' AND is_active = '1'";
                                        $result = query($query);
                                        confirmQuery($result);
                                        
                                        while($row = fetch_array($result)) {
                                            $value = $row['reference_id'];
                                            $name = $row['value'];
                                            echo "<option value='{$value}' style='text-transform:capitalize;'>{$name}</option>";
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
                                            <select class="form-control" name="phone_code" id="user-phone-no-code">
                                               <option value="" disabled selected>Code</option>
                                                <option value="91">+91</option>
                                                <option value="92">+92</option>
                                                <option value="93">+93</option>
                                                <option value="94">+94</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="phone" class="form-control" id="user-phone-number" pattern="[1-9]{1}[0-9]{9}"  placeholder="Enter your phone number">
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
                                    <input type="file" name="profile_pic"/>
                                    <img src="images/addnotes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                                </label>
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
                                <input type="text" name="address1" class="form-control" id="user-address-line-1" placeholder="Enter your address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Address Line 2">Address Line 2</label>
                                <input type="text" name="address2" class="form-control" id="user-address-line-2" placeholder="Enter your address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="City">City *</label>
                                <input type="text" name="city" class="form-control" id="user-city" pattern="[a-zA-Z]+['-]*[a-zA-Z]+"  placeholder="Enter your city" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="State">State *</label>
                                <input type="text" name="state" class="form-control" id="user-state" pattern="[a-zA-Z]+" placeholder="Enter your state" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ZipCode">ZipCode *</label>
                                <input type="text" name="zipcode" class="form-control" id="user-zipcode" pattern="[1-9]{1}[0-9]{5}" placeholder="Enter your zipcode" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <select class="form-control" name="country" id="user-country" required>
                                    <option value="" disabled selected>Select your country</option>
                                    <option value="india">India</option>
                                    <option value="australia">Australia</option>
                                    <option value="usa">USA</option>
                                    <option value="uk">UK</option>
                                    <option value="china">China</option>
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
                                <input type="text" name="university" class="form-control" id="user-university" placeholder="Enter your university">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="College">College</label>
                                <input type="text" name="college" class="form-control" id="user-college" placeholder="Enter your college">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="userprofile-submit-btn">
                                <button type="submit" class="btn btn-gneral btn-purple" name="user_profile_submit">Submit</button>
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