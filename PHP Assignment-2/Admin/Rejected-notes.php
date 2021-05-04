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
                                <option value="Khayati">Khayati</option>
                                <option value="Rahul">Rahul</option>
                                <option value="Mayur">Mayur</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-6 text-right">
                    <div class="rejected-note-search-02">
                        <input type="text" class="form-control" id="rejected-note-search-field" placeholder="Search">
                        <div class="rejected-note-search-btn" id="rejected-note-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      
    <section id="rejected-note-info">
       
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="rejected-note-info-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Seller</th>
                                <th scope="col"></th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Rejected By</th>
                                <th scope="col">Remark</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php
                                $rejected_note_sql = "SELECT seller_notes.note_id, seller_notes.note_title, seller_notes.modified_date, seller_notes.admin_remarks, note_category.category_name,seller.user_first_name AS seller_first_name,seller.user_last_name AS seller_last_name, seller.user_id AS seller_id, seller_notes_attachment.attached_file_path, rejected_by.user_first_name AS rejected_by_first_name, rejected_by.user_last_name AS rejected_by_last_name FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users seller ON seller_notes.seller_id=seller.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN users rejected_by ON seller_notes.actioned_by=rejected_by.user_id WHERE seller_notes.is_note_active = 1 ";
                                $rejected_note_result = query($rejected_note_sql);
                                confirmQuery($rejected_note_result);
                            
                                if(row_count($rejected_note_result) > 0) {
                                    $sr_no = 1;
                                    while($row = fetch_array($rejected_note_result)) {
                                        $note_id = $row['note_id'];
                                        $note_title = $row['note_title'];
                                        $note_category_name= $row['category_name'];
                                        $date = $row['modified_date'];
                                        $admin_remarks = $row['admin_remarks'];
                                        $seller = $row['seller_first_name']." ".$row['seller_last_name'];
                                        $seller_id = $row['seller_id'];
                                        $rejected_by = $row['rejected_by_first_name']." ".$row['rejected_by_last_name'];
                                        $path = $row['attached_file_path'];
                                        
                                        $note_date = new DateTime($date);
                                        $note_date = $note_date->format('d-m-Y, H:i');
                                        
                                        echo "<tr>
                                <td>$sr_no</td>
                                <td><a href='NoteDetails-admin.php?note_id=$note_id'>$note_title</a></td>
                                <td>$note_category_name</td>
                                <td>$seller</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-rejected-seller-icon'>
                                            <a href='MemberDetails.php'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>$note_date</td>
                                <td>$rejected_by</td>
                                <td>$admin_remarks</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='action-rejected-note dropleft'>
                                            <a id='rejected-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a role='button' id='$note_id' class='dropdown-item approve_note' href=''>Approve</a>
                                                <a class='dropdown-item' href='Rejected-notes.php?admin_download_note=$path'>Download Notes</a>
                                                <a class='dropdown-item' href='NoteDetails-admin.php?note_id=$note_id'>View More Details</a>
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
                              
                                
   <br/>   <br/>  
  
  
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

<script>    
$(document).ready(function() {
    
    $(document).on('click', '.approve_note', function() {
        var note_id = $(this).attr("id");
        var action = "approve note";
        var admin_confirmation = confirm('If you approve the notes – System will publish the notes over portal. Please press yes to continue.');
        if(admin_confirmation) {
            $.ajax({
                url: "NoteOperation-admin.php",
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