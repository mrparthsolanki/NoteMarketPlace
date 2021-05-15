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
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section id="rejected-note-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="rejected-note-sec-head">
                        <p>Rejected Notes</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-4 col-md-6">
                    <div class="rejected-note-search-01">
                        <label>Seller</label>
                        <div class="form-group">
                            <select class="form-control" id="rejected-note-seller">
                                <option value="" disabled selected>Select Seller</option>
                                <?php
                                    $select_seller_rejectednote_sql = "SELECT DISTINCT seller_notes.seller_id,users.user_first_name,users.user_last_name FROM seller_notes JOIN users ON seller_notes.seller_id=users.user_id ORDER BY users.user_first_name ASC";
                                    $select_seller_rejectednote_result = query($select_seller_rejectednote_sql);
                                    confirmQuery($select_seller_rejectednote_result);
                                    while($row = fetch_array($select_seller_rejectednote_result)) {
                                        $seller_id = $row['seller_id'];
                                        $seller_first_name = $row['user_first_name'];
                                        $seller_last_name = $row['user_last_name'];
                                        $seller = $seller_first_name." ".$seller_last_name;
                                        
                                        echo "<option value='$seller_id'>$seller</option>";
                                    }    
                                
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6 text-right">
                    <div class="rejected-note-search-02">
                        <input type="text" class="form-control" id="rejected-note-search-field" placeholder="Search">
                        <div class="rejected-note-search-btn" id="rejected-note-btn">
                            <a class="btn btn-general btn-purple" id="rejected_note_search_button" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='rejected-note-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id='admin_rejected_note_result'>
                    
                        
                </div>
            
        </div>
    </section>

<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<script>    
$(document).ready(function() {
    
    get_admin_rejected_note();
    
    function get_admin_rejected_note(page) {
        var admin_rejected_note = "admin_rejected_note";
        var rejected_note_search_field = $('#rejected-note-search-field').val();
        var seller_rejected_note = $("#rejected-note-seller").children("option:selected").val();
        
        $.ajax({
            url: "fetch_table-2.php",
            method:"POST",
            data:{admin_rejected_note:admin_rejected_note,rejected_note_search_field:rejected_note_search_field,seller_rejected_note:seller_rejected_note,rejected_page_no:page},
            success:function(data){
                $('#admin_rejected_note_result').html(data);
            }
        });
    }
    $('#rejected_note_search_button').click(function(){
        get_admin_rejected_note();
    });
    
    $("#rejected-note-seller").change(function(){
        get_admin_rejected_note();
    });
    
    $(document).on("click", "#admin_rejected_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_rejected_page_prev') {
            var current_page = $('#admin_rejected_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_admin_rejected_note(1);
            }
            else {
                get_admin_rejected_note(pageId);
            }
            
        }
        else if(pageId == 'admin_rejected_page_next') {
            var current_page = $('#admin_rejected_pagination li a.active').attr("id");
            var check_last = $('#admin_rejected_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_admin_rejected_note(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_admin_rejected_note(page_next);
            }
            
        }
        else {
            get_admin_rejected_note(pageId);
        }
      
    });
    
    $(document).on('click', '.approve_note', function() {
        var note_id = $(this).attr("id");
        var action = "approve note";
        var admin_confirmation = confirm('If you approve the notes – System will publish the notes over portal. Please press yes to continue.');
        if(admin_confirmation) {
            $.ajax({
                url: "NoteOperation.php",
                method: "POST",
                data:{action:action,note_id:note_id},
                success:function(data) {

                    location.reload();

                }
            });
        }
    });
});
</script>
