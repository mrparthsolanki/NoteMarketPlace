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
    if(isset($_GET['delete_report'])) {
        $delete_id = $_GET['delete_report'];
        if(isset($_SESSION['user_id'])) {
            if($_SESSION['user_role_id'] == 2 or $_SESSION['user_role_id'] == 3) {
                
                $delete_report_sql = "DELETE FROM `reported_note` WHERE `report_id` = $delete_id";
                $delete_report_result = query($delete_report_sql);
                confirmQuery($delete_report_result);
                redirect("Spam-Reports.php");
                
            }
        }
    }
?>
    <!-- Admin Navigation -->
<?php include "Admin_Navigation.php"; ?>   
      
    <section id="spam-report">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="spam-report-head">
                        <p>Spam Reports</p>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="spam-report-search">
                        <input type="text" class="form-control" id="search-spam-report" placeholder="Search">
                        <div class="spam-report-search-btn" id="spam-report-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="spam-report-info">
        
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="spam-report-info-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Reported By</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Remark</th>
                                <th scope="col">Action</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                           
                            <?php
                                $select_spam_sql = "SELECT reported_note.report_id, reported_note.reported_note_id, reported_note.report_remarks, reported_note.created_date, downloads.attachment_path, downloads.note_title, downloads.note_category, users.user_first_name, users.user_last_name FROM reported_note JOIN downloads ON reported_note.against_download_id=downloads.download_id JOIN users ON reported_note.reported_by_id=users.user_id ORDER BY reported_note.modified_date DESC";
                                $select_spam_result = query($select_spam_sql);
                                confirmQuery($select_spam_result);
                                
                                if(row_count($select_spam_result) > 0) {
                                    $sr_no = 1;
                                    while($row = fetch_array($select_spam_result)) {
                                        $report_id = $row['report_id'];
                                        $reported_note_id = $row['reported_note_id'];
                                        $report_remarks = $row['report_remarks'];
                                        $created_date = $row['created_date'];
                                        $note_path = $row['attachment_path'];
                                        $note_title = $row['note_title'];
                                        $note_category = $row['note_category'];
                                        $reported_by = $row['user_first_name']." ".$row['user_last_name'];
                                        
                                        $added_date = new DateTime($created_date);
                                        $added_date = $added_date->format("d-m-Y, H:i");
                                        
                                        echo "<tr>
                                <td>$sr_no</td>
                                <td>$reported_by</td>
                                <td><a href='NoteDetails-admin.php?note_id=$reported_note_id'>$note_title</a></td>
                                <td>$note_category</td>
                                <td>$added_date</td>
                                <td>$report_remarks</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='delete-spam-report'>
                                            <a onclick='javascript: return confirm(\"Are you sure you want to delete reported issue\");' href='SpamReports.php?delete_report=$report_id'><img src='images/Dashboard/delete.png' alt='More' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class='action-img'>
                                        <div class='action-members dropleft'>
                                            <a id='spam-report-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='SpamReports.php?admin_download_note=$note_path'>Download Notes</a>
                                                <a class='dropdown-item' href='NoteDetails-admin.php?note_id=$reported_note_id'>View More Details</a>
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
                           
                           
                           
                           
                            <tr>
                                <td>1</td>
                                <td>Khayati Patel</td>
                                <td><a href="Note-details.php">Software Development</a></td>
                                <td>IT</td>
                                <td>09-01-2021, 10:10</td>
                                <td>Lorem ipsum dolor sit consectetur.</td>
                                <td>
                                    <div class="action-img">
                                        <div class="delete-spam-report">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="More" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-members dropleft">
                                            <a id="spam-report-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="Note-details.php">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Rahul Shah</td>
                                <td><a href="Note-details.php">Computer Basics</a></td>
                                <td>Computer</td>
                                <td>08-01-2021, 09:10</td>
                                <td>Lorem ipsum dolor sit consectetur.</td>
                                <td>
                                    <div class="action-img">
                                        <div class="delete-spam-report">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="More" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-members dropleft">
                                            <a id="spam-report-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="Note-details.php">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Suman Trivedi</td>
                                <td><a href="Note-details.php">Human Body</a></td>
                                <td>Science</td>
                                <td>07-01-2021, 11:22</td>
                                <td>Lorem ipsum dolor sit consectetur.</td>
                                <td>
                                    <div class="action-img">
                                        <div class="delete-spam-report">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="More" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-members dropleft">
                                            <a id="spam-report-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="Note-details.php">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Raj Malhotra</td>
                                <td><a href="Note-details.php">World War 2</a></td>
                                <td>History</td>
                                <td>05-01-2021, 10:20</td>
                                <td>Lorem ipsum dolor sit consectetur.</td>
                                <td>
                                    <div class="action-img">
                                        <div class="delete-spam-report">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="More" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-img">
                                            <div class="action-members dropleft">
                                                <a id="spam-report-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="#">Download Notes</a>
                                                    <a class="dropdown-item" href="Note-details.php">View More Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Niya Patel</td>
                                <td><a href="Note-details.php">Accounting</a></td>
                                <td>Account</td>
                                <td>03-01-2021, 12:10</td>
                                <td>Lorem ipsum dolor sit consectetur.</td>
                                <td>
                                    <div class="action-img">
                                        <div class="delete-spam-report">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="More" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-img">
                                            <div class="action-members dropleft">
                                                <a id="spam-report-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="#">Download Notes</a>
                                                    <a class="dropdown-item" href="Note-details.php">View More Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
                              
   


<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>

