    <nav class="navbar fixed-top navbar-expand-lg navbar-light" id="mynav">
        <div class="container">
            <a class="navbar-brand" href="home.php"><img src="images/Homepage/logo.png" alt="logo" class="img-responsive"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'search.php' ? 'active' : '';?>" href="search.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Dashboard.php' ? 'active' : '';?>" href="Dashboard.php">Sell Your Notes</a>
                    </li>
                    
                    <?php 
                        if(isset($_SESSION['user_id'])) {
                            $page_name = basename($_SERVER['PHP_SELF']);
                            if($page_name == "BuyerRequest-page.php") {
                                $active = "active";
                            }
                            else {
                                $active = "";
                            }
                                
                            echo "<li class='nav-item'>
                                    <a class='nav-link $active' href='BuyerRequest-page.php'>Buyer Requests</a>
                                </li>";
                        }
                    
                    ?>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'FAQ.php' ? 'active' : '';?>" href="FAQ.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'ContactUs.php' ? 'active' : '';?>" href="ContactUs.php">Contatct Us</a>
                    </li>
                    
                    <?php 
                        if(isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];
                            
                            $user_dp_sql = "SELECT user_profile_picture FROM user_profile WHERE profile_user_id = '{$user_id}'";
                            $user_dp_result = query($user_dp_sql);
                            confirmQuery($user_dp_result);
                            $row = fetch_array($user_dp_result);
                            $user_DP = $row['user_profile_picture'];
                            if(empty($user_DP)) {
                                $user_DP = "images/user-img/default-profile.png";
                            }
                            
                            echo '<li class="nav-item dropdown">
                                    <a class="nav-link" href="#" role="button" id="userdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="'.$user_DP.'" alt="User Image" class="img-responsive rounded-circle" id="nav-user-img"></a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="edit_user_profile.php">My Profile</a>
                                        <a class="dropdown-item" href="Mydownloads-page.php">My Downloads</a>
                                        <a class="dropdown-item" href="MySoldNotes-page.php">My Sold Notes</a>
                                        <a class="dropdown-item" href="RejectedNotes.php">My Rejected Notes</a>
                                        <a class="dropdown-item" href="ChangePassword.php">Change Password</a>
                                        <a class="dropdown-item" onclick="javascript: return confirm(\'Are you sure you want to logout\');" href="logout.php" id="user-logout">Logout</a>
                                    </div>

                                </li>';
                            
                        }
                    ?>    
                    
                    <?php 
                        
                        if(isset($_SESSION['user_id'])) {
                            echo '<li class="nav-item">
                                    <div class="login-btn">
                                        <a class="nav-link btn btn-general btn-purple" onclick="javascript: return confirm(\'Are you sure you want to logout\');" href="logout.php" id="home-login-btn" role="button">Logout</a>
                                    </div>
                                </li>';
                        }
                    
                        else {
                            echo '<li class="nav-item">
                                    <div class="login-btn">
                                        <a class="nav-link btn btn-general btn-purple" href="login.php" id="home-login-btn" role="button">Login</a>
                                    </div>
                                </li>';
                        }
                    ?>
                        
                </ul>
            </div>
        </div>
    </nav>