<?php include "../Front/include/header.php"; ?>
<?php
    if(isset($_POST['admin_downloaded_note'])) {
        $admin_downloaded_notes_output = "";
        $limit = 5;

        if (isset($_POST['downloaded_page_no'])) {
            $page_no = $_POST['downloaded_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $downloaded_note_sql_1 = "SELECT downloads.download_id, downloads.downloaded_note_id,downloads.attachment_path,downloads.attachment_downloaded_date,downloads.is_note_paid,downloads.purchased_price,downloads.note_title,downloads.note_category,buyer.user_id AS buyer_id,buyer.user_first_name AS buyer_firstname,buyer.user_last_name AS buyer_lastname,seller.user_id AS seller_id,seller.user_first_name AS seller_firstname,seller.user_last_name AS seller_lastname FROM downloads JOIN users buyer ON buyer.user_id=downloads.downloader JOIN users seller ON downloads.seller=seller.user_id WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND downloads.seller <> downloads.downloader";
        
        if(isset($_POST['downloaded_note_search_field'])) {
            $search = $_POST['downloaded_note_search_field'];
            $downloaded_note_sql_1 .= " AND (downloads.note_title LIKE '%$search%' OR downloads.note_category LIKE '%$search%' OR downloads.purchased_price LIKE '%$search%' OR buyer.user_first_name LIKE '%$search%' OR buyer.user_last_name LIKE '%$search%' OR seller.user_first_name LIKE '%$search%' OR seller.user_last_name LIKE '%$search%' OR downloads.attachment_downloaded_date LIKE '%$search%')";
        }
        if(isset($_POST['downloaded_by_seller'])) {
            $search_by_seller = $_POST['downloaded_by_seller'];
            if(!empty($search_by_seller)) {
                $downloaded_note_sql_1 .= " AND seller.user_id = $search_by_seller";
            }
        }
        if(isset($_POST['downloaded_by_buyer'])) {
            $search_by_buyer = $_POST['downloaded_by_buyer'];
            if(!empty($search_by_buyer)) {
                $downloaded_note_sql_1 .= " AND buyer.user_id = $search_by_buyer";
            }
        }
        if(isset($_POST['downloaded_by_note_cate'])) {
            $search_by_note_cate = $_POST['downloaded_by_note_cate'];
            if(!empty($search_by_note_cate)) {
                $downloaded_note_sql_1 .= " AND downloads.note_category = '$search_by_note_cate'";
            }
        }
        
        $downloaded_note_sql_1 .= " ORDER BY downloads.attachment_downloaded_date DESC";
        $downloaded_note_result_1 = query($downloaded_note_sql_1);
        confirmQuery($downloaded_note_result_1);
        $total_downloaded_notes = row_count($downloaded_note_result_1);
        
        if(row_count($downloaded_note_result_1) > 0) {
            
            $downloaded_note_sql_2 = $downloaded_note_sql_1." LIMIT $offset, $limit";
            $downloaded_note_result_2 = query($downloaded_note_sql_2);
            confirmQuery($downloaded_note_result_2);
            
            $admin_downloaded_notes_output .= "<table class='table table-hover' id='downloaded-note-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Buyer</th>
                                <th scope='col'></th>
                                <th scope='col'>Seller</th>
                                <th scope='col'></th>
                                <th scope='col'>Sell Type</th>
                                <th scope='col'>Price</th>
                                <th scope='col'>Downloaded Date/Time</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($downloaded_note_result_2)) {
                $download_id = $row['download_id'];
                $note_id = $row['downloaded_note_id'];
                $note_title = $row['note_title'];
                $category_name = $row['note_category'];
                $sell_mode = $row['is_note_paid'];
                $note_price = round($row['purchased_price']);
                $buyer_id = $row['buyer_id'];
                $buyer = $row['buyer_firstname']." ".$row['buyer_lastname'];
                $seller_id = $row['seller_id'];
                $seller = $row['seller_firstname']." ".$row['seller_lastname'];
                $date = $row['attachment_downloaded_date'];
                $note_path = $row['attachment_path'];
                
                $download_attachment_name_sql = "SELECT * FROM seller_notes_attachment WHERE attachment_note_id = $note_id";
                $download_attachment_name_result = query($download_attachment_name_sql);
                confirmQuery($download_attachment_name_result);
                $row_21 = fetch_array($download_attachment_name_result);
                $note_path_name = $row_21['attached_file_name'];
                
                if($sell_mode == 1) {
                    $sell_type = "Paid";
                }
                else {
                    $sell_type = "Free";
                }

                $downloaded_date = new DateTime($date);
                $downloaded_date = $downloaded_date->format("d-m-Y, H:i");

                $admin_downloaded_notes_output .= "<tr>
        <td>$sr_no</td>
        <td><a href='NoteDetails-admin.php?note_id=$note_id'>$note_title</a></td>
        <td>$category_name</td>
        <td>$buyer</td>
        <td>
            <div class='action-img'>
                <div class='view-downloaded-buyer-icon'>
                    <a href='Member-Details.php?member_id=$buyer_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>$seller</td>
        <td>
            <div class='action-img'>
                <div class='view-downloaded-seller-icon'>
                    <a href='Member-Details.php?member_id=$seller_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>$sell_type</td>
        <td>$$note_price</td>
        <td>$downloaded_date</td>
        <td>
            <div class='action-img'>
                <div class='action-downloaded-note dropleft'>
                    <a id='downloaded-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Downloads-notes.php?admin_download_note=$note_path&admin_download_note_name=$note_path_name'>Download Notes</a>
                        <a class='dropdown-item' href='Note-Details.php?note_id=$note_id'>View More Details</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";

            $sr_no += 1;    
            }
            
            $admin_downloaded_notes_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_downloaded_notes/$limit);
            
            $admin_downloaded_notes_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_downloaded_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_downloaded_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $admin_downloaded_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $admin_downloaded_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_downloaded_page_next' href='' aria-label='Next'>
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
        echo $admin_downloaded_notes_output;
    }

    if(isset($_POST['admin_rejected_note'])) {
        $admin_rejected_notes_output = "";
        $limit = 5;

        if (isset($_POST['rejected_page_no'])) {
            $page_no = $_POST['rejected_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $rejected_note_sql_1 = "SELECT seller_notes.note_id, seller_notes.note_title, seller_notes.modified_date, seller_notes.admin_remarks, note_category.category_name,seller.user_first_name AS seller_first_name,seller.user_last_name AS seller_last_name, seller.user_id AS seller_id, seller_notes_attachment.attached_file_path, seller_notes_attachment.attached_file_name, rejected_by.user_first_name AS rejected_by_first_name, rejected_by.user_last_name AS rejected_by_last_name FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN users seller ON seller_notes.seller_id=seller.user_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN users rejected_by ON seller_notes.actioned_by=rejected_by.user_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value = 'rejected'";
        
        if(isset($_POST['rejected_note_search_field'])) {
            $search = $_POST['rejected_note_search_field'];
            $rejected_note_sql_1 .= " AND (seller_notes.note_title LIKE '%$search%' OR note_category.category_name LIKE '%$search%' OR seller_notes.admin_remarks LIKE '%$search%' OR rejected_by.user_first_name LIKE '%$search%' OR rejected_by.user_last_name LIKE '%$search%' OR seller.user_first_name LIKE '%$search%' OR seller.user_last_name LIKE '%$search%' OR seller_notes.modified_date LIKE '%$search%')";
        }
        if(isset($_POST['seller_rejected_note'])) {
            $search_by_seller = $_POST['seller_rejected_note'];
            if(!empty($search_by_seller)) {
                $rejected_note_sql_1 .= " AND seller.user_id = $search_by_seller";
            }
        }
        $rejected_note_sql_1 .= " ORDER BY seller_notes.modified_date DESC";
        $rejected_note_result_1 = query($rejected_note_sql_1);
        confirmQuery($rejected_note_result_1);
        $total_rejected_notes = row_count($rejected_note_result_1);
        
        if(row_count($rejected_note_result_1) > 0) {
            
            $rejected_note_sql_2 = $rejected_note_sql_1." LIMIT $offset, $limit";
            $rejected_note_result_2 = query($rejected_note_sql_2);
            confirmQuery($rejected_note_result_2);
            
            $admin_rejected_notes_output .= "<table class='table table-hover' id='rejected-note-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Seller</th>
                                <th scope='col'></th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Rejected By</th>
                                <th scope='col'>Remark</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($rejected_note_result_2)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $note_category_name= $row['category_name'];
                $date = $row['modified_date'];
                $admin_remarks = $row['admin_remarks'];
                $seller = $row['seller_first_name']." ".$row['seller_last_name'];
                $seller_id = $row['seller_id'];
                $rejected_by = $row['rejected_by_first_name']." ".$row['rejected_by_last_name'];
                $path = $row['attached_file_path'];
                $path_name = $row['attached_file_name'];

                $note_date = new DateTime($date);
                $note_date = $note_date->format('d-m-Y, H:i');

                $admin_rejected_notes_output .= "<tr>
        <td>$sr_no</td>
        <td><a href='Note-Details.php?note_id=$note_id'>$note_title</a></td>
        <td>$note_category_name</td>
        <td>$seller</td>
        <td>
            <div class='action-img'>
                <div class='view-rejected-seller-icon'>
                    <a href='Member-details.php?member_id=$seller_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>$note_date</td>
        <td>$rejected_by</td>
        <td>$admin_remarks</td>
        <td>
            <div class='action-img'>
                <div class='action-rejected-note dropleft'>
                    <a id='rejected-note-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a role='button' id='$note_id' class='dropdown-item approve_note' href=''>Approve</a>
                        <a class='dropdown-item' href='Rejected-notes.php?admin_download_note=$path&admin_download_note_name=$path_name'>Download Notes</a>
                        <a class='dropdown-item' href='Note-details.php?note_id=$note_id'>View More Details</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;
            }
            $admin_rejected_notes_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_rejected_notes/$limit);
            
            $admin_rejected_notes_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_rejected_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_rejected_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $admin_rejected_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $admin_rejected_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_rejected_page_next' href='' aria-label='Next'>
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
        
        echo $admin_rejected_notes_output;
                            
    }

    if(isset($_POST['admin_members_data'])) {
        $admin_side_members_output = "";
        $limit = 5;

        if (isset($_POST['members_page_no'])) {
            $page_no = $_POST['members_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_members_sql_1 = "SELECT users.user_id, users.user_first_name, users.user_last_name, users.user_email_id, users.created_date FROM users JOIN user_roles ON users.user_role_id=user_roles.role_id WHERE is_user_email_verified = 1 AND user_roles.role_name = 'member' AND users.is_active = 1";
        
        if(isset($_POST['members_search_field'])) {
            $search = $_POST['members_search_field'];
            $select_members_sql_1 .= " AND (users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%' OR users.user_email_id LIKE '%$search%' OR users.created_date LIKE '%$search%')";
        }
        $select_members_sql_1 .= " ORDER BY users.created_date DESC";
        $select_members_result_1 = query($select_members_sql_1);
        confirmQuery($select_members_result_1);
        $total_members = row_count($select_members_result_1);
        
        if(row_count($select_members_result_1) > 0) {
            $select_members_sql_2 = $select_members_sql_1." LIMIT $offset, $limit";
            $select_members_result_2 = query($select_members_sql_2);
            confirmQuery($select_members_result_2);
            
            $admin_side_members_output .= "<table class='table table-hover' id='members-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>First Name</th>
                                <th scope='col'>Last Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Joining Added</th>
                                <th scope='col'>Under Review Notes</th>
                                <th scope='col'>Published Notes</th>
                                <th scope='col'>Downloaded Notes</th>
                                <th scope='col'>Total Expenses</th>
                                <th scope='col'>Total Earnings</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_members_result_2)) {
                $member_id = $row['user_id'];
                $member_first_name = $row['user_first_name'];
                $member_last_name = $row['user_last_name'];
                $member_email = $row['user_email_id'];
                $member_date = $row['created_date'];

                $join_date = new DateTime($member_date);
                $join_date = $join_date->format("d-m-Y, H:i");

                $member_inreview_count_sql = "SELECT * FROM seller_notes JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_id = $member_id AND seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value IN ('submitted for review', 'in review')";
                $member_inreview_count_result = query($member_inreview_count_sql);
                confirmQuery($member_inreview_count_result);
                $member_inreview_count = row_count($member_inreview_count_result);

                $member_published_count_sql ="SELECT * FROM seller_notes JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value = 'published' AND seller_id = $member_id";
                $member_published_count_result = query($member_published_count_sql);
                confirmQuery($member_published_count_result);
                $member_published_count = row_count($member_published_count_result);

                $member_downloads_count_sql = "SELECT COUNT(download_id) AS download_count, SUM(purchased_price) AS total_expense FROM downloads  WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND seller <> downloader AND downloader = $member_id";
                $member_downloads_count_result = query($member_downloads_count_sql);
                confirmQuery($member_downloads_count_result);
                $member_downloads_count_row = fetch_array($member_downloads_count_result);
                $downloads_count = $member_downloads_count_row['download_count'];
                $total_expense = round($member_downloads_count_row['total_expense']);

                $member_earning_sql = "SELECT SUM(purchased_price) AS total_earning FROM downloads WHERE is_allowed_download = 1 AND attachment_path IS NOT NULL AND seller = $member_id";
                $member_earning_result = query($member_earning_sql);
                confirmQuery($member_earning_result);
                $earning_row = fetch_array($member_earning_result);
                $total_earning = round($earning_row['total_earning']);


                $admin_side_members_output .= "<tr>
        <td>$sr_no</td>
        <td>$member_first_name</td>
        <td>$member_last_name</td>
        <td>$member_email</td>
        <td class='member_joindate_td'>$join_date</td>
        <td><a href='Notes-Under-Review.php?member_inreview_note=$member_id'>$member_inreview_count</a></td>
        <td><a href='Published-Notes.php?member_published_note=$member_id'>$member_published_count</a></td>
        <td><a href='Downloads-notes.php?member_downloaded_note=$member_id'>$downloads_count</a></td>
        <td><a href='Downloads-notes.php?member_downloaded_note=$member_id'>$$total_expense</a></td>
        <td>$$total_earning</td>
        <td>
            <div class='action-img'>
                <div class='action-members dropleft'>
                    <a id='members-action-dropdownMenu' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Member-Details.php?member_id=$member_id'>View More Details</a>
                        <a class='dropdown-item' onclick='javascript: return confirm(\"Are you sure you want to make this member inactive?\");' href='Members.php?deactivate_member_id=$member_id'>Deactivate</a>
                    </div>

                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;
            }
            $admin_side_members_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_members/$limit);
            
            $admin_side_members_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_members_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_member_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $admin_side_members_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $admin_side_members_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_member_page_next' href='' aria-label='Next'>
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
        echo $admin_side_members_output;
    }

    if(isset($_POST['admin_members_detail_data'])) {
        $admin_side_members_detail_output = "";
        $limit = 5;

        if (isset($_POST['members_detail_page_no'])) {
            $page_no = $_POST['members_detail_page_no'];
        }else{
            $page_no = 1;
        }
        $the_member_id = $_POST['member_id_ajax'];
        $offset = ($page_no-1) * $limit;
        $select_member_notes_sql_1 = "SELECT seller_notes.note_id, seller_notes.note_title, note_category.category_name, seller_notes.created_date, seller_notes.note_published_date, seller_notes_attachment.attached_file_path, seller_notes_attachment.attached_file_name, reference_data.value FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id WHERE seller_notes.seller_id = $the_member_id AND seller_notes.is_note_active = 1 AND reference_data.ref_category = 'note status' AND reference_data.value IN ('submitted for review', 'in review', 'published')  ORDER BY seller_notes.created_date DESC";
        $select_member_notes_result_1 = query($select_member_notes_sql_1);
        confirmQuery($select_member_notes_result_1);
        $total_members_note = row_count($select_member_notes_result_1);
        
        if(row_count($select_member_notes_result_1) > 0) {
            
            $select_member_notes_sql_2 = $select_member_notes_sql_1." LIMIT $offset, $limit";
            $select_member_notes_result_2 = query($select_member_notes_sql_2);
            confirmQuery($select_member_notes_result_2);
            
            $admin_side_members_detail_output .= "<table class='table table-hover' id='member-detail-note-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Satus</th>
                                <th scope='col'>Downloaded Notes</th>
                                <th scope='col'>Total Earnings</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Published Date</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_member_notes_result_2)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['category_name'];
                $date_1 = $row['created_date'];
                $date_2 = $row['note_published_date'];
                $status =$row['value'];
                $note_path = $row['attached_file_path'];
                $note_path_name = $row['attached_file_name'];

                $date_added = new DateTime($date_1);
                $date_added = $date_added->format('d-m-Y, H:i');

                if (is_null($date_2)) {
                    $published_date = "NA";
                }
                else {
                    $published_date = new DateTime($date_2);
                    $published_date = $published_date->format('d-m-Y, H:i');
                }

                $download_count_sql = "SELECT COUNT(downloaded_note_id) AS downloaded_notes, SUM(purchased_price) AS total_earning FROM downloads WHERE downloaded_note_id = $note_id AND seller = $the_member_id AND downloader <> $the_member_id AND is_allowed_download = 1  AND attachment_path IS NOT NULL";
                $download_count_result = query($download_count_sql);
                confirmQuery($download_count_result);
                $count_row = fetch_array($download_count_result);
                $downloads_count = $count_row['downloaded_notes'];
                $total_earning = round($count_row['total_earning']);

                if(is_null($total_earning) || $downloads_count == 0) {
                    $total_earning=0;
                }

                $admin_side_members_detail_output .= "<tr>
        <td>$sr_no</td>
        <td><a href='Note-Details.php?note_id=$note_id'>$note_title</a></td>
        <td>$note_category</td>
        <td style='text-transform:capitalize;'>$status</td>
        <td><a href='Downloads-Notes.php'>$downloads_count</a></td>
        <td>$$total_earning</td>
        <td>$date_added</td>
        <td>$published_date</td>
        <td>
            <div class='action-img'>
                <div class='action-member-detail-note dropleft'>
                    <a id='member-detail-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>
                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Member-Details.php?member_id=$the_member_id&admin_download_note=$note_path&admin_download_note_name=$note_path_name'>Download Notes</a>
                    </div>

                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;
            }
            $admin_side_members_detail_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_members_note/$limit);
            
            $admin_side_members_detail_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='admin_members_detail_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='admin_member_detail_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $admin_side_members_detail_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $admin_side_members_detail_output .= "<li class='page-item'>
                        <a class='page-link' id='admin_member_detail_page_next' href='' aria-label='Next'>
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
            
        echo $admin_side_members_detail_output;
        
    }
?>    