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
    

      
<h3 id="heading-add-type">Dashboard</h3> 
    <!-- Dashboard -->
    <section id="dashboard-admin-info">
        <div class="container">
            <div class="row dashboard-info-row text-center">
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="NotesUnderReview.html">20</a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Number of Notes in Review for Publish</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="DownloadedNotes.html">103</a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Number of New Notes Downloaded<br>(Last 7 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="Members.html">223</a></h3>
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
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="dash-search-by-month">
                                <option value="" disabled selected>Select month</option>
                                <option value="Jan">Jan</option>
                                <option value="Feb">Feb</option>
                                <option value="March">March</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
       
      
       <section id="Genaeral-Table">
        
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="published-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Attachment Size</th>
                                <th scope="col">Sell Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Publisher</th>
                                <th scope="col">Published Date</th>
                                <th scope="col">Number of Downloadeds</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                                $dash_published_note_sql = "SELECT * FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users ON seller_notes.seller_id=users.user_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id  ";
                                $dash_published_note_result = query($dash_published_note_sql);
                                confirmQuery($dash_published_note_result);
                                if(row_count($dash_published_note_result) > 0) {
                                    $sr_no = 1;
                                    while($row = fetch_array($dash_published_note_result)) {
                                        $note_id = $row['note_id'];
                                        $note_title = $row['note_title'];
                                        $category_name = $row['category_name'];
                                        $sell_mode = $row['is_note_paid'];
                                        $note_price = round($row['note_price']);
                                        $publisher = $row['user_first_name']." ".$row['user_last_name'];
                                        $date = $row['note_published_date'];
                                        $note_path = $row['attached_file_path'];
                                        $filesize = filesize($note_path);
                                        $note_size = round($filesize). " KB";
                                        
                                        if($note_size > 999) {
                                            $note_size = round($note_size) . " MB";
                                        }
                                        
                                        if($sell_mode == 1) {
                                            $sell_type = "Paid";
                                        }
                                        else {
                                            $sell_type = "Free";
                                        }
                                        
                                        $published_date = new DateTime($date);
                                        $published_date = $published_date->format("d-m-Y, H:i");
                                        $note_downloads_count_sql = "SELECT count(download_id) AS note_downloads_count FROM downloads WHERE is_allowed_download = 1 AND downloaded_note_id = $note_id";
                                        
                                        $note_downloads_count_result = query($note_downloads_count_sql);
                                        confirmQuery($note_downloads_count_result);
                                        $row_count = fetch_array($note_downloads_count_result);
                                        $count = $row_count['note_downloads_count'];
                                        
                                        echo "<tr>
                                        <td>$sr_no</td>
                                        <td><a href='Note-details.php?note_id=$note_id'>$note_title</a></td>
                                        <td>$category_name</td>
                                        <td>$note_size</td>
                                        <td>$sell_type</td>
                                        <td>$$note_price</td>
                                        <td>$publisher</td>
                                        <td>$published_date</td>
                                        <td><a href='Downloads-notes.php'>$count</a></td>
                                        <td>
                                            <div class='action-img'>
                                                <div class='published-note-action dropleft'>
                                                    <a id='publishednote-admin-action-dropdownMenu' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                                                           <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                        <a class='dropdown-item' href='Dashboard.php?admin_download_note=$note_path'>Download Notes</a>
                                                        <a class='dropdown-item' href='Note-details.php?note_id=$note_id'>View More Details</a>
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
                                    echo "<h3 class='text-center' style='line-height:350px;'>No record found</h3>";

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

