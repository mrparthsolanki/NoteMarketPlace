<html lang="en">

<head>
 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <!-- Title -->
    <title>Dashboard - Notes Marketplace</title>

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


 

    
    <!--header--->
  
    


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
                            <a class="nav-link btn btn-general btn-purple" href="login.php" id="home-login-btn" role="button">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
     

      <body>
         <h3 id="heading-add-type">Dashboard</h3> 
         <section class="dashboard-1">
        
        
      
        
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
                            <tr>
                                <td>1</td>
                                <td><a href="NoteDetails-admin.html">Data Science</a></td>
                                <td>Science</td>
                                <td>10 KB</td>
                                <td>Paid</td>
                                <td>$250</td>
                                <td>Pritesh Panchal</td>
                                <td>03-01-2021, 11:20</td>
                                <td><a href="DownloadedNotes.html">10</a></td>
                                <td>
                                    <div class="action-img">
                                        <div class="published-note-action dropleft">
                                            <a id="publishednote-admin-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Unpublish</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="NoteDetails-admin.html">Accounts</a></td>
                                <td>Commerce</td>
                                <td>23 MB</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>Rajesh Panchal</td>
                                <td>01-01-2021, 01:20</td>
                                <td><a href="DownloadedNotes.html">15</a></td>
                                <td>
                                    <div class="action-img">
                                        <div class="published-note-action dropleft">
                                            <a id="publishednote-admin-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Unpublish</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="NoteDetails-admin.html">Social Studies</a></td>
                                <td>Social</td>
                                <td>11 KB</td>
                                <td>Paid</td>
                                <td>$290</td>
                                <td>Pritesh Panchal</td>
                                <td>03-01-2021, 11:20</td>
                                <td><a href="DownloadedNotes.html">13</a></td>
                                <td>
                                    <div class="action-img">
                                        <div class="published-note-action dropleft">
                                            <a id="publishednote-admin-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Unpublish</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="NoteDetails-admin.html">AI</a></td>
                                <td>IT</td>
                                <td>10 MB</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>Rahil Benim</td>
                                <td>12-11-2020, 09:20</td>
                                <td><a href="DownloadedNotes.html">5</a></td>
                                <td>
                                    <div class="action-img">
                                        <div class="published-note-action dropleft">
                                            <a id="publishednote-admin-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Unpublish</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="NoteDetails-admin.html">Data Structure</a></td>
                                <td>Science</td>
                                <td>20 MB</td>
                                <td>Paid</td>
                                <td>$400</td>
                                <td>Umang Patel</td>
                                <td>03-01-2021, 11:20</td>
                                <td><a href="DownloadedNotes.html">11</a></td>
                                <td>
                                    <div class="action-img">
                                        <div class="published-note-action dropleft">
                                            <a id="publishednote-admin-action-dropdownMenu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Download Notes</a>
                                                <a class="dropdown-item" href="NoteDetails-admin.html">View More Details</a>
                                                <a class="dropdown-item" href="#">Unpublish</a>
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


