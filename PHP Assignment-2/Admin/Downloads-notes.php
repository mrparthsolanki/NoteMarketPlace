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
       
       
        
     <h3 id="heading-download-notes">Dashboard</h3> 
        
      
  
           
            <div class="row drp">
                <div class="col-sm-12 col-md-6">
                    <div class="downloaded-note-search-01">
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Note</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-name">
                                        <option class="downloaded-note-dropdown-selected" value="" disabled selected>Select note</option>
                                        <option value="Science">Science</option>
                                        <option value="Commerece">Commerece</option>
                                        <option value="Arts">Arts</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Seller</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-seller">
                                        <option value="" disabled selected>Select seller</option>
                                        <option value="Rahul">Rahul</option>
                                        <option value="Khayati">Khayati</option>
                                        <option value="Vansh">Vansh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <label class="downloaded-note-label">Buyer</label>
                                <div class="form-group">
                                    <select class="form-control" id="downloaded-note-by-buyer">
                                        <option value="" disabled selected>Select buyer</option>
                                        <option value="Rahul">Rahul</option>
                                        <option value="Khayati">Khayati</option>
                                        <option value="Vansh">Vansh</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right sear-box">
                    <label></label>
                    <div class="downloaded-note-search-02">
                        <div class="form-group">
                            <input type="text" class="form-control" id="downloaded-note-search-field" placeholder="Search">
                        </div>
                        <div class="downloaded-note-search-btn" id="downloaded-note-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        
  
    <section id="Genaeral-Table">
        
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="published-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Buyer</th>
                                <th scope="col"></th>
                                <th scope="col">Seller</th>
                                <th scope="col"></th>
                                <th scope="col">Sell Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Downloaded Date/Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $downloaded_note_sql = "SELECT downloads.download_id, downloads.downloaded_note_id,downloads.attachment_path,downloads.attachment_downloaded_date,downloads.is_note_paid,downloads.purchased_price,downloads.note_title,downloads.note_category,buyer.user_id AS buyer_id,buyer.user_first_name AS buyer_firstname,buyer.user_last_name AS buyer_lastname,seller.user_id AS seller_id,seller.user_first_name AS seller_firstname,seller.user_last_name AS seller_lastname FROM downloads JOIN users buyer ON buyer.user_id=downloads.downloader JOIN users seller ON downloads.seller=seller.user_id WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL ORDER BY downloads.attachment_downloaded_date DESC";
                                $downloaded_note_result = query($downloaded_note_sql);
                                confirmQuery($downloaded_note_result);
                                if(row_count($downloaded_note_result) > 0) {
                                    $sr_no = 1;
                                    while($row = fetch_array($downloaded_note_result)) {
                                        $download_id = $row['download_id'];
                                        $note_id = $row['downloaded_note_id'];
                                        $note_title = $row['note_title'];
                                        $category_name = $row['note_category'];
                                        $sell_mode = $row['is_note_paid'];
                                        $note_price = round($row['purchased_price']);
                                        $buyer_id = $row['buyer_id'];
                                        $buyer = $row['buyer_firstname']." ".$row['buyer_lastname'];
                                        $seller_id = $row['seller_id'];
                                        $seller = $row['seller_firstname']." ".$row['seller_lastname'];
                                        $date = $row['attachment_downloaded_date'];
                                        $note_path = $row['attachment_path'];
                                                                                
                                        if($sell_mode == 1) {
                                            $sell_type = "Paid";
                                        }
                                        else {
                                            $sell_type = "Free";
                                        }
                                        
                                        $downloaded_date = new DateTime($date);
                                        $downloaded_date = $downloaded_date->format("d-m-Y, H:i");
                                        
                                        echo "<tr>
                                <td>$sr_no</td>
                                <td><a href='Note-Details.php?note_id=$note_id'>$note_title</a></td>
                                <td>$category_name</td>
                                <td>$buyer</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-downloaded-buyer-icon'>
                                            <a href='Member-Details.php'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>$seller</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-downloaded-seller-icon'>
                                            <a href='Member-Details.php'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                    </div>
                                </td>
                                <td>$sell_type</td>
                                <td>$$note_price</td>
                                <td>$downloaded_date</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='action-downloaded-note dropleft'>
                                            <a id='downloaded-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='Downloads-notes.php?admin_download_note=$note_path'>Download Notes</a>
                                                <a class='dropdown-item' href='Note-details.php?note_id=$note_id'>View More Details</a>
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
                               
                           
                           
                            <tr>
                                <td>1</td>
                                <td><a href="NoteDetails-admin.html">Computer Basic</a></td>
                                <td>Computer</td>
                                <td>Niya Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-buyer-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Khayati Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Paid</td>
                                <td>$45</td>
                                <td>01-01-2021, 09:11</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-downloaded-note dropleft">
                                            <a id="downloaded-note-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="NoteDetails-admin.html">Software Development</a></td>
                                <td>IT</td>
                                <td>Rahul Shah</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-buyer-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Raj Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>02-01-2021, 10:11</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-downloaded-note dropleft">
                                            <a id="downloaded-note-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="NoteDetails-admin.html">Human Body</a></td>
                                <td>Science</td>
                                <td>Rakesh Raj</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-buyer-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Khayati Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Paid</td>
                                <td>$100</td>
                                <td>03-01-2021, 09:00</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-downloaded-note dropleft">
                                            <a id="downloaded-note-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="NoteDetails-admin.html">Accounting</a></td>
                                <td>Account</td>
                                <td>Niya Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-buyer-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Ronit Gajera</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>05-01-2021, 09:11</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-downloaded-note dropleft">
                                            <a id="downloaded-note-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="NoteDetails-admin.html">Social Science</a></td>
                                <td>History</td>
                                <td>Kunj Shah</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-buyer-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Parth Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-downloaded-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>Paid</td>
                                <td>$450</td>
                                <td>06-01-2021, 09:11</td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-downloaded-note dropleft">
                                            <a id="downloaded-note-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
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
 
                

  
  

   <!--Footer-->
        
    <footer>
        <hr>
        <div class="container">
            <div class="row" id="footer-content">
                <div class="col-xs-7 col-sm-7 col-md-6">
                    <div class="footer-line">
                        <p>Copyright &copy; Tatvasoft All rights reserved.</p>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 text-right">
                    <ul class="social-list">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
  <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>
  
    
</body>



</html>          


