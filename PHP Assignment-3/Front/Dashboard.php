    <?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <!-- Dashboard -->
    <section id="dashboard-info-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="dashboard-heading">
                        <p>Dashboard</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div id="dashboard-add-note-btn">
                        <a class="btn btn-general btn-purple" href="AddNotes-page.php" title="Add Note" role="button">Add Note</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        $the_user_id = $_SESSION['user_id'];

        $my_sold_notes_count_sql = "SELECT * FROM downloads WHERE is_allowed_download = 1 AND seller = $the_user_id AND attachment_path IS NOT NULL AND downloader <> $the_user_id";
        $my_sold_notes_count_result = query($my_sold_notes_count_sql);
        confirmQuery($my_sold_notes_count_result);
        $my_sold_count = row_count($my_sold_notes_count_result);
        
        $money_earned_sql = "SELECT SUM(purchased_price) AS money_earned FROM downloads WHERE is_allowed_download = 1 AND seller = $the_user_id AND attachment_path IS NOT NULL AND downloader <> $the_user_id";
        $money_earned_result = query($money_earned_sql);
        confirmQuery($money_earned_result);
        $money_earned_row = fetch_array($money_earned_result);
        $money_earned = $money_earned_row['money_earned'];

        $my_downloads_count_sql = "SELECT * FROM downloads WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND downloader = '{$the_user_id}'";
        $my_downloads_count_result = query($my_downloads_count_sql);
        confirmQuery($my_downloads_count_result);
        $my_downloads_count = row_count($my_downloads_count_result);
        
        $my_rejected_notes_count_sql = "SELECT * FROM seller_notes JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE reference_data.ref_category = 'note status' AND reference_data.value = 'rejected' AND is_note_active = 1 AND seller_id = $the_user_id";
        $my_rejected_notes_count_result = query($my_rejected_notes_count_sql);
        confirmQuery($my_rejected_notes_count_result);
        $my_rejected_notes_count = row_count($my_rejected_notes_count_result);
        
        $buyer_request_count_sql = "SELECT * FROM downloads WHERE is_allowed_download = 0 AND is_note_paid = 1 AND seller = '{$the_user_id}'";
        $buyer_request_count_result = query($buyer_request_count_sql);
        confirmQuery($buyer_request_count_result);
        $buyer_request_count = row_count($buyer_request_count_result);


    ?>    
    
   
    <!-- Dashboard -->
    <section id="dashboard-info">
        <div class="container">
            <div class="row dashboard-info-row text-center">
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div id="dashboard-earning-img">
                            <img src="images/Dashboard/dashboard-earning.PNG" alt="Earning" class="img-responsive">
                        </div>
                        <div id="dashboard-earning-title">
                            <h5>My Earning</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="dashboard-info-card-head">
                                    <h3><a href="MySoldNotes-page.php"><?php echo $my_sold_count; ?></a></h3>
                                </div>
                                <div class="dashboard-info-card-p">
                                    <p>Number of Notes Sold</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="dashboard-info-card-head">
                                    <h3>$<?php echo round($money_earned); ?></h3>
                                </div>
                                <div class="dashboard-info-card-p">
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="MyDownloads-page.php"><?php echo $my_downloads_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>My Downloads</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="RejectedNotes.php"><?php echo $my_rejected_notes_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>My Rejected Notes</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="BuyerRequest-page.php"><?php echo $buyer_request_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Buyer Requests</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-inprogress-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dash-head">
                        <h3>In Progress Notes</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right my-text-right">
                    <div class="dash-search">
                        <input type="text" class="form-control" id="search-inprogress-note" placeholder="Search">
                        <div class="dash-search-btn" id="search-btn-1">
                            <a class="btn btn-general btn-purple" id="inprogress_note_search_btn" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="inprogress_notes_result"></div>   
     

    <section id="dash-published-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dash-head">
                        <h3>Published Notes</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right my-text-right">
                    <div class="dash-search">
                        <input type="text" class="form-control" id="search-published-note" placeholder="Search">
                        <div class="dash-search-btn" id="search-btn-1">
                            <a class="btn btn-general btn-purple" id="published_note_search_btn" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="published_notes_result"></div>
       
    

<?php include("page_footer.php"); ?>

<script>    
$(document).ready(function() {

    get_inprogress_note_data();    

    function get_inprogress_note_data(page)
    {
        var inprogress_notes = 'inprogress_notes';
        var search_field_inprogress = $('#search-inprogress-note').val();

        $.ajax({
            url:"dashboard_data.php",
            method:"POST",
            data:{inprogress_notes:inprogress_notes,search_field_inprogress:search_field_inprogress,page_no:page},
            success:function(data){
                $('#inprogress_notes_result').html(data);
            }
        });
    }


    $('#inprogress_note_search_btn').click(function(){
        get_inprogress_note_data()
    });
    
    $(document).on("click", "#inprogress_notes_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'inprogress_notes_prev') {
            var current_page = $('#inprogress_notes_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_inprogress_note_data(1);
            }
            else {
                get_inprogress_note_data(pageId);
            }
            
        }
        else if(pageId == 'inprogress_notes_next') {
            var current_page = $('#inprogress_notes_pagination li a.active').attr("id");
            var check_last = $('#inprogress_notes_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_inprogress_note_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_inprogress_note_data(page_next);
            }
            
        }
        else {
            get_inprogress_note_data(pageId);
        }
      
    });

    get_published_note_data();    

    function get_published_note_data(page)
    {
        var published_notes = 'published_notes';
        var search_field_publish = $('#search-published-note').val();

        $.ajax({
            url:"dashboard_data.php",
            method:"POST",
            data:{published_notes:published_notes,search_field_publish:search_field_publish,page_no:page},
            success:function(data){
                $('#published_notes_result').html(data);
            }
        });
    }
    
    $('#published_note_search_btn').click(function(){
        get_published_note_data()
    });
    
    $(document).on("click", "#published_notes_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'published_notes_prev') {
            var current_page = $('#published_notes_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_published_note_data(1);
            }
            else {
                get_published_note_data(pageId);
            }
            
        }
        else if(pageId == 'published_notes_next') {
            var current_page = $('#published_notes_pagination li a.active').attr("id");
            var check_last = $('#published_notes_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_published_note_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_published_note_data(page_next);
            }
            
        }
        else {
            get_published_note_data(pageId);
        }
      
    });
    
});
</script>