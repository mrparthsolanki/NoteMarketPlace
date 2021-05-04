<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>
      
                      
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
                              <?php
                                $select_country_query = "SELECT note_country.country_id, note_country.country_name, note_country.country_code, note_country.created_date, note_country.is_active, users.user_first_name, users.user_last_name FROM note_country JOIN users ON note_country.created_by=users.user_id ORDER BY note_country.created_date DESC";
                                $check_select_country_query = query($select_country_query);
                                confirmQuery($check_select_country_query);
                                $sr_no = 1;
                                $active = "Yes";
                                while($row = fetch_array($check_select_country_query)){
                                    $country_id = $row['country_id'];
                                    $country_name = $row['country_name'];
                                    $country_code = $row['country_code'];
                                    $is_country_active = $row['is_active'];
                                    $country_date_added = $row['created_date'];
                                    $country_added_by_user = $row['user_first_name']." ".$row['user_last_name'];
                                    if ($is_country_active == 1){
                                        $active = "Yes";
                                    }
                                    else{
                                        $active = "No";
                                    }
                                    $date = new DateTime($country_date_added);

                                    $date = $date->format('d-m-Y, H:i');
                                    echo "<tr>
                                            <td>{$sr_no}</td>
                                            <td>{$country_name}</td>
                                            <td>{$country_code}</td>
                                            <td>{$date}</td>
                                            <td>{$country_added_by_user}</td>
                                            <td>{$active}</td>
                                            <td>
                                                <div class='action-img'>
                                                    <div class='edit-country'>
                                                        <a href='Edit_Country.php?country_id=$country_id'><img src='images/Dashboard/edit.png' alt='Edit' class='img-risponsive'></a>
                                                    </div>
                                                    <div class='delete-country-action'>
                                                        <a href='include/delete_category.php?country_id=$country_id'><img src='images/Dashboard/delete.png' alt='Delete' class='img-risponsive'></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                    
                                    $sr_no += 1;
                                }
                            ?>   
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


