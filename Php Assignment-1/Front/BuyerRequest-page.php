<?php  include "include/header.php"; ?>

<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
?>

  <!-- Navigation Bar -->
    <?php include("Navigation.php"); ?>

    <section id="buyerrequest-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="buyerrequest-head">
                        <p>Buyer Requests</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div class="buyerrequest-search">
                        <input type="text" class="form-control" id="search-buyerrequest-note" placeholder="Search">
                        <div class="buyerrequest-search-btn" id="mydownloads-btn">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="buyerrequest-notes-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="table table-hover" id="buyerrequest-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Buyer</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Sell Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Downloaded Date/Time</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="Note-Details.html">Data Science</a></td>
                                <td>Science</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Paid</td>
                                <td>$250</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="Note-Details.html">Accounts</a></td>
                                <td>Commerce</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="Note-Details.html">Social Studies</a></td>
                                <td>Social</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><a href="Note-Details.html">AI</a></td>
                                <td>IT</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Paid</td>
                                <td>$3542</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><a href="Note-Details.html">Data Structure</a></td>
                                <td>Science</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><a href="Note-Details.html">Data Science</a></td>
                                <td>Science</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Paid</td>
                                <td>$250</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><a href="Note-Details.html">Accounts</a></td>
                                <td>Commerce</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><a href="Note-Details.html">Social Studies</a></td>
                                <td>Social</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><a href="Note-Details.html">AI</a></td>
                                <td>IT</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Paid</td>
                                <td>$3542</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><a href="Note-Details.html">Data Structure</a></td>
                                <td>Science</td>
                                <td>mymail123@gmail.com</td>
                                <td>+91 1234567890</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>01 Jan 2021, 21:33:34</td>
                                <td>
                                    <div class="action-img">
                                        <div class="view-buyerrequest-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
                                        </div>
                                        <div class="buyerrequest-note-action dropleft">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/Dashboard/dots.png" alt="Edit" class="img-risponsive"></a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Allow Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-pagination">
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