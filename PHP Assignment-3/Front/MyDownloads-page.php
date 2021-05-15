<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }

?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="mydownloads-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="mydownloads-head">
                        <p>My Downloads</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="mydownloads-search">
                        <input type="text" class="form-control" id="search-downloaded-note" placeholder="Search">
                        <div class="mydownloads-search-btn" id="mydownloads-btn">
                            <a class="btn btn-general btn-purple" title="Search" role="button" id="downloaded_note_search_btn">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <div id="mydownloads-result">
        
    </div>                   
                    

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Review</h5>
                    </div>
                    <div class="modal-body">
                       <form method="post" id="note_review_form">
                           <input type="hidden" name="review_download_id" id="download_id_review" />
                            <div id="rating-stars">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <br><br>
                            <div id="review-comment">
                                <div class="form-group">
                                    <label for="Comments">Comments *</label>
                                    <textarea class="form-control" name="review_comment" id="review-comments" rows="3" placeholder="Comments..."></textarea>
                                </div>
                            </div>
                            <div id="review-submit-btn">
                                <button class="btn btn-gneral btn-purple" type="submit" name="review_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-content-inner">
                    <form method="post" id="note_report_form">
                        <input type="hidden" name="report_note_download_id" id="report_note_id"/>
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_note_title"></h5>
                        </div>
                        <div class="modal-body">
                            <div id="report_remarks_div">
                                <div class="form-group">
                                    <label for="Remarks">Remarks</label>
                                    <textarea class="form-control" name="report_remark" id="report_remarks" rows="4" placeholder="Write remarks"></textarea>
                                    <div id="report_remark_alert"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="btn-group mr-2" id="report-modal-btn" role="group">
                                <button type="submit" name="report_note_submit" class="btn btn-general" >Report</button>
                            </div>
                            <div class="btn-group mr-2" id="report-modal-cancel-btn" role="group">
                                <a class="btn btn-general" data-dismiss="modal" aria-label="Close">cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<br/><br/><br/><br/><br/><br/><br/>
    
    
<?php include("page_footer.php"); ?>

<script>    
$(document).ready(function() {
    $(document).on('click', '.add_review', function() {
        var note_id = $(this).attr("id");
        $('#download_id_review').val(note_id);
        $('#reviewModal').modal('show');
    });
    $('#note_review_form').on('submit', function(event) {
        event.preventDefault();
        if(!$("input:radio[name='rate']").is(":checked")) {
            alert("please give ratings to note");
        } else if($('#review-comments').val() == ''){
            alert("comment is required");
        } 
        else {
            $.ajax({
                url:"AddReview.php",
                method:"POST",
                data:$('#note_review_form').serialize(),
                success:function(data) 
                {
                    $('#note_review_form')[0].reset();
                    
                    $('#reviewModal').modal('hide');
                    alert('Thanks for Your feedback');
                }
                
            });
        }
    });
    
    $(document).on('click', '.add_report', function() {
        var download_id = $(this).attr("id");
        var note_title = $(this).attr("rel");
        $('#report_note_id').val(download_id);
        $('#modal_note_title').text(note_title);
        $('#reportModal').modal('show');
    });
    $('#note_report_form').on('submit', function(event) {
        event.preventDefault();
        if($('#report_remarks').val() == ''){
            $('#report_remark_alert').text('Please Enter Remark');
        }else {
            $('#report_remark_alert').text('');
            var test_confirmation = confirm('Are you sure you want to mark this report as spam, you cannot update it later?');
            if(test_confirmation) {
                $.ajax({
                    url: "AddReport.php",
                    method: "POST",
                    data:$('#note_report_form').serialize(),
                    success:function(data) {
                        
                        $('#note_report_form')[0].reset();

                        $('#reportModal').modal('hide');
                        alert('Your response has been Received');
                        
                    }
                });
            }
            else {
                $('#note_report_form')[0].reset();
                $('#reportModal').modal('hide');
            }
        }
    });

    get_downloaded_note_data();    

    function get_downloaded_note_data(page)
    {
        var downloaded_note = 'fetch_data';
        var search = $('#search-downloaded-note').val();

        $.ajax({
            url:"downloaded_note.php",
            method:"POST",
            data:{downloaded_note:downloaded_note,search:search,page_no:page},
            success:function(data){
                $('#mydownloads-result').html(data);
            }
        });
    }


    $('#downloaded_note_search_btn').click(function(){
        get_downloaded_note_data()
    });
    
    $(document).on("click", "#my_downloads_pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
        if(pageId == 'download_prev') {
            var current_page = $('#my_downloads_pagination li a.active').attr("id");
            pageId = parseInt(current_page) - 1;
            if(pageId == 0){
                get_downloaded_note_data(1);
            }
            else {
                get_downloaded_note_data(pageId);
            }
            
        }
        else if(pageId == 'download_next') {
            var current_page = $('#my_downloads_pagination li a.active').attr("id");
            var check_last = $('#download_next').parent().prev().children('a').attr("id");
            if(current_page == check_last) {
                get_downloaded_note_data(current_page);
            }
            else {
                page_next = parseInt(current_page) + 1;
                get_downloaded_note_data(page_next);
            }
            
        }
        else {
            get_downloaded_note_data(pageId);
        }
      
    });
    
        
});

    
    
</script>
