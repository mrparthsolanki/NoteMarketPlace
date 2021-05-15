<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    $seller_id_dropdown = 0;
    $buyer_id_dropdown = 0;

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
    if(isset($_GET['member_downloaded_note'])) {
        $buyer_id_dropdown = $_GET['member_downloaded_note'];
    }

?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section id="downloaded-note-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="downloaded-note-sec-head">
                        <p>Downloaded Notes</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="downloaded-note-search-01">
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Note</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-name">
                                        <option class="downloaded-note-dropdown-selected" value="" disabled selected>Select note</option>
                                        
                                        <?php
                                            $select_category_downloadednote_sql = "SELECT DISTINCT note_category FROM downloads ORDER BY note_category ASC";
                                            $select_category_downloadednote_result = query($select_category_downloadednote_sql);
                                            confirmQuery($select_category_downloadednote_result);
                                            while($row_category = fetch_array($select_category_downloadednote_result)) {
                                                
                                                $note_cate = $row_category['note_category'];
                                                
                                                echo "<option value='$note_cate'>$note_cate</option>";

                                            }    

                                        ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Seller</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-seller">
                                        <option value="" disabled selected>Select seller</option>
                                        <?php
                                            $select_seller_downloadednote_sql = "SELECT DISTINCT seller_notes.seller_id,users.user_first_name,users.user_last_name FROM seller_notes JOIN users ON seller_notes.seller_id=users.user_id ORDER BY users.user_first_name ASC";
                                            $select_seller_downloadednote_result = query($select_seller_downloadednote_sql);
                                            confirmQuery($select_seller_downloadednote_result);
                                            while($row = fetch_array($select_seller_downloadednote_result)) {
                                                $seller_id = $row['seller_id'];
                                                $seller_first_name = $row['user_first_name'];
                                                $seller_last_name = $row['user_last_name'];
                                                $seller = $seller_first_name." ".$seller_last_name;
                                                
                                                if($seller_id_dropdown === $seller_id) {
                                                    echo "<option value='$seller_id' selected>$seller</option>";
                                                }
                                                else {
                                                    echo "<option value='$seller_id'>$seller</option>";
                                                } 

                                            }    

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Buyer</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-buyer">
                                        <option value="" disabled selected>Select buyer</option>
                                        <?php
                                            $select_buyer_downloadednote_sql = "SELECT DISTINCT downloads.downloader, users.user_first_name, users.user_last_name FROM downloads JOIN users ON downloads.downloader=users.user_id ORDER BY users.user_first_name ASC";
                                            $select_buyer_downloadednote_result = query($select_buyer_downloadednote_sql);
                                            confirmQuery($select_buyer_downloadednote_result);
                                            while($buyer_row = fetch_array($select_buyer_downloadednote_result)) {
                                                $buyer_id = $buyer_row['downloader'];
                                                $buyer_first_name = $buyer_row['user_first_name'];
                                                $buyer_last_name = $buyer_row['user_last_name'];
                                                $buyer = $buyer_first_name." ".$buyer_last_name;
                                                
                                                if($buyer_id_dropdown === $buyer_id) {
                                                    echo "<option value='$buyer_id' selected>$buyer</option>";
                                                }
                                                else {
                                                    echo "<option value='$buyer_id'>$buyer</option>";
                                                } 

                                            }    

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <label></label>
                    <div class="downloaded-note-search-02">
                        <div class="form-group">
                            <input type="text" class="form-control" id="downloaded-note-search-field" placeholder="Search">
                        </div>
                        <div class="downloaded-note-search-btn" id="downloaded-note-btn">
                            <a class="btn btn-general btn-purple" id="downloaded_notes_search_button" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='downloaded-note-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id='admin_downloaded_note_result'>
                    
                </div>
            
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>  

<script>    
$(document).ready(function() {
    
    get_admin_downloaded_note();
    
    function get_admin_downloaded_note(page) {
        var admin_downloaded_note = "admin_downloaded_note";
        var downloaded_note_search_field = $('#downloaded-note-search-field').val();
        var downloaded_by_seller = $("#downloaded-note-by-seller").children("option:selected").val();
        var downloaded_by_buyer = $("#downloaded-note-by-buyer").children("option:selected").val();
        var downloaded_by_note_cate = $("#downloaded-note-by-name").children("option:selected").val();
        
        $.ajax({
            url: "fetch_table-2.php",
            method:"POST",
            data:{admin_downloaded_note:admin_downloaded_note,downloaded_note_search_field:downloaded_note_search_field,downloaded_by_seller:downloaded_by_seller,downloaded_by_buyer:downloaded_by_buyer,downloaded_by_note_cate:downloaded_by_note_cate,downloaded_page_no:page},
            success:function(data){
                $('#admin_downloaded_note_result').html(data);
            }
        });
    }
    $('#downloaded_notes_search_button').click(function(){
        get_admin_downloaded_note();
    });
    
    $("#downloaded-note-by-seller").change(function(){
        get_admin_downloaded_note();
    });
    $("#downloaded-note-by-buyer").change(function(){
        get_admin_downloaded_note();
    });
    $("#downloaded-note-by-name").change(function(){
        get_admin_downloaded_note();
    });
    
    $(document).on("click", "#admin_downloaded_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_downloaded_page_prev') {
            var current_page = $('#admin_downloaded_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_admin_downloaded_note(1);
            }
            else {
                get_admin_downloaded_note(pageId);
            }
            
        }
        else if(pageId == 'admin_downloaded_page_next') {
            var current_page = $('#admin_downloaded_pagination li a.active').attr("id");
            var check_last = $('#admin_downloaded_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_admin_downloaded_note(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_admin_downloaded_note(page_next);
            }
            
        }
        else {
            get_admin_downloaded_note(pageId);
        }
      
    });
       
});
</script>  