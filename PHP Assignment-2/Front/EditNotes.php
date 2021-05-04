<?php  include "include/header.php"; ?>
<?php

if(isset($_SESSION['user_id']) and $_SESSION['user_role_id'] === '1') {
    
    if($_GET['edit_note_id']) {
        
        edit_note();
        
        $note_id = $_GET['edit_note_id'];
        
        $edit_note_sql = "SELECT * FROM seller_notes WHERE note_id = '{$note_id}'";
        $edit_note_result = query($edit_note_sql);
        confirmQuery($edit_note_result);
        $row = fetch_array($edit_note_result);
        
        $edit_note_title = $row['note_title'];
        $edit_note_category = $row['note_category'];
        $edit_note_type = $row['note_type'];
        $edit_note_country = $row['note_country'];
        $edit_note_description = $row['note_description'];
        $edit_note_number_of_pages = $row['note_number_of_pages'];
        $edit_note_university_name = $row['note_university_name'];
        $edit_note_course = $row['note_course'];
        $edit_note_course_code = $row['note_course_code'];
        $edit_note_professor = $row['note_professor'];
        $edit_note_sell_mode = $row['is_note_paid'];
        $edit_note_price = $row['note_price'];
?>
<?php include("page_header.php"); ?>
    
    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="addnote-top-img">
        <img src="images/Search/banner-with-overlay.jpg" alt="Image" class="img-responsive">
        <div id="addnote-top-content">
            <h1>Add Notes</h1>
        </div>    
    </section>

    <section id="addnote-heading">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="addnote-heading-bold">
                        <p>Basic Note Details</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <form action="" method="post" enctype="multipart/form-data" id="edit_note_form">
        <section id="addnote-notedetail-form-section">
            <div class="container">
                <div class="addnote-notedetail-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Title">Title *</label>
                                <input type="text" name="title" class="form-control" id="addnote-note-title" placeholder="Enter your note title" value="<?php echo $edit_note_title; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Category">Category *</label>
                                <select class="form-control" name="category" id="addnote-note-category" required>
                                    
                                    <?php
                                        $category_sql = "SELECT DISTINCT category_id,category_name FROM note_category WHERE is_active = '1'";
                                        $category_result = query($category_sql);
                                        confirmQuery($category_result);
    
                                        while($row = fetch_array($category_result)) {
                                            $category_id = $row['category_id'];
                                            $category_name = $row['category_name'];
                                            if($edit_note_category === $category_id) {
                                                echo "<option value='{$category_id}' style='text-transform:capitalize;' selected>{$category_name}</option>";
                                            }
                                            else {
                                                echo "<option value='{$category_id}' style='text-transform:capitalize;'>{$category_name}</option>";
                                            }
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Display Picture">Display Picture</label>
<!--                                <textarea class="form-control" id="addnote-note-displaypicture" rows="4" placeholder="Upload a picture"></textarea>-->
                                <label class="custom-file-upload">
                                    <input type="file" name="note_display_pic" id="note-dp-file-upload" />
                                    <img src="images/addnotes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a Picture</p>
                                </label>
                                <div id="note-DP-file-upload-filename"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Upload Notes">Upload Notes *</label>
<!--                                <textarea class="form-control" id="addnote-note-uploadnote" rows="4" placeholder="Upload your notes"></textarea>-->
                                <label class="custom-file-upload">
                                    <input type="file" name="note_pdf" id="note-pdf-file-upload" />
                                    <img src="images/addnotes/upload-note.png" alt="Upload Image" class="img-responsive"><br/><p>Upload your notes</p>
                                </label>
                                <div id="note-pdf-file-upload-filename"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Type">Type</label>
                                <select class="form-control" name="type" id="addnote-note-type" required>
                                    
                                    <?php
                                        $type_sql = "SELECT DISTINCT type_id,type_name FROM note_type WHERE is_active = '1'";
                                        $type_result = query($type_sql);
                                        confirmQuery($type_result);
    
                                        while($row = fetch_array($type_result)) {
                                            $type_id = $row['type_id'];
                                            $type_name = $row['type_name'];
                                            if($edit_note_type === $type_id) {
                                                echo "<option value='{$type_id}' style='text-transform:capitalize;' selected>{$type_name}</option>";
                                            }
                                            else {
                                                echo "<option value='{$type_id}' style='text-transform:capitalize;'>{$type_name}</option>";
                                            }
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Number of Pages">Number of Pages</label>
                                <input type="text" name="no_of_pages" class="form-control" id="addnote-note-pages" pattern="[0-9]*" placeholder="Enter number of note pages" value="<?php echo $edit_note_number_of_pages; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="Description">Description *</label>
                                <textarea class="form-control" name="description" id="addnote-note-description" rows="4" placeholder="Enter your description" required><?php echo $edit_note_description; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="addnote-heading-bold">
                            <p>Institute Information</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-institute-info-form-section">
            <div class="container">
                <div class="addnote-institute-info-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Country">Country</label>
                                <select class="form-control" name="country" id="addnote-note-country" required>
                                    
                                    <?php
                                        $country_sql = "SELECT DISTINCT country_id,country_name FROM note_country WHERE is_active = '1'";
                                        $country_result = query($country_sql);
                                        confirmQuery($country_result);
    
                                        while($row = fetch_array($country_result)) {
                                            $country_id = $row['country_id'];
                                            $country_name = $row['country_name'];
                                            if($edit_note_country === $country_id) {
                                                echo "<option value='{$country_id}' style='text-transform:capitalize;' selected>{$country_name}</option>";
                                            }
                                            else {
                                                echo "<option value='{$country_id}' style='text-transform:capitalize;'>{$country_name}</option>";
                                            }
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Institute Name">Institute Name</label>
                                <input type="text" name="institute" class="form-control" id="addnote-note-institute-name" placeholder="Enter your institute name" value="<?php echo $edit_note_university_name; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="addnote-heading-bold">
                            <p>Course Details</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-course-info-form-section">
            <div class="container">
                <div class="addnote-course-info-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Course Name">Course Name</label>
                                <input type="text" name="course_name" class="form-control" id="addnote-note-course-name" placeholder="Enter your course name" value="<?php echo $edit_note_course; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Course Code">Course Code</label>
                                <input type="text" name="course_code" class="form-control" id="addnote-note-course-code" placeholder="Enter your course code" value="<?php echo $edit_note_course_code; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Professor / Lecturer">Professor / Lecturer</label>
                                <input type="text" name="professor" class="form-control" id="addnote-note-professor-lecturer" placeholder="Enter your professor name" value="<?php echo $edit_note_professor; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="addnote-heading-bold">
                            <p>Selling Infromation</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="addnote-selling-info-form-section">
            <div class="container">
                <div class="addnote-selling-info-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sell for">Sell For *</label><br>
                                <?php
                                    
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sell_mode" id="selling-free" value="free" required>    
                                    <label class="form-check-label" for="free">Free</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sell_mode" id="selling-paid" value="paid" required>
                                    <label class="form-check-label" for="paid">Paid</label>
                                </div>
                            </div>
                            <div class="form-group" id="edit_show_sell_price">
                                <label for="Sell Price">Sell Price *</label>
                                <input type="text" name="sell_price" class="form-control" id="editnote-note-sell-price" placeholder="Enter your price" pattern="^[1-9]{1}[0-9]*(\.[0-9]{1,2})?$" value="<?php echo $edit_note_price; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Note Preview">Note Preview</label>
<!--                                <textarea class="form-control" id="addnote-note-preview" rows="4" placeholder="Upload a file"></textarea>-->
                                <label class="custom-file-upload">
                                    <input type="file" name="note_preview_pdf" id="note-preview-file-upload" />
                                    <img src="images/addnotes/upload-file.png" alt="Upload Image" class="img-responsive"><br/><p>Upload a file</p>
                                </label>
                                <div id="note-preview-file-upload-filename"></div>
                                <div id="note-preview-warning" style="color:red;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="addnote-save-btn" class="btn-group mr-2">
                                <button type="submit" name="save" class="btn btn-gneral btn-purple">Save</button>
                            </div>
                            <div id="addnote-publish-btn" class="btn-group mr-2">
                                <button type="submit" name="publish" class="btn btn-gneral btn-purple" onclick="javascript: return confirm('Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press ok to continue.');">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    
<?php include("page_footer.php"); ?>


<script>
$(document).ready(function() {
    var sell_type = <?php echo $edit_note_sell_mode; ?>;
    if(sell_type) {
        $("#selling-paid").prop("checked", true);
        $('#editnote-note-sell-price').prop('required', true);
    }
    else {
        $("#selling-free").prop("checked", true);
        $('#editnote-note-sell-price').val('');
        $('#editnote-note-sell-price').prop('required', false);
        $('#edit_show_sell_price').hide();
    }
    
    $('input[type="radio"]').change(function() {
        if($("#selling-paid").is(":checked")) {
            $('#edit_show_sell_price').show();
            $('#editnote-note-sell-price').prop("required", true);
            $("#note-preview-file-upload").prop('required',true);
            document.getElementById( 'note-preview-warning' ).textContent = 'Please Upload note preview for paid notes.';
        }
        else {
            $('#editnote-note-sell-price').prop("required", false);
            $('#edit_show_sell_price').hide();
            $("#note-preview-file-upload").prop('required',false);
            document.getElementById( 'note-preview-warning' ).textContent = '';
        }
        
    });
//    $('input[type="radio"]').click(function() {
//        if($("#selling-paid").is(":checked")) {
//            $('#editnote-note-sell-price').addAttr("required");
//        }
//        else{
//            $('#editnote-note-sell-price').prop('required', false);
//        }
//    });
    
})
</script>


<?php     
    }else {
        redirect('AddNotes-page.php');
    }
}
else {
    redirect('login.php');
}
?>