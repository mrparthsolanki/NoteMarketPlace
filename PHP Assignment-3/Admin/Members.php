<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }

    if(isset($_GET['deactivate_member_id'])) {
        $the_super_admin = $_SESSION['user_id'];
        $deactivate_member_id = $_GET['deactivate_member_id'];
        
        $deactivate_member_query = "UPDATE users SET modified_date = now(), modified_by = $the_super_admin, is_active = 0 WHERE user_id = $deactivate_member_id";
        
        $deactivate_member_result = query($deactivate_member_query);
        confirmQuery($deactivate_member_result);
        
        $status_id_query = "SELECT reference_id FROM reference_data WHERE ref_category = 'note status' AND value = 'removed' AND is_active = 1";
        $result_status_id = query($status_id_query);
        confirmQuery($result_status_id);
        $row = fetch_array($result_status_id);
        $note_status_id = $row['reference_id'];  
        
        $remove_member_notes_query = "UPDATE seller_notes SET note_status = $note_status_id, actioned_by = $the_super_admin, modified_date = now(),modified_by = $the_super_admin WHERE seller_id = $deactivate_member_id AND note_status = 9";
        $remove_member_notes_result = query($remove_member_notes_query);
        confirmQuery($remove_member_notes_result);
        
        redirect("Members.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section id="members">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="members-head">
                        <p>Members</p>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="members-search">
                        <input type="text" class="form-control" id="search-members" placeholder="Search">
                        <div class="members-search-btn" id="members-btn">
                            <a class="btn btn-general btn-purple" id="members_search_button" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='members-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id='members_result'>
                    
                </div>
            
        </div>
    </section>
    
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<script>    
$(document).ready(function() {
    
    get_admin_members();
    
    function get_admin_members(page) {
        var admin_members_data = "admin_members_data";
        var members_search_field = $('#search-members').val();
        
        $.ajax({
            url: "fetch_table-2.php",
            method:"POST",
            data:{admin_members_data:admin_members_data,members_search_field:members_search_field,members_page_no:page},
            success:function(data){
                $('#members_result').html(data);
            }
        });
    }
    $('#members_search_button').click(function(){
        get_admin_members();
    });
    
    
    $(document).on("click", "#admin_members_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_member_page_prev') {
            var current_page = $('#admin_members_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_admin_members(1);
            }
            else {
                get_admin_members(pageId);
            }
            
        }
        else if(pageId == 'admin_member_page_next') {
            var current_page = $('#admin_members_pagination li a.active').attr("id");
            var check_last = $('#admin_member_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_admin_members(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_admin_members(page_next);
            }
            
        }
        else {
            get_admin_members(pageId);
        }
      
    });
});
</script>
