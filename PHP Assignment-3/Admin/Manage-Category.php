<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section id="manage-category-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-category-heading">
                        <p>Manage Category</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-category-btn" id="add-category">
                                <a class="btn btn-general btn-purple" href="Add-Category.php" title="Add Category" role="button">Add Category</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="manage-category-search">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 offset-md-3">
                                        <input type="text" class="form-control" id="category-search" placeholder="Search">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="category-search-btn" id="search-category-btn">
                                            <a class="btn btn-general btn-purple" id="category_search_button" title="Search" role="button">Search</a>
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

    <section id="category-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="category_data_result">
                   <table class='table table-hover table-responsive w-100 d-block d-md-table' id='category-info-table'>
                       
                       
                   </table>
                    
                      
                </div>
            </div>
        </div>
    </section>
    
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>    


<script>    
$(document).ready(function() {
    
    get_category_data();
    
    function get_category_data(page) {
        var category_data = "category_data";
        var category_search_field = $('#category-search').val();
        
        $.ajax({
            url: "fetch_setting_data.php",
            method:"POST",
            data:{category_data:category_data,category_search_field:category_search_field,category_page_no:page},
            success:function(data){
                $('#category_data_result').html(data);
            }
        });
    }
    $('#category_search_button').click(function(){
        get_category_data();
    });
    
    $(document).on("click", "#category_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'category_page_prev') {
            var current_page = $('#category_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_category_data(1);
            }
            else {
                get_category_data(pageId);
            }
            
        }
        else if(pageId == 'category_page_next') {
            var current_page = $('#category_pagination li a.active').attr("id");
            var check_last = $('#category_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_category_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_category_data(page_next);
            }
            
        }
        else {
            get_category_data(pageId);
        }
      
    });
       
});
</script>  