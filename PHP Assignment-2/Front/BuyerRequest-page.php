<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="buyerrequest-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="buyerrequest-head">
                        <p>Buyer Requests</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="buyerrequest-search">
                        <input type="text" class="form-control" id="search-buyerrequest-note" placeholder="Search">
                        <div class="buyerrequest-search-btn" id="mydownloads-btn">
                            <a class="btn btn-general btn-purple" id="buyerrequest_search_btn" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="buyerrequest_result"></div>
    

<?php include("page_footer.php"); ?>

<script>
$(document).ready(function() {
    
    get_buyerrequest_data();    

    function get_buyerrequest_data(page)
    {
        var buyerrequest = 'fetch_buyerrequest_data';
        var search_buyerrequest = $('#search-buyerrequest-note').val();

        $.ajax({
            url:"fetch_buyerrequest_ajax.php",
            method:"POST",
            data:{buyerrequest:buyerrequest,search_buyerrequest:search_buyerrequest,page_no:page},
            success:function(data){
                $('#buyerrequest_result').html(data);
            }
        });
    }
    
    $('#buyerrequest_search_btn').click(function(){
        get_buyerrequest_data()
    });
    
    $(document).on("click", "#buyerrequest_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'buyerrequest_prev') {
            var current_page = $('#buyerrequest_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_buyerrequest_data(1);
            }
            else {
                get_buyerrequest_data(pageId);
            }
            
        }
        else if(pageId == 'buyerrequest_next') {
            var current_page = $('#buyerrequest_pagination li a.active').attr("id");
            var check_last = $('#buyerrequest_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_buyerrequest_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_buyerrequest_data(page_next);
            }
            
        }
        else {
            get_buyerrequest_data(pageId);
        }
      
    });
}); 

</script>