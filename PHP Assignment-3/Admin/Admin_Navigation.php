<nav class="navbar fixed-top navbar-expand-lg navbar-light" id="mynav">
    <div class="container">
        <a class="navbar-brand" href="Dashboard.php"><img  src="images/logo.png" alt="logo" class="img-responsive"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Dashboard.php' ? 'active' : '';?>" href="Dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" id="notesdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="Notes-Under-Review.php">Notes Under Review</a>
                        <a class="dropdown-item" href="Published-Notes.php">Published Notes</a>
                        <a class="dropdown-item" href="Downloads-notes.php">Downloaded Notes</a>
                        <a class="dropdown-item" href="Rejected-notes.php">Rejected Notes</a>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Members.php' ? 'active' : '';?>" href="Members.php">Members</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link  <?php echo basename($_SERVER['PHP_SELF']) == 'Spam-Reports.php' ? 'active' : '';?>" href="#" role="button" id="reportsdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="Spam-Reports.php">Spam Reports</a>
                    </div>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" id="settingsdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <?php
                            if(isset($_SESSION['user_id'])) {
                                if($_SESSION['user_role_id'] == 3) {
                                    echo '<a class="dropdown-item" href="Manage-System-Configuration.php">Manage System Configuration</a>
                            <a class="dropdown-item" href="Manage-Administrator.php">Manage Administrator</a>';
                                }
                            }
                            ?>
                            
                        <a class="dropdown-item" href="Manage-Category.php">Manage Category</a>
                        <a class="dropdown-item" href="Manage-Type.php">Manage Type</a>
                        <a class="dropdown-item" href="Manage-Country.php">Manage Countries</a>
                    </div>

                </li>
                <?php 
                        if(isset($_SESSION['user_id'])) {
                            $admin_id = $_SESSION['user_id'];
                            
                            $admin_dp_sql = "SELECT user_profile_picture FROM user_profile WHERE profile_user_id = $admin_id";
                            $admin_dp_result = query($admin_dp_sql);
                            confirmQuery($admin_dp_result);
                            $row = fetch_array($admin_dp_result);
                            $admin_DP = $row['user_profile_picture'];
                            if(empty($admin_DP)) {
                               $admin_DP = "../Front/images/user-img/default-profile.png";
                            }
                        }
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" id="userdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $admin_DP; ?>" alt="User Image" class="img-responsive rounded-circle" id="nav-user-img"></a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="My-Profile.php">Update Profile</a>
                        <a class="dropdown-item" href="../Front/ChangePassword.php">Change Password</a>
                        <a class="dropdown-item" onclick="javascript: return confirm('Are you sure you want to logout');" href="../Front/logout.php" id="user-logout">Logout</a>
                    </div>

                </li>
                <li class="nav-item">
                    <div class="login-btn">
                        <a class="nav-link btn btn-general btn-purple" onclick="javascript: return confirm('Are you sure you want to logout');" href="../Front/logout.php" id="home-login-btn" role="button">Logout</a>
                    </div> 
                </li>
            </ul>
        </div>
    </div>
</nav>