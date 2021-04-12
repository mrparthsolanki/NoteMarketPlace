<html lang="en">

<head>

     <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <!-- Title -->
    <title>Notes Under Review - Notes Marketplace</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">

    <!-- Costom CSS-->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
</head>



    

  
  
    

  <body>  



 <nav class="navbar fixed-top navbar-expand-lg navbar-light" id="mynav">
        <div class="container">
            <a class="navbar-brand" href="Dashboard.php"><img src="images/logo.png" alt="logo" class="img-responsive"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="notesdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="Notes-Under-Review.php">Notes Under Review</a>
                            <a class="dropdown-item" href="Published-Notes.php">Published Notes</a>
                            <a class="dropdown-item" href="Downloads-notes.php">Downloaded Notes</a>
                            <a class="dropdown-item" href="Rejected-notes.php">Rejected Notes</a>
                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Members.php">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="reportsdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="Spam-Reports.php">Spam Reports</a>
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="settingsdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="Manage-Syatem-Configuration.php">Manage System Configuration</a>
                            <a class="dropdown-item" href="Manage-Administrator.php">Manage Administrator</a>
                            <a class="dropdown-item" href="Manage-Category.php">Manage Category</a>
                            <a class="dropdown-item" href="Manage-Type.php">Manage Type</a>
                            <a class="dropdown-item" href="Manage-Country.php">Manage Countries</a>
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="userdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/admin.png" alt="User Image" class="img-responsive rounded-circle" id="nav-user-img"></a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="My-Profile.php">Update Profile</a>
                            <a class="dropdown-item" href="#">Change Password</a>
                            <a class="dropdown-item" href="login.php" id="user-logout">Logout</a>
                        </div>

                    </li>
                    <li class="nav-item">
                        <div class="login-btn">
                            <a class="nav-link btn btn-general btn-purple" href="login.html" id="home-login-btn" role="button">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
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
                            <tr>
                                <td>1</td>
                                <td><a href="NoteDetails-admin.html">Software Development</a></td>
                                <td>IT</td>
                                <td>Khayati Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>08-01-2021, 12:10</td>
                                <td>InReview</td>
                                <td>
                                    <div class="notes-under-review-action-btns" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="approve">
                                            <button type="button" class="btn btn-sm btn-success">Approve</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-secondary">In Review</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-notes-under-review dropleft">
                                            <a id="notes-under-review-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="NoteDetails-admin.html">Computer Basics</a></td>
                                <td>Computer</td>
                                <td>Rahul Shah</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>09-01-2021, 11:21</td>
                                <td>InReview</td>
                                <td>
                                    <div class="notes-under-review-action-btns" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="approve">
                                            <button type="button" class="btn btn-sm btn-success">Approve</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-secondary">In Review</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-notes-under-review dropleft">
                                            <a id="notes-under-review-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="NoteDetails-admin.html">Human Body</a></td>
                                <td>Science</td>
                                <td>Suman Trivedi</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>03-01-2021, 01:12</td>
                                <td>InReview</td>
                                <td>
                                    <div class="notes-under-review-action-btns" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="approve">
                                            <button type="button" class="btn btn-sm btn-success">Approve</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-secondary">In Review</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-notes-under-review dropleft">
                                            <a id="notes-under-review-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="NoteDetails-admin.html">World War</a></td>
                                <td>History</td>
                                <td>Raj Patel</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>02-01-2021, 11:12</td>
                                <td>InReview</td>
                                <td>
                                    <div class="notes-under-review-action-btns" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="approve">
                                            <button type="button" class="btn btn-sm btn-success">Approve</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-secondary">In Review</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-notes-under-review dropleft">
                                            <a id="notes-under-review-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="NoteDetails-admin.html">Accounts</a></td>
                                <td>Commerce</td>
                                <td>Raj Shah</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-seller-icon">
                                            <a href="MemberDetails.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                                <td>04-01-2021, 12:10</td>
                                <td>InReview</td>
                                <td>
                                    <div class="notes-under-review-action-btns" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2" role="group" aria-label="approve">
                                            <button type="button" class="btn btn-sm btn-success">Approve</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal">Reject</button>
                                        </div>
                                        <div class="btn-group mr-2" role="group" aria-label="reject">
                                            <button type="button" class="btn btn-sm btn-secondary">In Review</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-img">
                                        <div class="action-notes-under-review dropleft">
                                            <a id="notes-under-review-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="More" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Download Notes</a>
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
    
       
        <!-- Review Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <div class="modal-header">
                        <h5 class="modal-title">Book Title</h5>
                    </div>
                    <div class="modal-body">
                        <div id="reject-comment">
                            <div class="form-group">
                                <label for="Remarks">Remarks</label>
                                <textarea class="form-control" id="reject-remarks" rows="4" placeholder="Write remarks"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group mr-2" id="reject-modal-btn" role="group">
                            <a class="btn btn-general">Reject</a>
                        </div>
                        <div class="btn-group mr-2" id="reject-modal-cancel-btn" role="group">
                            <a class="btn btn-general" data-dismiss="modal" aria-label="Close">cancel</a>
                        </div>
                    </div>
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


