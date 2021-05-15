<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['admin_download_note'])) {
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['user_role_id'] == 2 or $_SESSION['user_role_id'] == 3) {
                $path = $_GET['admin_download_note'];
                $note_name = $_GET['admin_download_note_name'];
                download_attachment($path,$note_name);
            }
        }
    }
    if(isset($_GET['delete_report'])) {
        $delete_id = $_GET['delete_report'];
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['user_role_id'] == 2 or $_SESSION['user_role_id'] == 3) {
                
                $delete_report_sql = "DELETE FROM `reported_note` WHERE `report_id` = $delete_id";
                $delete_report_result = query($delete_report_sql);
                confirmQuery($delete_report_result);
                redirect("SpamReports.php");
                
            }
        }
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section id="spam-report">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="spam-report-head">
                        <p>Spam Reports</p>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="spam-report-search">
                        <input type="text" class="form-control" id="search-spam-report" placeholder="Search">
                        <div class="spam-report-search-btn" id="spam-report-btn">
                            <a class="btn btn-general btn-purple" id="spam_search_button" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='spam-report-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id="spam_report_data_result">
                    
                </div>
            
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<script>    
$(document).ready(function() {
    
    get_spam_report_data();
    
    function get_spam_report_data(page) {
        var spam_report = "spam_report";
        var spam_search_field = $('#search-spam-report').val();
        
        $.ajax({
            url: "fetch_table-1.php",
            method:"POST",
            data:{spam_report:spam_report,spam_search_field:spam_search_field,spam_page_no:page},
            success:function(data){
                $('#spam_report_data_result').html(data);
            }
        });
    }
    $('#spam_search_button').click(function(){
        get_spam_report_data();
    });
    
    $(document).on("click", "#spam_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'spam_page_prev') {
            var current_page = $('#spam_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_spam_report_data(1);
            }
            else {
                get_spam_report_data(pageId);
            }
            
        }
        else if(pageId == 'spam_page_next') {
            var current_page = $('#spam_pagination li a.active').attr("id");
            var check_last = $('#spam_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_spam_report_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_spam_report_data(page_next);
            }
            
        }
        else {
            get_spam_report_data(pageId);
        }
      
    });
       
});
</script>  