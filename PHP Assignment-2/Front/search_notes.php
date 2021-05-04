<?php  include "include/header.php"; ?>
<?php
    if(isset($_POST["type"])) {
        $serached_note_output = "";
            
        $limit = 3;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_note_sql_1 = " SELECT * FROM seller_notes JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE is_note_active = 1 AND ref_category = 'note status' AND value = 'published'";
        
        if(isset($_POST['search_field'])) {
            $search_field = $_POST['search_field'];
            $select_note_sql_1 .= " AND note_title LIKE '%$search_field%'";
        }
        if(isset($_POST['search_type'])) {
            $search_type = $_POST['search_type'];
            if(!empty($search_type))
                $select_note_sql_1 .= " AND note_type = $search_type";
        }
        if(isset($_POST['search_category'])) {
            $search_category = $_POST['search_category'];
            if(!empty($search_category))
                $select_note_sql_1 .= " AND note_category = $search_category";
        }
        if(isset($_POST['search_university'])) {
            $search_university = $_POST['search_university'];
            if(!empty($search_university))
                $select_note_sql_1 .= " AND note_university_name = '$search_university'";
        }
        if(isset($_POST['search_course'])) {
            $search_course = $_POST['search_course'];
            if(!empty($search_course))
                $select_note_sql_1 .= " AND note_course = '$search_course'";
        }
        if(isset($_POST['search_country'])) {
            $search_country = $_POST['search_country'];
            if(!empty($search_country))
                $select_note_sql_1 .= " AND note_country = $search_country";
        }
        if(isset($_POST['search_rating'])) {
            $search_rating = $_POST['search_rating'];
            if(!empty($search_rating))
                $select_note_sql_1 .= " AND (note_id,$search_rating) IN (SELECT review_note_id,     ROUND(AVG(`review_rating`),0) FROM note_reviews WHERE is_review_active = 1 GROUP BY `review_note_id`)";
        }
        
        $select_note_sql_1 .= " ORDER BY seller_notes.note_published_date DESC";
        $select_note_result_1 = query($select_note_sql_1);
        confirmQuery($select_note_result_1);
        $total_notes = row_count($select_note_result_1);
        
        if($total_notes > 0) {
            $serached_note_output .= "<section id='total-notes'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='search-notes-title'>
                        <h4>Total $total_notes notes</h4>
                    </div>
                </div>
            </div>
            
            <div class='row'>";
            
            $select_note_sql_2 = $select_note_sql_1." LIMIT $offset, $limit";
            $select_note_result_2 = query($select_note_sql_2);
            confirmQuery($select_note_result_2);
            
            while($row = fetch_array($select_note_result_2)) {
                $note_id = $row['note_id'];
                $seller_id = $row['seller_id'];
                $note_title = $row['note_title'];
                $note_image = $row['note_display_picture'];
                $note_no_of_page = $row['note_number_of_pages'];
                $note_university_name = $row['note_university_name'];
                $note_published_date = $row['note_published_date'];

                if(empty($note_image)) {
//                    $note_image = "images/Search/1.jpg";
                    $select_msc_data_sql = "SELECT * FROM system_config";
                    $select_msc_data_result = query($select_msc_data_sql);
                    confirmQuery($select_msc_data_result);
                    $results = array();
                    while($default_note_img_row = fetch_array($select_msc_data_result)) {
                        $results[$default_note_img_row['key']] = $default_note_img_row['value'];
                    }
                    $note_image = $results['DefaultNoteDisplayPicture'];
                    
                }
                if(empty($note_university_name)) {
                    $note_university_name = "N/A";
                }
                if($note_no_of_page == 0) {
                    $note_no_of_page = "N/A";
                }

                $note_date = new DateTime($note_published_date);
                $note_date = $note_date->format('D, M d Y');
                $serached_note_output .= "<div class='col-md-4'>
                        <div class='notes-card'>
                            <div class='notes-card-img'>
                                <img src='{$note_image}' alt='note' class='img-responsive'>
                            </div>
                            <div class='notes-card-content'>
                                <h5><a href='Note_Details.php?note_id={$note_id}'>{$note_title}</a></h5>
                                <ul class='notes-card-content-details'>
                                    <li><i class='fa fa-university'></i><span>{$note_university_name}</span></li>
                                    <li><i class='fa fa-book'></i><span>{$note_no_of_page} Pages</span></li>
                                    <li><i class='fa fa-calendar'></i><span>{$note_date}</span></li>";

                $select_report_for_note_sql = "SELECT * FROM reported_note WHERE reported_note_id = $note_id";
                $select_report_for_note_result = query($select_report_for_note_sql);
                confirmQuery($select_report_for_note_result);
                $reports_count = row_count($select_report_for_note_result);
                if($reports_count > 0) {
                    $serached_note_output .= "<li><i class='fa fa-flag'></i><span id='flag-review'>$reports_count Users marked this note as inappropiate</span></li>";

                }

                $serached_note_output .= "</ul>";

                $select_review_for_note_sql = "SELECT COUNT(review_id) AS reviews_count, AVG(review_rating) AS avg_rating FROM note_reviews WHERE review_note_id = $note_id AND is_review_active = 1";
                $select_review_for_note_result = query($select_review_for_note_sql);
                confirmQuery($select_review_for_note_result);

                $row_review = fetch_array($select_review_for_note_result);

                $reviews_count = $row_review['reviews_count'];
                $avg_rating = round($row_review['avg_rating']);
                if($reviews_count > 0 and $avg_rating > 0) {

                    $serached_note_output .= "<div class='review'>
                                <div class='stars'>";

                    for($i=1;$i<=5;$i++){
                        if($avg_rating > 0){
                            $serached_note_output .= "<label class='star star-filled' for='star-$i'></label>";
                        }
                        else {
                            $serached_note_output .= "<label class='star star-unfilled' for='star-$i'></label>";
                        }
                        $avg_rating = $avg_rating - 1;
                    }

                    $serached_note_output .= "  <div class='star-review'>
                                <span>$reviews_count reviews</span>
                            </div>
                        </div>
                    </div>";
                }
                $serached_note_output .= "</div>
                    </div>
                </div>";
            }
            $serached_note_output .= "</div>
                            </div>
                        </section>";
            
            
            $totalPage = ceil($total_notes/$limit);

            $serached_note_output .= "<section id='search-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='search_page_ul'>
                <li class='page-item'>
                    <a class='page-link' id='search_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $serached_note_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $serached_note_output .= "<li class='page-item'>
                        <a class='page-link' id='search_page_next' href='' aria-label='Next'>
                            <span aria-hidden='true'><i class='fa fa-angle-right' aria-hidden='true'></i></span>
                        </a>
                    </li>
            </ul>
            </nav>
        </section>";
            
        }
        else {
            echo "<h3 class='text-center' style='line-height:350px;'>No record found</h3>";
        }
        
        echo $serached_note_output;
    }
?>