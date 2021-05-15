<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['type_id'])){
        
        $type_id_edit = $_GET['type_id'];
        $select_type_query = "SELECT * FROM note_type WHERE type_id = $type_id_edit";
        $check_select_type_query = query($select_type_query);
        confirmQuery($check_select_type_query);
        
        $row = fetch_array($check_select_type_query);
        $type_id = $row['type_id'];
        $type_name = $row['type_name'];
        $type_description = $row['type_description'];
        
        if(isset($_POST['type_update'])){
            
            $admin_id = $_SESSION['user_id'];
            $type_name = $_POST['type_name'];
            $type_desc = $_POST['type_desc'];
            
            $edit_type_query = "UPDATE note_type SET type_name = '{$type_name}', type_description = '{$type_desc}', is_active = 1, modified_date = now(), modified_by = $admin_id WHERE type_id = $type_id_edit";

            $check_edit_type_query = query($edit_type_query);
            confirmQuery($check_edit_type_query);
            redirect("Manage-Type.php");
            
        } 
        ?>
    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section class="add-type-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <h3 id="heading-add-category">Edit Type</h3>
                </div>
            </div>
        </div>
    </section>

    <section id="add-type-form-section">
        <div class="container">
            <form class="add-type-form" action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Type">Type *</label>
                            <input type="text" name="type_name" class="form-control" id="add-type-name" placeholder="Enter Type" value="<?php echo $type_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description *</label>
                            <textarea name="type_desc" class="form-control" id="type-description" rows="4" placeholder="Enter your description" required><?php echo $type_description; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="add-type-submit-btn">
                            <button type="submit" name="type_update" class="btn btn-gneral btn-purple">Update</button>
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
    redirect('Manage-Type.php');
}
?>