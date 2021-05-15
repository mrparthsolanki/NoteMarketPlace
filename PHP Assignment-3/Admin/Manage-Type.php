<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section id="manage-type-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-type-heading">
                        <p>Manage Type</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-type-btn" id="add-type">
                                <a class="btn btn-general btn-purple" href="Add-Type.php" title="Add Type" role="button">Add Type</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="manage-type-search">
                               <form>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 offset-md-3">
                                            <input type="text" class="form-control" id="type-search" placeholder="Search">
                                        </div>
                                        <div class="col-sm-6 col-md-3">
                                            <div class="type-search-btn" id="search-type-btn">
                                                <a class="btn btn-general btn-purple" id="type_search_button" title="Search" role="button">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="type-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive" id="type_data_result">
                    
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   

<script>    
$(document).ready(function() {
    
    get_type_data();
    
    function get_type_data(page) {
        var type_data = "type_data";
        var type_search_field = $('#type-search').val();
        
        $.ajax({
            url: "fetch_setting_data.php",
            method:"POST",
            data:{type_data:type_data,type_search_field:type_search_field,type_page_no:page},
            success:function(data){
                $('#type_data_result').html(data);
            }
        });
    }
    $('#type_search_button').click(function(){
        get_type_data();
    });
    
    $(document).on("click", "#type_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'type_page_prev') {
            var current_page = $('#type_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_type_data(1);
            }
            else {
                get_type_data(pageId);
            }
            
        }
        else if(pageId == 'type_page_next') {
            var current_page = $('#type_pagination li a.active').attr("id");
            var check_last = $('#type_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_type_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_type_data(page_next);
            }
            
        }
        else {
            get_type_data(pageId);
        }
      
    });
       
});
</script>     