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
    if(isset($_GET['member_inreview_note'])) {
        $seller_id_dropdown = $_GET['member_inreview_note'];
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?> 

    <section id="notes-under-review">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="notes-under-review-head">
                        <p>Notes Under Review</p>
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
                    <div class="notes-under-review-search">
                        <div class="form-group">
                            <select class="form-control" id="notes-under-review-by-seller">
                                <option value="" disabled selected>Select Seller</option>
                                <?php
                                    $select_seller_notesUnderReview_sql = "SELECT DISTINCT seller_notes.seller_id,users.user_first_name,users.user_last_name FROM seller_notes JOIN users ON seller_notes.seller_id=users.user_id ORDER BY users.user_first_name ASC";
                                    $select_seller_notesUnderReview_result = query($select_seller_notesUnderReview_sql);
                                    confirmQuery($select_seller_notesUnderReview_result);
                                    while($row = fetch_array($select_seller_notesUnderReview_result)) {
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
                <div class="col-sm-8 col-md-6 text-right">
                    <div class="notes-under-review-search">
                        <input type="text" class="form-control" id="notes-under-review-search-field" placeholder="Search">
                        <div class="notes-under-review-search-btn" id="notes-under-review-btn">
                            <a class="btn btn-general btn-purple" title="Search" role="button" id="underReview_notes_search_button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='notes-under-review-info'>
        
            <div class='row'>
                <div class='col-md-12 table-responsive' id='Notes_UnderReview_result'>
                   
                </div>
        
        </div>
    </section>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <form method="post" id="reject_note_form">
                        <input type="hidden" name="reject_note_value" id="reject_note_id"/>
                        <div class="modal-header">
                            <h5 class="modal-title" id="reject_note_title"></h5>
                        </div>
                        <div class="modal-body">
                            <div id="reject-comment">
                                <div class="form-group">
                                    <label for="Remarks">Remarks</label>
                                    <textarea class="form-control" name="reject_remarks" id="reject-remarks" rows="4" placeholder="Write remarks"></textarea>
                                    <div id="reject_remark_alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group mr-2" id="reject-modal-btn" role="group">
                                <button type="submit" name="reject_note_btn_submit" class="btn btn-general" >Reject</button>
                            </div>
                            <div class="btn-group mr-2" id="reject-modal-cancel-btn" role="group">
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
    
    get_underReview_notes();
    
    function get_underReview_notes(page) {
        var Notes_UnderReview = "Notes_UnderReview";
        var Notes_UnderReview_search_field = $('#notes-under-review-search-field').val();
        var Notes_UnderReview_by_seller = $("#notes-under-review-by-seller").children("option:selected").val();
        $.ajax({
            url: "fetch_table.php",
            method:"POST",
            data:{Notes_UnderReview:Notes_UnderReview,Notes_UnderReview_search_field:Notes_UnderReview_search_field,Notes_UnderReview_by_seller:Notes_UnderReview_by_seller,UnderReview_page_no:page},
            success:function(data){
                $('#Notes_UnderReview_result').html(data);
            }
        });
    }
    
    $('#underReview_notes_search_button').click(function(){
        get_underReview_notes();
    });
    
    $("#notes-under-review-by-seller").change(function(){
        get_underReview_notes();
    });
    
    $(document).on("click", "#admin_underReview_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_underReview_page_prev') {
            var current_page = $('#admin_underReview_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_underReview_notes(1);
            }
            else {
                get_underReview_notes(pageId);
            }
            
        }
        else if(pageId == 'admin_underReview_page_next') {
            var current_page = $('#admin_underReview_pagination li a.active').attr("id");
            var check_last = $('#admin_underReview_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_underReview_notes(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_underReview_notes(page_next);
            }
            
        }
        else {
            get_underReview_notes(pageId);
        }
      
    });
    
    $(document).on('click', '.reject_note', function() {
        var note_id = $(this).attr("id");
        var note_title = $(this).attr("rel");
        $('#reject_note_id').val(note_id);
        $('#reject_note_title').text(note_title);
        $('#rejectModal').modal('show');
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
    
    $(document).on('click', '.in_review_note', function() {
        var note_id = $(this).attr("id");
        var in_review_note_action = "InReview note";
        var admin_confirmation_inReview = confirm('Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.”');
        if(admin_confirmation_inReview) {
            $.ajax({
                url: "NoteOperation.php",
                method: "POST",
                data:{in_review_note_action:in_review_note_action,note_id:note_id},
                success:function(data) {

                    location.reload();

                }
            });
        }
    });
    
    $('#reject_note_form').on('submit', function(event) {
        event.preventDefault();
        if($('#reject-remarks').val() == ''){
            $('#reject_remark_alert').text('Please Enter Remark');
        }else {
            $('#reject_remark_alert').text('');
            var test_confirmation = confirm('Are you sure you want to reject seller request?');
            var reject_note = "reject_note";
            
            if(test_confirmation) {
                $.ajax({
                    url: "NoteOperation.php",
                    method: "POST",
                    data:$('#reject_note_form').serialize()+"&reject_note=reject_note",
                    success:function(data) {
                        
                        $('#reject_note_form')[0].reset();
                        $('#rejectModal').modal('hide');
                        alert('Note Rejected.');
                        location.reload();
                        
                    }
                });
            }
            else {
                $('#reject_note_form')[0].reset();
                $('#rejectModal').modal('hide');
            }
        }
    });
    
});
</script>