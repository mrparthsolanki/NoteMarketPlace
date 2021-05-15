<?php include "../Front/include/header.php"; ?>
<?php
    if(isset($_POST['dash_published'])) {
        $dash_published_notes_output = "";
        $limit = 5;

        if (isset($_POST['dash_page_no'])) {
            $page_no = $_POST['dash_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $dash_published_note_sql_1 = "SELECT * FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users ON seller_notes.seller_id=users.user_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value = 'published'";
        
        
        if(isset($_POST['dash_search_field'])) {
            $search = $_POST['dash_search_field'];
            $dash_published_note_sql_1 .= " AND (note_title LIKE '%$search%' OR category_name LIKE '%$search%' OR note_price LIKE '%$search%' OR user_first_name LIKE '%$search%' OR user_last_name LIKE '%$search%' OR note_published_date LIKE '%$search%')";
        }
        if(isset($_POST['search_by_month'])) {
            $search_month = $_POST['search_by_month'];
            $dash_published_note_sql_1 .= " AND MONTH(seller_notes.note_published_date) = $search_month";
            
        }
        $dash_published_note_sql_1 .= " ORDER BY seller_notes.note_published_date DESC";
        
        $dash_published_note_result_1 = query($dash_published_note_sql_1);
        confirmQuery($dash_published_note_result_1);
        $total_dash_notes = row_count($dash_published_note_result_1);
        
        if(row_count($dash_published_note_result_1) > 0) {
            $dash_published_note_sql_2 = $dash_published_note_sql_1." LIMIT $offset, $limit";
            $dash_published_note_result_2 = query($dash_published_note_sql_2);
            confirmQuery($dash_published_note_result_2);
            
            $dash_published_notes_output .= "<table class='table table-hover' id='published-notes-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Attachment Size</th>
                                <th scope='col'>Sell Type</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Publisher</th>
                                <th scope='col'>Published Date</th>
                                <th scope='col'>Number of Downloadeds</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($dash_published_note_result_2)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $category_name = $row['category_name'];
                $sell_mode = $row['is_note_paid'];
                $note_price = round($row['note_price']);
                $publisher = $row['user_first_name']." ".$row['user_last_name'];
                $date = $row['note_published_date'];
                $note_path = $row['attached_file_path'];
                $note_path_name = $row['attached_file_name'];
                
                $filesize = 0;
                $attachment_array = explode(",", $note_path);
                
               
                
                $note_size = round($filesize/1024). " KB";

                if($note_size > 999) {
                    $note_size = round($note_size/1024) . " MB";
                }

                if($sell_mode == 1) {
                    $sell_type = "Paid";
                }
                else {
                    $sell_type = "Free";
                }

                $published_date = new DateTime($date);
                $published_date = $published_date->format("d-m-Y, H:i");
                $note_downloads_count_sql = "SELECT count(download_id) AS note_downloads_count FROM downloads WHERE is_allowed_download = 1 AND downloaded_note_id = $note_id";

                $note_downloads_count_result = query($note_downloads_count_sql);
                confirmQuery($note_downloads_count_result);
                $row_count = fetch_array($note_downloads_count_result);
                $count = $row_count['note_downloads_count'];

                $dash_published_notes_output .= "<tr>
                <td>$sr_no</td>
                <td><a href='Note-Details.php?note_id=$note_id'>$note_title</a></td>
                <td>$category_name</td>
                <td>$note_size</td>
                <td>$sell_type</td>
                <td>$$note_price</td>
                <td>$publisher</td>
                <td>$published_date</td>
                <td><a href='Downloads-Notes.php'>$count</a></td>
                <td>
                    <div class='action-img'>
                        <div class='published-note-action dropleft'>
                            <a id='publishednote-admin-action-dropdownMenu' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                <a class='dropdown-item' href='Dashboard.php?admin_download_note=$note_path&admin_download_note_name=$note_path_name'>Download Notes</a>
                                <a class='dropdown-item' href='Note-Details.php?note_id=$note_id'>View More Details</a>
                                <a role='button' class='dropdown-item unpublish_note' id='$note_id' rel='$note_title'>Unpublish</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>";

            $sr_no += 1;    
            }
            $dash_published_notes_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_dash_notes/$limit);
            
            $dash_published_notes_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_dash_published_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $dash_published_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $dash_published_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_page_next' href='' aria-label='Next'>
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
        
        echo $dash_published_notes_output;
    }
    
    if(isset($_POST['Notes_UnderReview'])) {
        $underReview_notes_output = "";
        $limit = 5;

        if(isset($_POST['UnderReview_page_no'])) {
            $page_no = $_POST['UnderReview_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_NotesUnderReview_sql_1 = "SELECT seller_notes.note_id, seller_notes.note_title, note_category.category_name,users.user_id,users.user_first_name,users.user_last_name, seller_notes.created_date, seller_notes_attachment.attached_file_path, seller_notes_attachment.attached_file_name, reference_data.value FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users ON seller_notes.seller_id=users.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value IN ('submitted for review', 'in review')";
        
        if(isset($_POST['Notes_UnderReview_search_field'])) {
            $search = $_POST['Notes_UnderReview_search_field'];
            $select_NotesUnderReview_sql_1 .= " AND (seller_notes.note_title LIKE '%$search%' OR note_category.category_name LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%' OR reference_data.value LIKE '%$search%' OR seller_notes.created_date LIKE '%$search%')";
        }
        if(isset($_POST['Notes_UnderReview_by_seller'])) {
            $search_by_seller = $_POST['Notes_UnderReview_by_seller'];
            if(!empty($search_by_seller)) {
                $select_NotesUnderReview_sql_1 .= " AND users.user_id = $search_by_seller";
            }
        }
        $select_NotesUnderReview_sql_1 .= " ORDER BY seller_notes.created_date ASC";
        $select_NotesUnderReview_result_1 = query($select_NotesUnderReview_sql_1);
        confirmQuery($select_NotesUnderReview_result_1);
        $total_underReview_notes = row_count($select_NotesUnderReview_result_1);
        
        if(row_count($select_NotesUnderReview_result_1) > 0) {
            $select_NotesUnderReview_sql_2 = $select_NotesUnderReview_sql_1." LIMIT $offset, $limit";
            $select_NotesUnderReview_result_2 = query($select_NotesUnderReview_sql_2);
            confirmQuery($select_NotesUnderReview_result_2);
            
            $underReview_notes_output .= "<table class='table table-hover' id='notes-under-review-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Seller</th>
                                <th scope='col'></th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Status</th>
                                <th scope='col'>Action</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_NotesUnderReview_result_2)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['category_name'];
                $seller_id = $row['user_id'];
                $seller = $row['user_first_name']." ".$row['user_last_name'];
                $date = $row['created_date'];
                $status =$row['value'];
                $note_path = $row['attached_file_path'];
                $note_path_name = $row['attached_file_name'];

                $date_added = new DateTime($date);
                $date_added = $date_added->format('d-m-Y, H:i');

                $underReview_notes_output .= "<tr>
        <td>$sr_no</td>
        <td><a href='Note-Details.php?note_id=$note_id'>$note_title</a></td>
        <td>$note_category</td>
        <td>$seller</td>
        <td>
            <div class='action-img'>
                <div class='view-seller-icon'>
                    <a href='Member-Details.php?member_id=$seller_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>$date_added</td>
        <td style='text-transform: capitalize;'>$status</td>
        <td id='three-btn-row-td'>
            <div class='notes-under-review-action-btns' role='toolbar' aria-label='Toolbar with button groups'>
                <div class='btn-group mr-2' role='group' aria-label='approve'>
                    <a role='button' class='btn btn-sm btn-success approve_note' id='$note_id'>Approve</a>
                </div>
                <div class='btn-group mr-2' role='group' aria-label='reject'>
                    <a role='button' class='btn btn-sm btn-danger reject_note' id='$note_id' rel='$note_title'>Reject</a>
                </div>
                <div class='btn-group mr-2' role='group' aria-label='inreview'>
                    <a role='button' class='btn btn-sm btn-secondary in_review_note' id='$note_id'>InReview</a>
                </div>
            </div>
        </td>
        <td>
            <div class='action-img'>
                <div class='action-notes-under-review dropleft'>
                    <a id='notes-under-review-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Note-details.php?note_id=$note_id'>View More Details</a>
                        <a class='dropdown-item' href='Notes-Under-Review.php?admin_download_note=$note_path&admin_download_note_name=$note_path_name'>Download Notes</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;
            }
            $underReview_notes_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_underReview_notes/$limit);
            
            $underReview_notes_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_underReview_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_underReview_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $underReview_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $underReview_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_underReview_page_next' href='' aria-label='Next'>
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
        
        echo $underReview_notes_output;
        
    }

    
    if(isset($_POST['admin_published_note'])) {
        
        $published_notes_output = "";
        $limit = 5;

        if(isset($_POST['published_page_no'])) {
            $page_no = $_POST['published_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_published_note_sql_1 = "SELECT seller_notes.note_id, seller_notes.note_title, seller_notes.is_note_paid, seller_notes.note_price, seller_notes.note_published_date, note_category.category_name,seller.user_first_name AS seller_first_name,seller.user_last_name AS seller_last_name, seller.user_id AS seller_id, seller_notes_attachment.attached_file_path, seller_notes_attachment.attached_file_name, approved_by.user_first_name AS approved_by_first_name, approved_by.user_last_name AS approved_by_last_name FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users seller ON seller_notes.seller_id=seller.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN users approved_by ON seller_notes.actioned_by=approved_by.user_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value = 'published'";
        
        if(isset($_POST['published_note_search_field'])) {
            $search = $_POST['published_note_search_field'];
            $select_published_note_sql_1 .= " AND (seller_notes.note_title LIKE '%$search%' OR note_category.category_name LIKE '%$search%' OR seller_notes.note_price LIKE '%$search%' OR seller.user_first_name LIKE '%$search%' OR seller.user_last_name LIKE '%$search%' OR approved_by.user_first_name LIKE '%$search%' OR approved_by.user_last_name LIKE '%$search%' OR seller_notes.note_published_date LIKE '%$search%')";
        }
        if(isset($_POST['published_by_seller'])) {
            $search_by_seller = $_POST['published_by_seller'];
            if(!empty($search_by_seller)) {
                $select_published_note_sql_1 .= " AND seller.user_id = $search_by_seller";
            }
        }
        $select_published_note_sql_1 .= " ORDER BY seller_notes.note_published_date DESC";
        $select_published_note_result_1 = query($select_published_note_sql_1);
        confirmQuery($select_published_note_result_1);
        $total_published_note = row_count($select_published_note_result_1);
        
        if(row_count($select_published_note_result_1) > 0) {
            
            $select_published_note_sql_2 = $select_published_note_sql_1." LIMIT $offset, $limit";
            $select_published_note_result_2 = query($select_published_note_sql_2);
            confirmQuery($select_published_note_result_2);
            
            $published_notes_output .= "<table class='table table-hover' id='published-note-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Sell Type</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Seller</th>
                                <th scope='col'></th>
                                <th scope='col'>Published Date</th>
                                <th scope='col'>Approved By</th>
                                <th scope='col'>Number of Downloads</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_published_note_result_2)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $note_category_name= $row['category_name'];
                $sell_mode = $row['is_note_paid'];
                $note_price = round($row['note_price']);
                $date = $row['note_published_date'];
                $seller = $row['seller_first_name']." ".$row['seller_last_name'];
                $seller_id = $row['seller_id'];
                $approved_by = $row['approved_by_first_name']." ".$row['approved_by_last_name'];
                $path = $row['attached_file_path'];
                $path_name = $row['attached_file_name'];

                $note_published_date = new DateTime($date);
                $note_published_date = $note_published_date->format('d-m-Y, H:i');

                if($sell_mode == 1) {
                    $sell_type = "Paid";
                }
                else {
                    $sell_type = "Free";
                }

                $downloads_count_sql = "SELECT * FROM downloads WHERE downloaded_note_id = $note_id AND is_allowed_download = 1 AND attachment_path IS NOT NULL";
                $downloads_count_result = query($downloads_count_sql);
                confirmQuery($downloads_count_result);
                $downloads_count = row_count($downloads_count_result);

                $published_notes_output .= " <tr>
        <td>$sr_no</td>
        <td><a href='Notes-details.php?note_id=$note_id'>$note_title</a></td>
        <td>$note_category_name</td>
        <td>$sell_type</td>
        <td>$$note_price</td>
        <td>$seller</td>
        <td>
            <div class='action-img'>
                <div class='view-publisher-icon'>
                    <a href='Member-details.php?member_id=$seller_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>$note_published_date</td>
        <td>$approved_by</td>
        <td><a href='Downloads-notes.php'>$downloads_count</a></td>
        <td>
            <div class='action-img'>
                <div class='action-published-note dropleft'>
                    <a id='published-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Published-Notes.php?admin_download_note=$path&admin_download_note_name=$path_name'>Download Notes</a>
                        <a class='dropdown-item' href='Note-details.php?note_id=$note_id'>View More Details</a>
                        <a role='button' class='dropdown-item unpublish_note' id='$note_id' rel='$note_title'>Unpublish</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;

            }
            $published_notes_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_published_note/$limit);
            
            $published_notes_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_published_note_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_published_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $published_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $published_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_published_page_next' href='' aria-label='Next'>
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
        
        echo $published_notes_output;
    }
    
?>