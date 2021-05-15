<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
    if(isset($_GET['download_sold_note'])) {
        if(isset($_SESSION['user_id'])) {
            $path = $_GET['download_sold_note'];
            $note_name = $_GET['admin_download_note_name'];
            download_attachment($path,$note_name);
        }
    }

?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="mysold-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="mysoldnotes-head">
                        <p>My Sold Notes</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="mysoldnotes-search">
                        <input type="text" class="form-control" id="search-mysold-note" placeholder="Search">
                        <div class="mysoldnote-search-btn" id="mydownloads-btn">
                            <a class="btn btn-general btn-purple" title="Search" role="button" id="search_sold_note">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <div id="mysold_result">
               
    </div>
           

<?php include("page_footer.php"); ?>

<script>    
$(document).ready(function() {
    
    get_mysold_note_data();    

    function get_mysold_note_data(page)
    {
        var sold_note = 'fetch_mysold_data';
        var search_mysold = $('#search-mysold-note').val();

        $.ajax({
            url:"fetch_downloaded_note.php",
            method:"POST",
            data:{sold_note:sold_note,search_mysold:search_mysold,page_no:page},
            success:function(data){
                $('#mysold_result').html(data);
            }
        });
    }
    
    $('#search_sold_note').click(function(){
        get_mysold_note_data()
    });
    
    $(document).on("click", "#mysold_note_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'download_prev') {
            var current_page = $('#mysold_note_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_mysold_note_data(1);
            }
            else {
                get_mysold_note_data(pageId);
            }
            
        }
        else if(pageId == 'download_next') {
            var current_page = $('#mysold_note_pagination li a.active').attr("id");
            var check_last = $('#download_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_mysold_note_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_mysold_note_data(page_next);
            }
            
        }
        else {
            get_mysold_note_data(pageId);
        }
      
    });
});   
</script>