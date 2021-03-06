<html lang="en">

<head>

      <!-- important meta tags -->
   <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <!-- Title -->
    <title>Manage Administrator - Notes Marketplace</title>

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
                            <a class="dropdown-item" href="Spam-Reports.html">Spam Reports</a>
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
   
        
   <section id="manage-administrator-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-admin-heading">
                        <p>Manage Administrator</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-administrator-btn" id="add-administrator">
                                <a class="btn btn-general btn-purple" href="Add-Administrator.php" title="Add Administrator" role="button">Add Administrator</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="add-admin-search">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 offset-md-3">
                                        <input type="text" class="form-control" id="administrator-search" placeholder="Search">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="administrator-search-btn" id="search-administrator-btn">
                                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Khayati</td>
                                <td>Patel</td>
                                <td>mymail123@gmail.com</td>
                                <td>1234567890</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-admin">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-admin-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Khayati</td>
                                <td>Patel</td>
                                <td>mymail123@gmail.com</td>
                                <td>1234567890</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-admin">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-admin-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Khayati</td>
                                <td>Patel</td>
                                <td>mymail123@gmail.com</td>
                                <td>1234567890</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-admin">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-admin-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Khayati</td>
                                <td>Patel</td>
                                <td>mymail123@gmail.com</td>
                                <td>1234567890</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-admin">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-admin-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Khayati</td>
                                <td>Patel</td>
                                <td>mymail123@gmail.com</td>
                                <td>1234567890</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-admin">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-admin-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
       
    </section>

        
        
           <!--Footer-->
        
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


