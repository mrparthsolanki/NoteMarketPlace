<?php  include "include/header.php"; ?>
<?php include("page_header.php"); ?>
<?php
    if(!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
?>
    
  <!-- Navigation Bar -->
  <?php include("Navigation.php"); ?>

    <!-- Dashboard -->
    <section id="dashboard-info-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="dashboard-heading">
                        <p>Dashboard</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 text-right">
                    <div id="dashboard-add-note-btn">
                        <a class="btn btn-general btn-purple" href="AddNotes-page.html" title="Add Note" role="button">Add Note</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard -->
    <section id="dashboard-info">
        <div class="container">
            <div class="row dashboard-info-row text-center">
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div id="dashboard-earning-img">
                            <img src="images/Dashboard/dashboard-earning.PNG" alt="Earning" class="img-responsive">
                        </div>
                        <div id="dashboard-earning-title">
                            <h5>My Earning</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 col-md-4">
                    <div class="dashboard-info-card">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="dashboard-info-card-head">
                                    <h3><a href="MySoldNotes-page.html">100</a></h3>
                                </div>
                                <div class="dashboard-info-card-p">
                                    <p>Number of Notes Sold</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="dashboard-info-card-head">
                                    <h3>$10,00,000</h3>
                                </div>
                                <div class="dashboard-info-card-p">
                                    <p>Money Earned</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="MyDownloads-page.html">38</a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>My Downloads</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="RejectedNotes.html">12</a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>My Rejected Notes</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="dashboard-info-card">
                        <div class="dashboard-info-card-head">
                            <h3><a href="BuyerRequest-page.html">102</a></h3>
                        </div>
                        <div class="dashboard-info-card-p">
                            <p>Buyer Requests</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-inprogress-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dash-head">
                        <h3>In Progress Notes</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right my-text-right">
                    <div class="dash-search">
                        <input type="text" class="form-control" id="search-inprogress-note" placeholder="Search">
                        <div class="dash-search-btn" id="search-btn-1">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   
    <section id="dash-inprogress-notes-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="table table-hover table-responsive w-100 d-block d-md-table" id="inprogress-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Added Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php
                                $user_id = $_SESSION['user_id'];
                                $inprogress_note_query = "SELECT sn.note_id, sn.seller_id, rd.value, sn.note_title, nc.category_name, sn.created_date FROM seller_notes sn JOIN reference_data rd ON sn.note_status = rd.reference_id JOIN note_category nc ON sn.note_category = nc.category_id WHERE seller_id = '{$user_id}' AND rd.value IN ('draft', 'submitted for review', 'in review') AND is_note_active = '1' ORDER BY sn.created_date DESC";
                                $inprogress_note_result = query($inprogress_note_query);
                                confirmQuery($inprogress_note_result);
                                
                                while($row = fetch_array($inprogress_note_result)) {
                                    $note_id = $row['note_id'];
                                    $seller_id = $row['seller_id'];
                                    $note_status = $row['value'];
                                    $note_title = $row['note_title'];
                                    $note_category = $row['category_name'];
                                    $note_created_date = $row['created_date'];
                                    
                                    $note_date = new DateTime($note_created_date);

                                    $note_date = $note_date->format('d-m-Y');
                                    
                                    
                                    echo "<tr>
                                            <td>{$note_date}</td>
                                            <td>{$note_title}</td>
                                            <td>{$note_category}</td>
                                            <td>{$note_status}</td>";
                                    
                                    if($note_status === "draft") {
                                        echo "<td>
                                                <div class='action-img'>
                                                    <div class='dash-edit-inprogress-note'>
                                                        <a href='EditNotes.php?edit_note_id={$note_id}'><img src='images/Dashboard/edit.png' alt='Edit' class='img-risponsive'></a>
                                                        </div>
                                                    <div class='dash-delete-inprogress-note'>
                                                        <a href=''><img src='images/Dashboard/delete.png' alt='Delete' class='img-risponsive'></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                    }
                                    else {
                                        echo "<td>
                                                <div class='action-img'>
                                                    <div class='dash-view-inprogress-note'>
                                                        <a href=''><img src='images/Dashboard/eye.png' alt='View' class='img-risponsive'></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";
                                                
                                    }
                                }

                            ?>
                        
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
    
    <section id="dash-published-notes">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dash-head">
                        <h3>Published Notes</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right my-text-right">
                    <div class="dash-search">
                        <input type="text" class="form-control" id="search-inprogress-note" placeholder="Search">
                        <div class="dash-search-btn" id="search-btn-1">
                            <a class="btn btn-general btn-purple" href="#" title="Search" role="button">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dash-published-notes-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <table class="table table-hover table-responsive w-100 d-block d-md-table" id="published-notes-table">
                        <thead>
                            <tr>
                                <th scope="col">Added Date</th>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Sell Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>09-10-2020</td>
                                <td>Data Science</td>
                                <td>Science</td>
                                <td>Paid</td>
                                <td>$575</td>
                                <td>
                                    <div class="action-img">
                                        <div class="dash-view-published-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>10-10-2020</td>
                                <td>Accounts</td>
                                <td>Commerce</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>
                                    <div class="action-img">
                                        <div class="dash-view-published-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>11-10-2020</td>
                                <td>Social Studies</td>
                                <td>Social</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>
                                    <div class="action-img">
                                        <div class="dash-view-published-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>12-10-2020</td>
                                <td>AI</td>
                                <td>IT</td>
                                <td>Paid</td>
                                <td>$3542</td>
                                <td>
                                    <div class="action-img">
                                        <div class="dash-view-published-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="View" class="img-risponsive"></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>13-10-2020</td>
                                <td>Data Structure</td>
                                <td>Science</td>
                                <td>Free</td>
                                <td>$0</td>
                                <td>
                                    <div class="action-img">
                                        <div class="dash-view-published-note">
                                            <a href="Note-Details.html"><img src="images/Dashboard/eye.png" alt="Edit" class="img-risponsive"></a>
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