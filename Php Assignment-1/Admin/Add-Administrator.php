<html lang="en">

<head>

    <!-- important meta tags -->
     <!-- Title -->
    <title>Add Addministrator - Notes Marketplace</title>

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
   
      <h3 id="heading-add-administraor">Add Administrator</h3>  
    <br/>
  <div class="container"> 
    <form>
    <row>
        <div class="form-row" id="form-userprofile">
   
   
       <div class="form-group col-md-12">
      <label class="lab-name">First Name*</label>
      <input type="email" class="form-control" id="f-name" placeholder="Enter your first name" required>
      </div>  
     
      <div class="form-group col-md-12">
      <label class="lab-name">Last Name*</label>
      <input type="email" class="form-control" id="f-name" placeholder="Enter your first name" required>
      </div>  
       
       <div class="form-group col-md-12">
      <label class="lab-name">Email*</label>
      <input type="email" class="form-control" id="f-name" placeholder="Enter your first name" required>
      </div>  
     
        
         
        <div class="form-group col-md-2 col-sm-2 col-xs-2">

              <label class="lab-name">Phone Number</label>

             <select id="title-drp"class="form-control">

                    <option selected>+91</option>
                    <option></option>
                    <option></option>
                  </select>
                 
              </div> 
              
         <div class="form-group col-md-4 col-sm-4 col-xs-4 number-1">
                     <br/>
                    <input type="email" class="form-control" id="int-num" placeholder="Enter Your Phone number">
                </div>
    
   
        
   <div class="form-group col-md-12 col-sm-12 col-xs-12">                                  
         
           <button type="submit" class="btn-user-pro" >SUBMIT</button>
           </div> 
            
      
        </div>  
    </row>
   
      </form>
    </div>
         
          
           
            
             
              
               
                
                 
                  
                   
                    
                     
                      
                        




<br/>
  <br/>
  
  <br/>
  
  
  

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
