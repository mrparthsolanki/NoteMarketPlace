<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="search-top-img">
        <img src="images/Search/banner-with-overlay.jpg" alt="Image" class="img-responsive">
        <div id="search-top-content">
            <h2>Search Notes</h2>
        </div>
    </section>

    <section id="search-filter-notes">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-notes-title">
                        <h4>Search and Filter notes</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="search-notes-bar">
                        <div id="searchbar-1">
                            <input type="text" class="form-control form-control-lg" id="searchby-notes-name" placeholder="Search notes here...">
                        </div>

                        <div id="searchbar-2" class="form-inline">
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-type">
                                    <option value="" disabled selected>Select Type</option>
                                    
                                    <?php
                                        $type_sql = "SELECT DISTINCT type_id,type_name FROM note_type";
                                        $type_result = query($type_sql);
                                        confirmQuery($type_result);
    
                                        while($row = fetch_array($type_result)) {
                                            $type_id = $row['type_id'];
                                            $type_name = $row['type_name'];
                                            echo "<option value='{$type_id}' style='text-transform:capitalize;'>{$type_name}</option>";
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-category">
                                    <option value="" disabled selected>Select Category</option>
                                    
                                    <?php
                                        $category_sql = "SELECT DISTINCT category_id,category_name FROM note_category";
                                        $category_result = query($category_sql);
                                        confirmQuery($category_result);
    
                                        while($row = fetch_array($category_result)) {
                                            $category_id = $row['category_id'];
                                            $category_name = $row['category_name'];
                                            echo "<option value='{$category_id}' style='text-transform:capitalize;'>{$category_name}</option>";
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-university">
                                    <option value="" disabled selected>Select University</option>
                                    
                                    <?php
                                        $university_sql = "SELECT DISTINCT note_university_name FROM seller_notes WHERE is_note_active = 1 AND note_published_date IS NOT NULL";
                                        $university_result = query($university_sql);
                                        confirmQuery($university_result);
    
                                        while($row = fetch_array($university_result)) {
                                            $university = $row['note_university_name'];
                                            if(!empty($university)) {
                                                echo "<option value='{$university}' style='text-transform:capitalize;'>{$university}</option>";
                                            }
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-course">
                                    <option value="" disabled selected>Select Course</option>
                                    
                                    <?php
                                        $course_sql = "SELECT DISTINCT note_course FROM seller_notes WHERE is_note_active = 1";
                                        $course_result = query($course_sql);
                                        confirmQuery($course_result);
    
                                        while($row = fetch_array($course_result)) {
                                            $course = $row['note_course'];
                                            if(!empty($course)) {
                                                echo "<option value='{$course}' style='text-transform:capitalize;'>{$course}</option>";
                                            }
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-country">
                                    <option value="" disabled selected>Select Country</option>
                                    
                                    <?php
                                        $country_sql = "SELECT DISTINCT country_id,country_name FROM note_country";
                                        $country_result = query($country_sql);
                                        confirmQuery($country_result);
    
                                        while($row = fetch_array($country_result)) {
                                            $country_id = $row['country_id'];
                                            $country_name = $row['country_name'];
                                            echo "<option value='{$country_id}' style='text-transform:capitalize;'>{$country_name}</option>";
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-rating" style="margin-right: 0px;">
                                    <option value="" disabled selected>Select Rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="search_note_result"></div>
    
    
<?php include("page_footer.php"); ?>
<script>
$(document).ready(function() {
    
    get_search_notes();
    
    function get_search_notes(page) {
        var type = "search";
        var search_field = $('#searchby-notes-name').val();
        var search_type = $("#search-note-type").children("option:selected").val();
        var search_category = $("#search-note-category").children("option:selected").val();
        var search_university = $("#search-note-university").children("option:selected").val();
        var search_course = $("#search-note-course").children("option:selected").val();
        var search_country = $("#search-note-country").children("option:selected").val();
        var search_rating = $("#search-note-rating").children("option:selected").val();
//        alert(search_rating);
        $.ajax({
            url: "search_notes.php",
            method:"POST",
            data:{type:type,search_field:search_field,search_type:search_type,search_category:search_category,search_university:search_university,search_course:search_course,search_country:search_country,search_rating:search_rating,page_no:page},
            success:function(data){
                $('#search_note_result').html(data);
            }
        });
        
    }
    
    $('#searchby-notes-name').keyup(function() {
        get_search_notes();
    });
    
    $("#search-note-type").change(function(){
        get_search_notes();
    });
    
    $("#search-note-category").change(function(){
        get_search_notes();
    });
    
    $("#search-note-university").change(function(){
        get_search_notes();
    });
    
    $("#search-note-course").change(function(){
        get_search_notes();
    });
    
    $("#search-note-country").change(function(){
        get_search_notes();
    });
    
    $("#search-note-rating").change(function(){
        get_search_notes();
    });
    
    $(document).on("click", "#search_page_ul li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'search_page_prev') {
            var current_page = $('#search_page_ul li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_search_notes(1);
            }
            else {
                get_search_notes(pageId);
            }
            
        }
        else if(pageId == 'search_page_next') {
            var current_page = $('#search_page_ul li a.active').attr("id");
            var check_last = $('#search_page_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_search_notes(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_search_notes(page_next);
            }
            
        }
        else {
            get_search_notes(pageId);
        }
      
    });
    
});


</script>



