<html lang="en">

<head>

  
      <!-- important meta tags -->
   <!-- meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

    <!-- Title -->
    <title>Manage Country - Notes Marketplace</title>

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
            <a class="navbar-brand" href="Dashboard.html"><img src="images/logo.png" alt="logo" class="img-responsive"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="notesdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes</a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="Notes-Under-Review.html">Notes Under Review</a>
                            <a class="dropdown-item" href="Published-Notes.html">Published Notes</a>
                            <a class="dropdown-item" href="Downloads-notes.html">Downloaded Notes</a>
                            <a class="dropdown-item" href="Rejected-notes.html">Rejected Notes</a>
                        </div>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Members.html">Members</a>
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
                            <a class="dropdown-item" href="Manage-Syatem-Configuration.html">Manage System Configuration</a>
                            <a class="dropdown-item" href="Manage-Administrator.html">Manage Administrator</a>
                            <a class="dropdown-item" href="Manage-Category.html">Manage Category</a>
                            <a class="dropdown-item" href="Manage-Type.html">Manage Type</a>
                            <a class="dropdown-item" href="Manage-Country.html">Manage Countries</a>
                        </div>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="userdropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/admin.png" alt="User Image" class="img-responsive rounded-circle" id="nav-user-img"></a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="My-Profile.html">Update Profile</a>
                            <a class="dropdown-item" href="#">Change Password</a>
                            <a class="dropdown-item" href="login.html" id="user-logout">Logout</a>
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
        
     
        
       <section id="manage-country-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="manage-country-heading">
                        <p>Manage Country</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add-country-btn" id="add-country">
                                <a class="btn btn-general btn-purple" href="Add-Country.html" title="Add Country" role="button">Add Country</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="manage-country-search">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 offset-md-3">
                                        <input type="text" class="form-control" id="country-search" placeholder="Search">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="country-search-btn" id="search-country-btn">
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
                                <th scope="col">Country Name</th>
                                <th scope="col">Country Code</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>India</td>
                                <td>11</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Khyati Patel</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-country">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-country-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Australia</td>
                                <td>9</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Khyati Patel</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-country">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-country-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>USA</td>
                                <td>02</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Khyati Patel</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-country">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-country-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Japan</td>
                                <td>12</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Khyati Patel</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-country">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-country-action">
                                            <a href="#"><img src="images/Dashboard/delete.png" alt="Delete" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>UK</td>
                                <td>01</td>
                                <td>04-01-2021, 12:10</td>
                                <td>Khyati Patel</td>
                                <td>Yes</td>
                                <td>
                                    <div class="action-img">
                                        <div class="edit-country">
                                            <a href="#"><img src="images/Dashboard/edit.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="delete-country-action">
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


