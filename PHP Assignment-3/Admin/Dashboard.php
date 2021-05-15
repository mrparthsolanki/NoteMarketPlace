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
<br/><br/><br/><br/>
    <!-- Dashboard -->
    <section id="dashboard-admin-info-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-heading">
                        <p>Dashboard</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
        $select_in_review_count_sql = "SELECT * FROM seller_notes JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value IN ('submitted for review', 'in review')";
        $select_in_review_count_result = query($select_in_review_count_sql);
        confirmQuery($select_in_review_count_result);
        $in_review_count = row_count($select_in_review_count_result);

        $select_downloaded_notes_count_sql = "SELECT * FROM downloads WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND attachment_downloaded_date > (NOW() - INTERVAL 7 DAY)";
        $select_downloaded_notes_count_result = query($select_downloaded_notes_count_sql);
        confirmQuery($select_downloaded_notes_count_result);
        $downloaded_notes_count = row_count($select_downloaded_notes_count_result);

        $select_new_members_count_sql = "SELECT * FROM users JOIN user_roles ON users.user_role_id=user_roles.role_id WHERE is_user_email_verified = 1 AND user_roles.role_name = 'member' AND users.created_date > (NOW() - INTERVAL 7 DAY)";
        $select_new_members_count_result = query($select_new_members_count_sql);
        confirmQuery($select_new_members_count_result);
        $new_members_count = row_count($select_new_members_count_result);
    ?>
    
    <!-- Dashboard -->
    <section id="dashboard-admin-info">
        <div class="container">
            <div class="row dashboard-info-row text-center">
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="Notes-Under-Review.php"><?php echo $in_review_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Number of Notes in Review for Publish</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="Downloads-notes.php"><?php echo $downloaded_notes_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Number of New Notes Downloaded<br>(Last 7 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="Members.php"><?php echo $new_members_count; ?></a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Number of New Registrations (Last 7 days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-published-notes">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="dash-head">
                        <h3>Published Notes</h3>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="dash-search">
                        <input type="text" class="form-control" id="search-published-note" placeholder="Search">
                        <div class="dash-search-btn" id="search-published-btn">
                            <a class="btn btn-general btn-purple" title="Search" role="button" id="dash_published_search_button">Search</a>
                        </div>
                        <div class="form-group">
                           
                            <select class="form-control" id="dash-search-by-month">
                                <?php
                                    $date = date("m");
                                    $day = date("d");
                                    $year = date("Y");
                                    for ($i = 1; $i <= 6; $i++) {

                                        $month = ("$year-$date-1");
                                        $new_date = new DateTime($month);
                                        $new_date = $new_date->format("F");
                                        if($i === 1) {
                                            echo "<option value='$date' selected>$new_date</option>";
                                        }
                                        else {
                                            echo "<option value='$date'>$new_date</option>";
                                        }
                                        
                                        $date = $date - 1;
                                        if($date === 0) {
                                            $date = 12;
                                        }
                                    }
                                ?>
                                
                                
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id='published-notes-info'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12 table-responsive' id="dash_published_notes_result">
                   
                </div>
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
    
    get_dashboard_published_note();
    
    function get_dashboard_published_note(page) {
        var dash_published = "dash_published";
        var dash_search_field = $('#search-published-note').val();
        var search_by_month = $("#dash-search-by-month").children("option:selected").val();
        $.ajax({
            url: "fetch_table.php",
            method:"POST",
            data:{dash_published:dash_published,dash_search_field:dash_search_field,search_by_month:search_by_month,dash_page_no:page},
            success:function(data){
                $('#dash_published_notes_result').html(data);
            }
        });
        
    }
    
    $('#dash_published_search_button').click(function(){
        get_dashboard_published_note();
    });
    
    $("#dash-search-by-month").change(function(){
        get_dashboard_published_note();
    });
    
    $(document).on("click", "#admin_dash_published_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'admin_page_prev') {
            var current_page = $('#admin_dash_published_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_dashboard_published_note(1);
            }
            else {
                get_dashboard_published_note(pageId);
            }
            
        }
        else if(pageId == 'admin_page_next') {
            var current_page = $('#admin_dash_published_pagination li a.active').attr("id");
            var check_last = $('#admin_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_dashboard_published_note(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_dashboard_published_note(page_next);
            }
            
        }
        else {
            get_dashboard_published_note(pageId);
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