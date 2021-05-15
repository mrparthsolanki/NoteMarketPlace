<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    $seller_id_dropdown = 0;
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
    if(isset($_GET['member_published_note'])) {
        $seller_id_dropdown = $_GET['member_published_note'];
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section id="published-note-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="published-note-sec-head">
                        <p>Published Notes</p>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Seller</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-md-6">
                    <div class="published-note-search">
                        <div class="form-group">
                            <select class="form-control" id="published-note-by-seller">
                                <option value="" disabled selected>Select Seller</option>
                                <?php
                                    $select_seller_publishednote_sql = "SELECT DISTINCT seller_notes.seller_id,users.user_first_name,users.user_last_name FROM seller_notes JOIN users ON seller_notes.seller_id=users.user_id ORDER BY users.user_first_name ASC";
                                    $select_seller_publishednote_result = query($select_seller_publishednote_sql);
                                    confirmQuery($select_seller_publishednote_result);
                                    while($row = fetch_array($select_seller_publishednote_result)) {
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
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="published-note-search">
                        <input type="text" class="form-control" id="published-note-search-field" placeholder="Search">
                        <div class="published-note-search-btn" id="notes-under-review-btn">
                            <a class="btn btn-general btn-purple" title="Search" role="button" id="published_note_search_button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='published-note-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id='admin_published_note_result'>
                       
                </div>
        
        </div>
    </section>

    <!-- Unpublish Note Modal -->
    <div class="modal fade" id="unpublishModal" tabindex="-1" role="dialog" aria-labelledby="unpublishModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <form method="post" id="unpublish_note_form">
                        <input type="hidden" name="unpublish_note_value" id="unpublish_note_id"/>
                        <div class="modal-header">
                            <h5 class="modal-title" id="unpublish_note_title"></h5>
                        </div>
                        <div class="modal-body">
                            <div id="unpublish-comment">
                                <div class="form-group">
                                    <label for="Remarks">Remarks</label>
                                    <textarea class="form-control" name="unpublish_remarks" id="unpublish-remarks" rows="4" placeholder="Write remarks"></textarea>
                                    <div id="unpublish_remark_alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group mr-2" id="unpublish-modal-btn" role="group">
                                <button type="submit" name="unpublish_note_btn_submit" class="btn btn-general">Unpublish</button>
                            </div>
                            <div class="btn-group mr-2" id="unpublish-modal-cancel-btn" role="group">
                                <a class="btn btn-general" data-dismiss="modal" aria-label="Close">cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<script>    
$(document).ready(function() {
    
    get_admin_published_note();
    
    function get_admin_published_note(page) {
        var admin_published_note = "admin_published_note";
        var published_note_search_field = $('#published-note-search-field').val();
        var published_by_seller = $("#published-note-by-seller").children("option:selected").val();
        
        $.ajax({
            url: "fetch_table.php",
            method:"POST",
            data:{admin_published_note:admin_published_note,published_note_search_field:published_note_search_field,published_by_seller:published_by_seller,published_page_no:page},
            success:function(data){
                $('#admin_published_note_result').html(data);
            }
        });
    }
    $('#published_note_search_button').click(function(){
        get_admin_published_note();
    });
    
    $("#published-note-by-seller").change(function(){
        get_admin_published_note();
    });
    
    $(document).on("click", "#admin_published_note_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_published_page_prev') {
            var current_page = $('#admin_published_note_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_admin_published_note(1);
            }
            else {
                get_admin_published_note(pageId);
            }
            
        }
        else if(pageId == 'admin_published_page_next') {
            var current_page = $('#admin_published_note_pagination li a.active').attr("id");
            var check_last = $('#admin_published_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_admin_published_note(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_admin_published_note(page_next);
            }
            
        }
        else {
            get_admin_published_note(pageId);
        }
      
    });
    
    $(document).on('click', '.unpublish_note', function() {
        var note_id = $(this).attr("id");
        var note_title = $(this).attr("rel");
        $('#unpublish_note_id').val(note_id);
        $('#unpublish_note_title').text(note_title);
        $('#unpublishModal').modal('show');
    });
    
    $('#unpublish_note_form').on('submit', function(event) {
        event.preventDefault();
        if($('#unpublish-remarks').val() == ''){
            $('#unpublish_remark_alert').text('Please Enter Remark');
        }else {
            $('#unpublish_remark_alert').text('');
            var check_confirmation = confirm('Are you sure you want to Unpublish this note?');
            var unpublish_note = "unpublish_note";
            
            if(check_confirmation) {
                $.ajax({
                    url: "NoteOperation.php",
                    method: "POST",
                    data:$('#unpublish_note_form').serialize()+"&unpublish_note=unpublish_note",
                    success:function(data) {
                        
                        $('#unpublish_note_form')[0].reset();
                        $('#unpublishModal').modal('hide');
                        alert('Note Unpublished.');
                        location.reload();
                        
                    }
                });
            }
            else {
                $('#unpublish_note_form')[0].reset();
                $('#unpublishModal').modal('hide');
            }
        }
    });
       
});
</script>