 <?php include "Admin-page-header.php"; ?>
 <?php include "../Front/include/header.php"; ?>
  <?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_POST['type_submit'])){
        
        $admin_id = $_SESSION['user_id'];
        $type_name = $_POST['type_name'];
        $type_desc = $_POST['type_desc'];
        
        $add_type_query = "INSERT INTO note_type(type_name, type_description, created_by, modified_by) VALUES ('{$type_name}', '{$type_desc}', $admin_id, $admin_id)";
        
        $check_add_type_query = query($add_type_query);
        confirmQuery($check_add_type_query);
        redirect("Manage-Type.php");
        
    }
?> 
    <!-- Admin Navigation -->
<?php include "Admin_Navigation.php"; ?>  


 


   
      <h3 id="heading-add-type">Add Type</h3>  
    <br/>
  <div class="container"> 
  <form class="add-type-form" action="" method="post">
    <row>
        <div class="form-row" id="form-userprofile">
   
   
       <div class="form-group col-md-12">
      <label class="lab-name-1">Type*</label>
      <input type="text" name="type_name" class="form-control" id="f-name-1" placeholder="Enter Type Name" required>
      </div>  
     
      <div class="col-md-12" id="comments-1">
                     <label class="lab-name-1">Description*</label>
                    <input type="text-area" name="type_desc" class="form-control" id="cmt_que"  rows="4"  placeholder="Enter your description" required>
                    <br/>
        </div>
      
         
        
            <div class="row">
                    <div class="col-md-12">
                        <div id="add-type-submit-btn">
                            <button type="submit" name="type_submit" class="btn btn-gneral btn-purple">Submit</button>
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
  
   <!-- Footer -->
<?php include "Admin-page-footer.php"; ?> 