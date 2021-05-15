<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>

<?php
    if(isset($_GET['note_id'])) {
        
        $the_note_id = $_GET['note_id'];
        
        $select_note_detail_sql = "SELECT * FROM seller_notes sn JOIN note_category nc ON sn.note_category=nc.category_id JOIN note_country nco ON sn.note_country=nco.country_id WHERE note_id = '{$the_note_id}'";
        $select_note_detail_result = query($select_note_detail_sql);
        confirmQuery($select_note_detail_result);
        
        $row = fetch_array($select_note_detail_result);
        $seller_id = $row['seller_id'];
        $note_title = $row['note_title'];
        $note_category = $row['category_name'];
        $note_image = $row['note_display_picture'];
        $note_type = $row['note_type'];
        $note_no_of_page = $row['note_number_of_pages'];
        $note_description = $row['note_description'];
        $note_university_name = $row['note_university_name'];
        $note_country = $row['country_name'];
        $note_course = $row['note_course'];
        $note_course_code = $row['note_course_code'];
        $note_professor = $row['note_professor'];
        $is_note_paid = $row['is_note_paid'];
        $note_price = $row['note_price'];
        $note_preview = $row['note_preview'];
//        $note_published_date = $row['note_published_date'];
        $note_created_date = $row['created_date'];
        
        $approved_date = new DateTime($note_created_date);
        $approved_date = $approved_date->format('F d Y');
        
        
        if(empty($note_image)) {
            $note_image = "images/notedetails/first.jpg";
        }
        

?>
   

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <!-- Note Detail 01 -->
    <section id="note-detail-01">
        <div class="container">
            <div class="row">
                <div class="col-md-12 nd-heading">
                    <h6>Notes Details</h6>
                </div>
            </div>
    
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="row">
                        <div class="col-sm-5 col-md-5" id="nd-note-img">
                            <img src="<?php echo $note_image; ?>" alt="Book-Image" class="img-responsive">
                        </div>
                        <div class="col-sm-7 col-md-7" id="nd-note-description">
                            <div id="nd-note-description-head">
                                <h5><?php echo $note_title; ?></h5>
                                <p><?php echo $note_category; ?></p>
                            </div>
                            <div id="nd-note-description-content">
                                <p><?php echo $note_description; ?></p>
                            </div>
                            <form action="" method="post">
                               <div class="form-group">
                                    <input type="hidden" name="note_id" value="<?php echo $the_note_id; ?>">
                                </div>
                                <div id="nd-download-btn">
                                    <button name="download" class="btn btn-general btn-purple" title="Download" <?php if($is_note_paid == 1){ echo "onclick=\"javascript: return confirm('Are you sure you want to download this Paid note. Please confirm.');\""; }?> >Download<?php if($is_note_paid == 1){ echo " / $".$note_price; }?></button>
    <!--                                role="button" data-toggle="modal" data-target="#thanksModal"-->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5" id="nd-note-info">
                    <table class="table table-borderless nd-note-info-table">
                        <tbody>
                            <?php
                                if(!empty($note_university_name)) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Institution:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_university_name}</td>
                                        </tr>";
                                }
                                if(!empty($note_country)) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Country:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_country}</td>
                                        </tr>";
                                }
                                if(!empty($note_course)) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Course Name:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_course}</td>
                                        </tr>";
                                }
                                if(!empty($note_course_code)) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Course Code:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_course_code}</td>
                                        </tr>";
                                }
                                if(!empty($note_professor)) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Professor:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_professor}</td>
                                        </tr>";
                                }
                                if($note_no_of_page != 0) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Number of Pages:</td>
                                            <td class='nd-note-info-table-row-2'>{$note_no_of_page}</td>
                                        </tr>";
                                }
                            ?>
                            
                            <tr>
                                <td class="nd-note-info-table-row-1">Approved Date:</td>
                                <td class="nd-note-info-table-row-2"><?php echo $approved_date; ?></td>
                            </tr>
                            
                            <?php
        
                                $select_review_for_note_sql = "SELECT COUNT(review_id) AS reviews_count, AVG(review_rating) AS avg_rating FROM note_reviews WHERE review_note_id = $the_note_id AND is_review_active = 1";
                                $select_review_for_note_result = query($select_review_for_note_sql);
                                confirmQuery($select_review_for_note_result);

                                $row_review = fetch_array($select_review_for_note_result);

                                $reviews_count = $row_review['reviews_count'];
                                $avg_rating = $row_review['avg_rating'];
                                    
                                if($reviews_count > 0 and $avg_rating > 0) {
                                    echo "<tr>
                                            <td class='nd-note-info-table-row-1'>Rating:</td>
                                            <td>
                                                <div class='review'>
                                                    <div class='stars'>";

                                    for($i=1;$i<=5;$i++){
                                        if($avg_rating > 0){
                                            echo "<label class='star star-filled' for='star-$i'></label>";
                                        }
                                        else {
                                            echo "<label class='star star-unfilled' for='star-$i'></label>";
                                        }
                                        $avg_rating = $avg_rating - 1;
                                    }

                                    echo "          <div class='star-review'>
                                                        <span>$reviews_count reviews</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                }            
                        
                            ?>
                        </tbody>
                    </table>
                    
                    <?php
                        $select_report_for_note_sql = "SELECT * FROM reported_note WHERE reported_note_id = $the_note_id";
                        $select_report_for_note_result = query($select_report_for_note_sql);
                        confirmQuery($select_report_for_note_result);
                        $reports_count = row_count($select_report_for_note_result);
                        if($reports_count > 0) { 
                            echo "<p>$reports_count Users marked this note as inappropiate</p>";
                        }
                    ?>
                    
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Thanks Modal -->
    <div class="modal fade" id="thanksModal" tabindex="-1" role="dialog" aria-labelledby="thanksModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <div class="modal-header-img text-center">
                        <img src="images/notedetails/SUCCESS.png" alt="success" class="img-responsive">
                    </div>
                    <div class="modal-header text-center">
                        <h5 class="modal-title w-100" id="thanksModalLabel">Thank you for purchasing!</h5>
                    </div>
                    <div class="modal-body">
                        <div id="nd-thankmodal-bold">
                            <p>Dear <?php echo $_SESSION['user_first_name']; ?>,</p>
                        </div>
                        <div id="nd-thankmodal-normal">
                            <p>As this is paid notes - you need to pay to seller <span id="modal_seller_name"></span> offline. We will send him an email that you want to download this note. He may contact you further for payment process completion.</p>
                            <p>In case, you have urgency,<br>Please contact us on +9195377345959 .</p>
                            <p>Once he receives the payment and acknowledge us - selected notes you can see over my downloads tab for downlod.</p>
                            <p>Have a good day.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Horizontal line -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 nd-hr">
                <hr>
            </div>
        </div>
    </div>

    <!-- Note Detail 02 -->
    <section id="note-detail-02">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="nd-heading">
                        <h6>Notes Preview</h6>
                    </div>
                    <div id="nd-note-preview">
                        <?php
                            if(!empty($note_preview)) {
                                echo "<embed src='{$note_preview}' type='application/pdf'>";
                            }
                            else {
                                echo "<p id='nd-note-preview-info' class='text-center'>Note Preview Not available</p>";
                            }
                        ?>
                       
                        
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="nd-heading">
                        <h6>Customer Reviews</h6>
                    </div>
                    
                    
                        <?php
                            $select_reviews_sql = "SELECT * FROM note_reviews JOIN users ON note_reviews.reviewer_id=users.user_id JOIN user_profile ON note_reviews.reviewer_id=user_profile.profile_user_id WHERE review_note_id = $the_note_id AND is_review_active = 1 ORDER BY note_reviews.created_date DESC";
                            $select_reviews_result = query($select_reviews_sql);
                            confirmQuery($select_reviews_result);
                            if(row_count($select_reviews_result) > 0) {
                                echo "<div id='nd-customer-review'>";
                                $total_reviews = row_count($select_reviews_result);
                                while($reviewers_row = fetch_array($select_reviews_result)) {
                                    $review_id = $reviewers_row['review_id'];
                                    $review_rating = $reviewers_row['review_rating'];
                                    $review_comment = $reviewers_row['review_comment'];
                                    $reviewer_name = $reviewers_row['user_first_name']." ".$reviewers_row['user_last_name'];
                                    $reviewer_profile_picture = $reviewers_row['user_profile_picture'];   if(empty($reviewer_profile_picture)) {
                                        $reviewer_profile_picture = "images/user-img/default-profile.png";
                                    } 
                                    
                                    echo "<div class='row'>
                            <div class='col-md-2'>
                                <div  class='reviewer-img text-center' >
                                    <img src='$reviewer_profile_picture' alt='Reviewer' class='img-responsive rounded-circle' style='height:48px;width:48px'>
                                </div>
                            </div>
                            <div class='col-md-10'>
                                <div class='reviewer-info'>
                                    <h6>$reviewer_name</h6>";
                                    
                                    if($review_rating > 0) {
                                        echo "<div class='reviewer-rating'>";
                                        for($a=1;$a<=5;$a++) {
                                            if($review_rating > 0) {
                                                echo "<img src='images/notedetails/star.png' alt='Rating-star' class='img-responsive'>";
                                            }
                                            else {
                                                echo "<img src='images/notedetails/star-white.png' alt='Rating-star' class='img-responsive'>";
                                            }
                                            $review_rating = $review_rating - 1;
                                        }
                                        echo "</div>";
                                    }
                                    
                                echo "</div>
                                        <div class='reviewer-review-content'>
                                            <p>$review_comment</p>
                                        </div>
                                    </div>
                                </div>";
                                    
                                if($total_reviews > 1) {
                                    echo "<hr>";
                                }    
                                $total_reviews -= 1;
                                    
                                }
                                echo "</div>";
                            }
                            else {
                                echo "<p id='notes_review_warning' class='text-center'>Note Reviews Not available</p>";
                            }
                        
                        
                                
                        ?>
                       
                    

                </div>
            </div>
        </div>
    </section>

<?php include("page_footer.php"); ?>
<?php
    DownloadNote();
?>

<?php
    }
    else {
        redirect("search.php");
    }
?>
