<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>

    <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>
<!--
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light" id="mynav">
        <div class="container">
            <a class="navbar-brand" href="home.html"><img src="images/Homepage/logo.png" alt="logo" class="img-responsive"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Dashboard.html">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="FAQ.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ContactUs.html">Contatct Us</a>
                    </li>
                    <li class="nav-item">
                        <div class="login-btn">
                            <a class="nav-link btn btn-general btn-purple" onclick="javascript: return confirm('Are you sure you want to logout');" href="logout.php" id="home-login-btn" role="button">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
-->

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
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-category">
                                    <option value="" disabled selected>Select Category</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-university">
                                    <option value="" disabled selected>Select University</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-course">
                                    <option value="" disabled selected>Select Course</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-lg" id="search-note-country">
                                    <option value="" disabled selected>Select Country</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
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

    <section id="total-notes">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-notes-title">
                        <h4>Total 18 notes</h4>
                    </div>
                </div>
            </div>

            <!-- Row 1 -->
            <div class="row">
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/1.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Computer Operating System - Final Exam Book With Paper Solution</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/2.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Computer Science</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/3.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Basic Computer Engineering Tech India Publication Series</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row">
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/4.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Computer Science Illuminted - Seventh Edition</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/5.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">The Principles of Computer Hardware - Oxford</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/6.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">The Computer Book</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row">
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/1.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Computer Operating System - Final Exam Book With Paper Solution</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/2.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Computer Science</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="notes-card">
                        <div class="notes-card-img">
                            <img src="images/Search/3.jpg" alt="note" class="img-responsive">
                        </div>
                        <div class="notes-card-content">
                            <h5><a href="Note_Details.php">Basic Computer Engineering Tech India Publication Series</a></h5>
                            <ul class="notes-card-content-details">
                                <li><i class="fa fa-university"></i><span>University of California, US</span></li>
                                <li><i class="fa fa-book"></i><span>204 Pages</span></li>
                                <li><i class="fa fa-calendar"></i><span>Thu, Dec 24 2020</span></li>
                                <li><i class="fa fa-flag"></i><span id="flag-review">5 Users marked this note as inappropiate</span></li>
                            </ul>
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="search-pagination">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
    </section>
    

<?php include("page_footer.php"); ?>