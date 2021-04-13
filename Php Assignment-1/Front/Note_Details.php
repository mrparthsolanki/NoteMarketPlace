<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>


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
                            <img src="images/notedetails/first.jpg" alt="Book-Image" class="img-responsive">
                        </div>
                        <div class="col-sm-7 col-md-7" id="nd-note-description">
                            <div id="nd-note-description-head">
                                <h5>Computer Science</h5>
                                <p>Sciences</p>
                            </div>
                            <div id="nd-note-description-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aspernatur quo dolor dolores, vero ea. Quidem animi earum assumenda sequi placeat autem, ipsam, non excepturi iure, dolor nihil itaque debitis.</p>
                            </div>
                            <div id="nd-download-btn">
                                 
                                <a class="btn btn-general btn-purple" href="#" title="Download" name="download" role="button" data-toggle="modal" data-target="#thanksModal">Download / $15</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5" id="nd-note-info">
                    <table class="table table-borderless nd-note-info-table">
                        <tbody>
                            <tr>
                                <td class="nd-note-info-table-row-1">Institution:</td>
                                <td class="nd-note-info-table-row-2">University of California</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Country:</td>
                                <td class="nd-note-info-table-row-2">United State</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Course Name:</td>
                                <td class="nd-note-info-table-row-2">Computer Engineering</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Course Code:</td>
                                <td class="nd-note-info-table-row-2">248750</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Professor:</td>
                                <td class="nd-note-info-table-row-2">Mr. Richard Brown</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Number of Pages:</td>
                                <td class="nd-note-info-table-row-2">277</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Approved Date:</td>
                                <td class="nd-note-info-table-row-2">November 25 2020</td>
                            </tr>
                            <tr>
                                <td class="nd-note-info-table-row-1">Rating:</td>
                                <td>
                                    <div class="review">
                                        <div class="stars">
                                            <label class="star star-1" for="star-1"></label>
                                            <label class="star star-2" for="star-2"></label>
                                            <label class="star star-3" for="star-3"></label>
                                            <label class="star star-4" for="star-4"></label>
                                            <label class="star star-5" for="star-5"></label>
                                            <div class="star-review">
                                                <span>100 reviews</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>5 Users marked this note as inappropiate</p>
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
                            <p>As this is paid notes - you need to pay to seller Rahil Shah offline. We will send him an email that you want to download this note. He may contact you further for payment process completion.</p>
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
                    <div class=" nd-heading">
                        <h6>Notes Preview</h6>
                    </div>
                    <div id="nd-note-preview">
                        <embed src="images/notedetails/sample.pdf" type="application/pdf">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class=" nd-heading">
                        <h6>Customer Reviews</h6>
                    </div>
                    <div id="nd-customer-review">
                        <!-- Reviewer 01 -->
                        <div class="row" id="reviewer-1">
                            <div class="col-md-2">
                                <div class="reviewer-img text-center">
                                    <img src="images/notedetails/reviewer-1.png" alt="Reviewer" class="img-responsive rounded-circle">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="reviewer-info">
                                    <h6>Richard Brown</h6>
                                    <div class="reviewer-rating">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star-white.png" alt="Rating-star" class="img-responsive">
                                    </div>
                                </div>
                                <div class="reviewer-review-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum architecto rem perferendis. Repellat facilis in officiis tempore quod impedit, aperiam culpa.</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Reviewer 02 -->
                        <div class="row" id="reviewer-2">
                            <div class="col-md-2">
                                <div class="reviewer-img text-center">
                                    <img src="images/notedetails/reviewer-2.png" alt="Reviewer" class="img-responsive rounded-circle">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="reviewer-info">
                                    <h6>Alice Ortiaz</h6>
                                    <div class="reviewer-rating">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star-white.png" alt="Rating-star" class="img-responsive">
                                    </div>
                                </div>
                                <div class="reviewer-review-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum architecto rem perferendis. Repellat facilis in officiis tempore quod impedit, aperiam culpa.</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Reviewer 03 -->
                        <div class="row" id="reviewer-3">
                            <div class="col-md-2">
                                <div class="reviewer-img text-center">
                                    <img src="images/notedetails/reviewer-3.png" alt="Reviewer" class="img-responsive rounded-circle">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="reviewer-info">
                                    <h6>Sara Passmore</h6>
                                    <div class="reviewer-rating">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star.png" alt="Rating-star" class="img-responsive">
                                        <img src="images/notedetails/star-white.png" alt="Rating-star" class="img-responsive">
                                    </div>
                                </div>
                                <div class="reviewer-review-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum architecto rem perferendis. Repellat facilis in officiis tempore quod impedit, aperiam culpa.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer>
        <hr>
        <div class="container">
            <div class="row" id="footer-content">
                <div class="col-xs-7 col-sm-7 col-md-6">
                    <div class="footer-line">
                        <p>Copyright &copy; Tatvasoft All rights reserved.</p>
                    </div>
                </div>
                <div class="col-xs-5 col-sm-5 col-md-6 text-right">
                    <ul class="social-list">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap JS-->
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="js/script.js"></script>

</body>

</html>