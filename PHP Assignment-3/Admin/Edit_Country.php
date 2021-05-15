<?php include "../Front/include/header.php"; ?>
<?php include "Admin-page-header.php"; ?>
<?php
    if(!isset($_SESSION['user_id']) or $_SESSION['user_role_id'] == 1) {
        header("Location: ../Front/login.php");
    }
    if(isset($_GET['country_id'])){
        
        $country_id_edit = $_GET['country_id'];
        $select_country_query = "SELECT * FROM note_country WHERE country_id = $country_id_edit";
        $check_select_country_query = query($select_country_query);
        confirmQuery($check_select_country_query);
        
        $row = fetch_array($check_select_country_query);
        $country_id = $row['country_id'];
        $country_name = $row['country_name'];
        $country_code = $row['country_code'];
        
        if(isset($_POST['country_update'])){
            
            $admin_id = $_SESSION['user_id'];
            $country_name = $_POST['country_name'];
            $country_code = $_POST['country_code'];
            
            $edit_country_query = "UPDATE note_country SET country_name = '{$country_name}', country_code = '{$country_code}', is_active = 1, modified_date = now(), modified_by = $admin_id WHERE country_id = $country_id_edit";

            $check_edit_country_query = query($edit_country_query);
            confirmQuery($check_edit_country_query);
            redirect("Manage-Country.php");
        } 
        
        ?>

    <!-- Admin Navigation -->
    <?php include "Admin_Navigation.php"; ?>

    <section class="add-country-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                     <h3 id="heading-add-category">Edit Country</h3>
                </div>
            </div>
        </div>
    </section>

    <section id="add-country-form-section">
        <div class="container">
            <form class="add-country-form" action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Country Name">Country Name *</label>
                            <input type="text" name="country_name" class="form-control" id="add-country-name" placeholder="Enter country name" value="<?php echo $country_name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Country Code">Country Code *</label>
                            <input type="text" name="country_code" class="form-control" id="add-country-code" placeholder="Enter country code" value="<?php echo $country_code; ?>" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="add-country-submit-btn">
                            <button type="submit" name="country_update" class="btn btn-gneral btn-purple">Update</button>
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
    redirect('ManageCountry.php');
}
?>