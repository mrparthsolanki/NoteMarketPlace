 <?php include "Admin-page-header.php"; ?>
 <?php include "../Front/include/header.php"; ?>
   
    <!-- Admin Navigation -->
<?php include "Admin_Navigation.php"; ?>           
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_POST['country_submit'])){
        
        $admin_id = $_SESSION['user_id'];
        $country_name = $_POST['country_name'];
        $country_code = $_POST['country_code'];
        
        $add_country_query = "INSERT INTO note_country(country_name, country_code, created_by, modified_by) VALUES ('{$country_name}', '{$country_code}', $admin_id, $admin_id);";
        
        $check_add_country_query = query($add_country_query);
        confirmQuery($check_add_country_query);
        redirect("Manage-Country.php");
        
    }
?>
  
    
<h3 id="heading-add-Country">Add Country</h3>  
    <br/>
  <div class="container"> 
     <form class="add-country-form" action="" method="post">
        <row>
            <div class="form-row" id="form-userprofile">
             <div class="form-group col-md-12">
              <label class="lab-name-1">Country Name*</label>
      <input type="text" class="form-control" name="country_name" id="f-name-1" placeholder="Enter Country Name" required>
      </div> 
     
      <div class="col-md-12" id="comments-1">
                     <label class="lab-name-1">Country Code*</label>
                     <input type="text" class="form-control" name="country_code" id="f-name-1" placeholder="Enter Country Code" required>
                    <br/>
        </div>
      
        <div class="row">
                    <div class="col-md-12">
                        <div id="add-country-submit-btn">
                            <button type="submit" name="country_submit" class="btn btn-gneral btn-purple">Submit</button>
                        </div>
                    </div>
                </div>
        </div>  
    </row>
   
      </form>
    </div>
         
          
           
      


  
  <br/>
 

  <br/>
  
  <br/>
  <br/>
  <br/>
  <br/><br/><br/>

   <!-- Footer -->
<?php include "Admin-page-footer.php"; ?> 