<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section id="manage-country-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-country-heading">
                        <p>Manage Country</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-country-btn" id="add-country">
                                <a class="btn btn-general btn-purple" href="Add-Country.php" title="Add Country" role="button">Add Country</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="manage-country-search">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 offset-md-3">
                                        <input type="text" class="form-control" id="country-search" placeholder="Search">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="country-search-btn" id="search-country-btn">
                                            <a class="btn btn-general btn-purple" id="country_search_button" title="Search" role="button">Search</a>
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

    <section id="country-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 table-responsive" id="country_data_result">
                
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   

<script>    
$(document).ready(function() {
    
    get_country_data();
    
    function get_country_data(page) {
        var country_data = "country_data";
        var country_search_field = $('#country-search').val();
        
        $.ajax({
            url: "fetch_setting_data.php",
            method:"POST",
            data:{country_data:country_data,country_search_field:country_search_field,country_page_no:page},
            success:function(data){
                $('#country_data_result').html(data);
            }
        });
    }
    $('#country_search_button').click(function(){
        get_country_data();
    });
    
    $(document).on("click", "#country_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'country_page_prev') {
            var current_page = $('#country_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_country_data(1);
            }
            else {
                get_country_data(pageId);
            }
            
        }
        else if(pageId == 'country_page_next') {
            var current_page = $('#country_pagination li a.active').attr("id");
            var check_last = $('#country_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_country_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_country_data(page_next);
            }
            
        }
        else {
            get_country_data(pageId);
        }
      
    });
       
});
</script>