<?php include "../Front/include/header.php"; ?>
 <?php include "Admin-page-header.php"; ?>
 <?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_POST['category_submit'])){
        $admin_id = $_SESSION['user_id'];
        $category_name = $_POST['category_name'];
        $category_desc = $_POST['category_desc'];
        
        $add_category_query = "INSERT INTO note_category(category_name, category_description, created_by,  modified_by) 
        VALUES ('{$category_name}', '{$category_desc}', $admin_id, $admin_id)";
        
        $check_add_category_query = query($add_category_query);
        confirmQuery($check_add_category_query);
         redirect("Manage-Category.php");
        
    }
?>
   <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>


   
      
    <br/>
  <div class="container"> 
    
      <form class="add-category-form" action="" method="post">
    <row>
        
        <div class="form-row" id="form-userprofile">
   
    <h3 id="heading-add-category">Add Category</h3>
       <div class="form-group col-md-12">
      <label class="lab-name-1">Category Name*</label>
      <input type="text" class="form-control" id="f-name-1" name="category_name" placeholder="Enter Category Name" required>
      </div>  
     
      <div class="col-md-12" id="comments-1">
                     <label class="lab-name-1">Description*</label>
                    <input type="text-area" class="form-control" name="category_desc" id="cmt_que" placeholder="Enter your description" required>
                    <br/>
        </div>
      
         
        
           <div class="row">
                    <div class="col-md-12">
                        <div id="add-category-submit-btn">
                            <button class="btn btn-gneral btn-purple" type="submit" name="category_submit">Submit</button>
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
