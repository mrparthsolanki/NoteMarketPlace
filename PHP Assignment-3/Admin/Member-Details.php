<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['member_id'])) {
        
        if(isset($_GET['admin_download_note'])) {
            if(isset($_SESSION['user_id'])) {
                if($_SESSION['user_role_id'] == 2 or $_SESSION['user_role_id'] == 3) {
                    $path = $_GET['admin_download_note'];
                    $note_name = $_GET['admin_download_note_name'];
                    download_attachment($path,$note_name);
                }
            }
        }
        
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
            $select_default_dp_sql = "SELECT * FROM system_config";
            $select_default_dp_result = query($select_default_dp_sql);
            confirmQuery($select_default_dp_result);
            $results_dp = array();
            while($default_dp_row = fetch_array($select_default_dp_result)) {
                $results_dp[$default_dp_row['key']] = $default_dp_row['value'];
            }
            $member_profile_picture = $results_dp['DefaultMemberDisplayPicture'];
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
                        <div class="col-sm-4 col-md-3">
                            <div id="member-img">
                                <img src="<?php echo $member_profile_picture; ?>" alt="Member-Image" class="img-responsive" height="120px">
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
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
                <div class="col-sm-12 col-md-4" id="member-details-vertical-line">
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

    <section id="member-detail-note-info-section">
        
            <div class="row">
             <div class="container">
               
                <div class="col-md-12">
                    <div id="notes-heading">
                        <h6>Notes</h6>
                    </div>
                
                 </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive" id="member_details_table_result">
                
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<?php
    }
    else {
        redirect("Dashboard-admin.php");
    }
?>  
<script>    
$(document).ready(function() {
    
    get_admin_members_details();
    
    function get_admin_members_details(page) {
        var admin_members_detail_data = "admin_members_detail_data";
        var member_id_ajax = <?php echo $_GET['member_id']; ?>;
        $.ajax({
            url: "fetch_table-2.php",
            method:"POST",
            data:{admin_members_detail_data:admin_members_detail_data,member_id_ajax:member_id_ajax,members_detail_page_no:page},
            success:function(data){
                $('#member_details_table_result').html(data);
            }
        });
    }
    
    $(document).on("click", "#admin_members_detail_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_member_detail_page_prev') {
            var current_page = $('#admin_members_detail_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_admin_members_details(1);
            }
            else {
                get_admin_members_details(pageId);
            }
            
        }
        else if(pageId == 'admin_member_detail_page_next') {
            var current_page = $('#admin_members_detail_pagination li a.active').attr("id");
            var check_last = $('#admin_member_detail_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_admin_members_details(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_admin_members_details(page_next);
            }
            
        }
        else {
            get_admin_members_details(pageId);
        }
      
    });
});
</script>