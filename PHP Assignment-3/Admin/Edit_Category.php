<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['cate_id'])){
        $cate_id_edit = $_GET['cate_id'];
        $select_category_query = "SELECT * FROM note_category WHERE category_id = $cate_id_edit";
        $check_select_category_query = query($select_category_query);
        confirmQuery($check_select_category_query);
        
        $row = fetch_array($check_select_category_query);
        $category_id = $row['category_id'];
        $category_name = $row['category_name'];
        $category_description = $row['category_description'];
        
        if(isset($_POST['category_update'])){
            
            $admin_id = $_SESSION['user_id'];
            $category_name = $_POST['category_name'];
            $category_desc = $_POST['category_desc'];
            $edit_category_query = "UPDATE note_category SET category_name = '{$category_name}', category_description = '{$category_desc}', is_active = 1, modified_date = now(), modified_by = $admin_id WHERE category_id = $cate_id_edit";

            $check_edit_category_query = query($edit_category_query);
            confirmQuery($check_edit_category_query);
            redirect("Manage-Category.php");
        } 
        
?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>
    
    
    <section class="add-category-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 id="heading-add-category">Edit Category</h3>
                </div>
            </div>
        </div>
    </section>

    <section id="add-category-form-section">
        <div class="container">
            <form class="add-category-form" action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Category Name">Category Name *</label>
                            <input type="text" name="category_name" class="form-control" id="add-category-name" placeholder="Enter category name" value="<?php echo $category_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description *</label>
                            <textarea class="form-control" name="category_desc" id="category-description" rows="4" placeholder="Enter your description" required><?php echo $category_description; ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="add-category-submit-btn">
                            <button class="btn btn-gneral btn-purple" type="submit" name="category_update">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<br/><br/><br/><br/><br/><br/>
<!-- Footer -->
<?php include "Admin-page-footer.php"; ?>     
<?php
    }
else {
    redirect('Manage-Category.php');
}
?>