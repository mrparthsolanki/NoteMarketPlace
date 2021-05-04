<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['member_id'])) {
        
        $the_member_id = $_GET['member_id'];
        
        $select_member_sql = "SELECT * FROM users JOIN user_profile ON users.user_id=user_profile.profile_user_id WHERE users.user_id = $the_member_id";
        $select_member_result = query($select_member_sql);
        confirmQuery($select_member_result);
        
        $row = fetch_array($select_member_result);
        $member_DB_id = $row['user_id'];
        $member_role_id = $row['user_role_id'];
        $member_first_name = $row['user_first_name'];
        $member_last_name = $row['user_last_name'];
        $member_email_id = $row['user_email_id'];
        $member_dob = $row['user_dob'];
        $member_phone_number = $row['user_phone_number'];
        $member_profile_picture = $row['user_profile_picture'];
        $member_address1 = $row['user_address_line1'];
        $member_address2 = $row['user_address_line2'];
        $member_city = $row['user_city'];
        $member_state = $row['user_state'];
        $member_zipcode = $row['user_zipcode'];
        $member_country = $row['user_country'];
        $member_university = $row['user_college'];
        
        if(empty($member_profile_picture)) {
            $member_profile_picture = "../Front/images/user-img/default-profile.png";
        }

?>

    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>




<section id="member-details-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="member-detail-head">
                        <p>Member Details</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div id="member-img">
                                <img src="<?php echo $member_profile_picture; ?>" alt="Member-Image" class="img-responsive" width="150px">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div id="member-info-01">
                                <table class="table table-borderless member-info-table">
                                    <tbody>
                                        
                                        <?php
                                            if(!empty($member_first_name)) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>First Name:</td>
                                                <td class='member-info-table-col-2'>$member_first_name</td>
                                            </tr>";
                                            }
                                            if(!empty($member_last_name)) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>Last Name:</td>
                                                <td class='member-info-table-col-2'>$member_last_name</td>
                                            </tr>";
                                            }
                                            if(!empty($member_email_id)) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>Email:</td>
                                                <td class='member-info-table-col-2'>$member_email_id</td>
                                            </tr>";
                                            }           
                                            if($member_dob > 0) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>DOB:</td>
                                                <td class='member-info-table-col-2'>$member_dob</td>
                                            </tr>";
                                            }                  
                                            if(!empty($member_phone_number)) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>Phone Number:</td>
                                                <td class='member-info-table-col-2'>$member_phone_number</td>
                                            </tr>";
                                            }                          
                                            if(!empty($member_university)) {
                                                echo "<tr>
                                                <td class='member-info-table-col-1'>College/University:</td>
                                                <td class='member-info-table-col-2'>$member_university</td>
                                            </tr>";
                                            }                      
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6" id="member-details-vertical-line">
                    <div id="member-info-02">
                        <table class="table table-borderless member-info-table">
                            <tbody>
                                <?php
                                    if(!empty($member_address1)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>Address 1:</td>
                                        <td class='member-info-table-col-2'>$member_address1</td>
                                    </tr>";
                                    }   
                                    if(!empty($member_address2)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>Address 2:</td>
                                        <td class='member-info-table-col-2'>$member_address2</td>
                                    </tr>";
                                    } 
                                    if(!empty($member_city)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>City:</td>
                                        <td class='member-info-table-col-2'>$member_city</td>
                                    </tr>";
                                    }     
                                    if(!empty($member_state)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>State:</td>
                                        <td class='member-info-table-col-2'>$member_state</td>
                                    </tr>";
                                    } 
                                    if(!empty($member_country)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>Country:</td>
                                        <td class='member-info-table-col-2'>$member_country</td>
                                    </tr>";
                                    }
                                    if(!empty($member_zipcode)) {
                                        echo "<tr>
                                        <td class='member-info-table-col-1'>Zip Code:</td>
                                        <td class='member-info-table-col-2'>$member_zipcode</td>
                                    </tr>";
                                    }   
                                        
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>
    
    <section id="Genaeral-Table">
       
            
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="published-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Satus</th>
                                <th scope="col">Downloaded Notes</th>
                                <th scope="col">Total Earnings</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Published Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="Note-details.php">Software Development</a></td>
                                <td>IT</td>
                                <td>Published</td>
                                <td><a href="Downloads-notes.php">12</a></td>
                                <td>$17</td>
                                <td>11-01-2021, 12:10</td>
                                <td>11-01-2021, 12:10</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-member-detail-note dropleft">
                                            <a id="member-detail-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="Note-details.php">Computer Science</a></td>
                                <td>Computer</td>
                                <td>Published</td>
                                <td><a href="Downloads-notes.php">2</a></td>
                                <td>$12</td>
                                <td>09-01-2021, 12:10</td>
                                <td>09-01-2021, 12:10</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-member-detail-note dropleft">
                                            <a id="member-detail-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="Note-details.php">Human Body</a></td>
                                <td>Science</td>
                                <td>Published</td>
                                <td><a href="Downloads-notes.php">21</a></td>
                                <td>$157</td>
                                <td>08-01-2021, 12:10</td>
                                <td>08-01-2021, 12:10</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-member-detail-note dropleft">
                                            <a id="member-detail-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="Note-details.php">AI</a></td>
                                <td>IT</td>
                                <td>Published</td>
                                <td><a href="Downloads-notes.php">13</a></td>
                                <td>$270</td>
                                <td>06-01-2021, 12:10</td>
                                <td>06-01-2021, 12:10</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-member-detail-note dropleft">
                                            <a id="member-detail-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="Note-details.php">World War 2</a></td>
                                <td>History</td>
                                <td>Published</td>
                                <td><a href="Downloads-notes.php">42</a></td>
                                <td>$877</td>
                                <td>05-01-2021, 12:10</td>
                                <td>05-01-2021, 12:10</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-member-detail-note dropleft">
                                            <a id="member-detail-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
    </section>
                
                    
  <section id="dash-pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
                 





<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<?php
    }
    else {
        redirect("Dashboard-admin.php");
    }
?>  