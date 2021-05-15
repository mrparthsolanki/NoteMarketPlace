<?php  include "include/header.php"; ?>
<?php
    if(isset($_POST["downloaded_note"])) {
        $downloaded_output = "";
        
        $the_user_id = $_SESSION['user_id'];
        
        
        $limit = 10;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $my_downloads_sql = "SELECT * FROM downloads JOIN users ON downloads.seller=users.user_id WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND downloader = '{$the_user_id}'";
        if(isset($_POST['search'])) {
            $serach = $_POST['search'];
            
            $my_downloads_sql .= " AND (note_title LIKE '%$serach%' OR user_email_id LIKE '%$serach%' OR note_category LIKE '%$serach%' OR purchased_price LIKE '%$serach%')";
        }
        $my_downloads_sql .= " ORDER BY downloads.created_date DESC LIMIT $offset, $limit";
        
        $my_downloads_result = query($my_downloads_sql);
        confirmQuery($my_downloads_result);

        if(row_count($my_downloads_result) > 0) {
            $downloaded_output .= "<section id='mydownloads-notes-info'>
        <div class='container'>
            <div class='row'>
                <div class='col-sm-12 col-md-12'>
                    <table class='table table-hover table-responsive w-100 d-block d-md-table' id='mydownloads-notes-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Seller</th>
                                <th scope='col'>Sell Type</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Downloaded Date/Time</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($my_downloads_result)) {
                $download_id = $row['download_id'];
                $note_id = $row['downloaded_note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['note_category'];
                $buyer = $row['user_email_id'];
                $sell_mode = $row['is_note_paid'];
                $purchased_price = $row['purchased_price'];
                $date_time = $row['attachment_downloaded_date'];

                if($sell_mode == 0) {
                    $sell_type = "Free";
                }else {
                    $sell_type = "Paid";
                }
                if(empty($purchased_price)) {
                    $price = "$0";
                }
                else {
                    $price = "$".$purchased_price;
                }
                $downloaded_date = new DateTime($date_time);
                $downloaded_date = $downloaded_date->format('d M Y, H:i:s');
                
                $downloaded_output .= "<tr>
                                <td>{$sr_no}</td>
                                <td><a href='Note_Details.php?note_id={$note_id}'>{$note_title}</a></td>
                                <td>{$note_category}</td>
                                <td>{$buyer}</td>
                                <td>{$sell_type}</td>
                                <td>{$price}</td>
                                <td>{$downloaded_date}</td>
                                <td>
                                    <div class='action-img'>
                                        <div class='view-mydownloads-note'>
                                            <a href='Note_Details.php?note_id={$note_id}'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                        </div>
                                        <div class='mydownloads-note-action dropleft'>
                                            <a id='mydownloads-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                                <a class='dropdown-item' href='NoteOperation.php?download_note_id={$download_id}'>Download Note</a>
                                                <a class='dropdown-item add_review' role='button' id='$download_id'>Add Reviews/Feedback</a>
                                                <a class='dropdown-item add_report' role='button' id='$download_id' rel='{$note_title}'>Report as Inappropiate</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                $sr_no += 1;

            }
            $downloaded_output .= "</tbody>
                                </table>
                                    </div>
                                </div>
                            </div>
                        </section>";
            
            $my_downloads_sql2 = "SELECT * FROM downloads  JOIN users ON downloads.seller=users.user_id WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND downloader = '{$the_user_id}'";
            if(isset($_POST['search'])) {
                $serach = $_POST['search'];

                $my_downloads_sql2 .= " AND (note_title LIKE '%$serach%' OR user_email_id LIKE '%$serach%' OR note_category LIKE '%$serach%' OR purchased_price LIKE '%$serach%')";
            }

            $my_downloads_sql2 .= "ORDER BY downloads.created_date DESC";

            $my_downloads_result2 = query($my_downloads_sql2);
            confirmQuery($my_downloads_result2);
            $totalRecords = row_count($my_downloads_result2);
            $totalPage = ceil($totalRecords/$limit);

            $downloaded_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='my_downloads_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='download_prev' href='' aria-label='Previous'>
                            <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                        </a>
                    </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
               if ($i == $page_no) {
                $active = "active";
               }else{
                $active = "";
               }
                $downloaded_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $downloaded_output .= "<li class='page-item'>
                        <a class='page-link' id='download_next' href='' aria-label='Next'>
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
        
        
        
        echo $downloaded_output;
        
    }

    if(isset($_POST['sold_note'])) {
        $mysold_output = "";
        $the_user_id = $_SESSION['user_id'];
        
        
        $limit = 10;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $my_sold_sql = "SELECT * FROM downloads d JOIN users u ON d.downloader=u.user_id WHERE is_allowed_download = 1 AND seller = $the_user_id AND attachment_path IS NOT NULL";
        if(isset($_POST['search_mysold'])) {
            $search = $_POST['search_mysold'];
            
            $my_sold_sql .= " AND (note_title LIKE '%$search%' OR note_category LIKE '%$search%' OR purchased_price LIKE '%$search%' OR user_email_id LIKE '%$search%')";
        }
        
        $my_sold_sql .= "ORDER BY attachment_downloaded_date DESC LIMIT $offset, $limit";
        
        $my_sold_result = query($my_sold_sql);
        confirmQuery($my_sold_result);
        
        
        if(row_count($my_sold_result)>0){
            $mysold_output .= "<section id='mysold-notes-info'>
        <div class='container'>
            <div class='row'>
                <div class='col-sm-12 col-md-12'>
                    <table class='table table-hover table-responsive w-100 d-block d-md-table' id='mysold-notes-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Buyer</th>
                                <th scope='col'>Sell Type</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Downloaded Date/Time</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($my_sold_result)) {
                $note_id = $row['downloaded_note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['note_category'];
                $buyer_email = $row['user_email_id'];
                $sell_mode = $row['is_note_paid'];
                $note_price = $row['purchased_price'];
                $attachment_path = $row['attachment_path'];
                $downloaded_time = $row['attachment_downloaded_date'];

                if($sell_mode == 0) {
                    $sell_type = "Free";
                }else {
                    $sell_type = "Paid";
                }
                if(empty($note_price)) {
                    $price = "$0";
                }
                else {
                    $price = "$".$note_price;
                }
                $downloaded_date = new DateTime($downloaded_time);
                $downloaded_date = $downloaded_date->format('d M Y, H:i:s');

                $mysold_output .= "<tr>
        <td>$sr_no</td>
        <td><a href='Note_Details.php?note_id=$note_id'>$note_title</a></td>
        <td>$note_category</td>
        <td>$buyer_email</td>
        <td>$sell_type</td>
        <td>$price</td>
        <td>$downloaded_date</td>
        <td>
            <div class='action-img'>
                <div class='view-mysold-note'>
                    <a href='Note_Details.php?note_id=$note_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
                <div class='mysold-note-action dropleft'>
                    <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='MySoldNotes-page.php?download_sold_note=$attachment_path'>Download Note</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;
            }
            $mysold_output .= "</tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>";
            $my_sold_sql2 = "SELECT * FROM downloads d JOIN users u ON d.downloader=u.user_id WHERE is_allowed_download = 1 AND seller = $the_user_id AND attachment_path IS NOT NULL";
            if(isset($_POST['search_mysold'])) {
                $search = $_POST['search_mysold'];

                $my_sold_sql2 .= " AND (note_title LIKE '%$search%' OR note_category LIKE '%$search%' OR purchased_price LIKE '%$search%' OR user_email_id LIKE '%$search%')";
            }

            $my_sold_sql2 .= "ORDER BY attachment_downloaded_date DESC";

            $my_sold_result2 = query($my_sold_sql2);
            confirmQuery($my_sold_result2);
            $totalRecords = row_count($my_sold_result2);
            $totalPage = ceil($totalRecords/$limit);
            
            $mysold_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='mysold_note_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='download_prev' href='' aria-label='Previous'>
                            <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                        </a>
                    </li>";
            for ($i=1; $i <= $totalPage ; $i++) { 
               if ($i == $page_no) {
                $active = "active";
               }else{
                $active = "";
               }
               $mysold_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $mysold_output .= "<li class='page-item'>
                        <a class='page-link' id='download_next' href='' aria-label='Next'>
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
        
        echo $mysold_output;
        
        
        
    }
    

?>