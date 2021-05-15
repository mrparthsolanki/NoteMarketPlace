<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 
    
    <section id="manage-administrator-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-admin-heading">
                        <p>Manage Administrator</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-administrator-btn" id="add-administrator">
                                <a class="btn btn-general btn-purple" href="Add-Administrator.php" title="Add Administrator" role="button">Add Administrator</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="add-admin-search">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 offset-md-3">
                                        <input type="text" class="form-control" id="administrator-search" placeholder="Search">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="administrator-search-btn" id="search-administrator-btn">
                                            <a class="btn btn-general btn-purple" id="search_admin_button" title="Search" role="button">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="administrator-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive" id="admin_data_result">
                    
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   

<script>    
$(document).ready(function() {
    
    get_manage_admin_data();
    
    function get_manage_admin_data(page) {
        var manage_Admin = "manage_Admin";
        var manage_Admin_search_field = $('#administrator-search').val();
        
        $.ajax({
            url: "fetch_table-1.php",
            method:"POST",
            data:{manage_Admin:manage_Admin,manage_Admin_search_field:manage_Admin_search_field,mange_Admin_page_no:page},
            success:function(data){
                $('#admin_data_result').html(data);
            }
        });
    }   
    $('#search_admin_button').click(function(){
        get_manage_admin_data();
    });
    
    $(document).on("click", "#manage_Admin_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'manage_Admin_page_prev') {
            var current_page = $('#manage_Admin_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_manage_admin_data(1);
            }
            else {
                get_manage_admin_data(pageId);
            }
            
        }
        else if(pageId == 'manage_Admin_page_next') {
            var current_page = $('#manage_Admin_pagination li a.active').attr("id");
            var check_last = $('#manage_Admin_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_manage_admin_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_manage_admin_data(page_next);
            }
            
        }
        else {
            get_manage_admin_data(pageId);
        }
      
    });
       
});
</script> 