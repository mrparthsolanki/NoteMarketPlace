 <?php include "Admin-page-header.php"; ?>
 <?php include "../Front/include/header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['admin_download_note'])) {
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['user_role_id'] == 2 or $_SESSION['user_role_id'] == 3) {
                $path = $_GET['admin_download_note'];
                download_attachment($path);
            }
        }
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
                                <option value="Khayati">Khayati</option>
                                <option value="Rahul">Rahul</option>
                                <option value="Mayur">Mayur</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6 text-right">
                    <div class="notes-under-review-search">
                        <input type="text" class="form-control" id="notes-under-review-search-field" placeholder="Search">
                        <div class="notes-under-review-search-btn" id="notes-under-review-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                      
<section id="notes-under-review-info">
        
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="notes-under-review-info-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Seller</th>
                                <th scope="col"></th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                            
                              <?php
                                $select_NotesUnderReview_sql = "SELECT seller_notes.note_id, seller_notes.note_title, note_category.category_name,users.user_id,users.user_first_name,users.user_last_name, seller_notes.created_date, seller_notes_attachment.attached_file_path, reference_data.value FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users ON seller_notes.seller_id=users.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id WHERE seller_notes.is_note_active = 1";
                                $select_NotesUnderReview_result = query($select_NotesUnderReview_sql);
                                confirmQuery($select_NotesUnderReview_result);
                            
                                if(row_count($select_NotesUnderReview_result) > 0) {
                                    $sr_no = 1;
                                    while($row = fetch_array($select_NotesUnderReview_result)) {
                                        $note_id = $row['note_id'];
                                        $note_title = $row['note_title'];
                                        $note_category = $row['category_name'];
                                        $seller_id = $row['user_id'];
                                        $seller = $row['user_first_name']." ".$row['user_last_name'];
                                        $date = $row['created_date'];
                                        $status =$row['value'];
                                        $note_path = $row['attached_file_path'];
                                        
                                        $date_added = new DateTime($date);
                                        $date_added = $date_added->format('d-m-Y, H:i');
                                        
                                        echo "<tr>
                                <td>$sr_no</td>
                                <td><a href='Note-details.php?note_id=$note_id'>$note_title</a></td>
                                <td>$note_category</td>
                                <td>$seller</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-seller-icon'>
                                            <a href='Member-Details.php?member_id=$seller_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>$date_added</td>
                                <td style='text-transform: capitalize;'>$status</td>
                                <td id='three-btn-row-td'>
                                    <div class='notes-under-review-action-btns' role='toolbar' aria-label='Toolbar with button groups'>
                                        <div class='btn-group mr-2' role='group' aria-label='approve'>
                                            <a role='button' class='btn btn-sm btn-success approve_note' id='$note_id'>Approve</a>
                                        </div>
                                        <div class='btn-group mr-2' role='group' aria-label='reject'>
                                            <a role='button' class='btn btn-sm btn-danger reject_note' id='$note_id' rel='$note_title'>Reject</a>
                                        </div>
                                        <div class='btn-group mr-2' role='group' aria-label='inreview'>
                                            <a role='button' class='btn btn-sm btn-secondary in_review_note' id='$note_id'>InReview</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class='action-img'>
                                        <div class='action-notes-under-review dropleft'>
                                            <a id='notes-under-review-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='NoteDetails-admin.php?note_id=$note_id'>View More Details</a>
                                                <a class='dropdown-item' href='NotesUnderReview.php?admin_download_note=$note_path'>Download Notes</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                                        $sr_no += 1;
                                    }            
                        
                                }
                                else {
                                    echo "<h3 class='text-center' style='line-height:250px;'>No record found</h3>";
                                }
                            ?>
                           
                        </tbody>
                    </table>
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
       
       
     <section id="dash-pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
                            
                              
      
 <!-- Footer -->
<?php include "Admin-page-footer.php"; ?>   

<script>    
$(document).ready(function() {
    
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

