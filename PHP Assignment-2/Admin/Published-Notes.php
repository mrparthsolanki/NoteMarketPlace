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
                download_attachment($path);
            }
        }
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
                                <option value="Khayati">Khayati</option>
                                <option value="Rahul">Rahul</option>
                                <option value="Mayur">Mayur</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="published-note-search">
                        <input type="text" class="form-control" id="published-note-search-field" placeholder="Search">
                        <div class="published-note-search-btn" id="notes-under-review-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
       <section id="published-note-info">
       
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="published-note-info-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sell Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Seller</th>
                                <th scope="col"></th>
                                <th scope="col">Published Date</th>
                                <th scope="col">Approved By</th>
                                <th scope="col">Number of Downloads</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $select_published_note_sql = "SELECT seller_notes.note_id, seller_notes.note_title, seller_notes.is_note_paid, seller_notes.note_price, seller_notes.note_published_date, note_category.category_name,seller.user_first_name AS seller_first_name,seller.user_last_name AS seller_last_name, seller.user_id AS seller_id, seller_notes_attachment.attached_file_path, approved_by.user_first_name AS approved_by_first_name, approved_by.user_last_name AS approved_by_last_name FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users seller ON seller_notes.seller_id=seller.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN users approved_by ON seller_notes.actioned_by=approved_by.user_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value = 'published' ORDER BY seller_notes.note_published_date DESC";
                                $select_published_note_result = query($select_published_note_sql);
                                confirmQuery($select_published_note_result);
                            
                                if(row_count($select_published_note_result) > 0) {
                                    
                                    $sr_no = 1;
                                    while($row = fetch_array($select_published_note_result)) {
                                        $note_id = $row['note_id'];
                                        $note_title = $row['note_title'];
                                        $note_category_name= $row['category_name'];
                                        $sell_mode = $row['is_note_paid'];
                                        $note_price = round($row['note_price']);
                                        $date = $row['note_published_date'];
                                        $seller = $row['seller_first_name']." ".$row['seller_last_name'];
                                        $seller_id = $row['seller_id'];
                                        $approved_by = $row['approved_by_first_name']." ".$row['approved_by_last_name'];
                                        $path = $row['attached_file_path'];
                                        
                                        $note_published_date = new DateTime($date);
                                        $note_published_date = $note_published_date->format('d-m-Y, H:i');
                                        
                                        if($sell_mode == 1) {
                                            $sell_type = "Paid";
                                        }
                                        else {
                                            $sell_type = "Free";
                                        }
                                        
                                        $downloads_count_sql = "SELECT * FROM downloads WHERE downloaded_note_id = $note_id AND is_allowed_download = 1 AND attachment_path IS NOT NULL";
                                        $downloads_count_result = query($downloads_count_sql);
                                        confirmQuery($downloads_count_result);
                                        $downloads_count = row_count($downloads_count_result);
                                        
                                        echo " <tr>
                                <td>$sr_no</td>
                                <td><a href='NoteDetails-admin.php?note_id=$note_id'>$note_title</a></td>
                                <td>$note_category_name</td>
                                <td>$sell_type</td>
                                <td>$$note_price</td>
                                <td>$seller</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-publisher-icon'>
                                            <a href='MemberDetails.php'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>$note_published_date</td>
                                <td>$approved_by</td>
                                <td><a href='DownloadedNotes.php'>$downloads_count</a></td>
                                <td>
                                    <div class='action-img'>
                                        <div class='action-published-note dropleft'>
                                            <a id='published-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='PublishedNotes.php?admin_download_note=$path'>Download Notes</a>
                                                <a class='dropdown-item' href='NoteDetails-admin.php?note_id=$note_id'>View More Details</a>
                                                <a role='button' class='dropdown-item unpublish_note' id='$note_id' rel='$note_title'>Unpublish</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                                        $sr_no += 1;
                                            
                                    }
                                    
                                }
                                else {
                                    echo "<h3 class='text-center' style='line-height:150px;'>No record found</h3>";
                                }
                            ?>
                           
                            
                            
                            
                            
                        </tbody>
                    </table>
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

