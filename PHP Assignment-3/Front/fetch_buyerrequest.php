<?php  include "include/header.php"; ?>
<?php 
       
    if(isset($_POST['buyerrequest'])) {
        $buyerrequest_output = "";
        $the_user_id = $_SESSION['user_id'];


        $limit = 10;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;

        $buyer_request_sql_1 = "SELECT * FROM downloads d JOIN users u ON d.downloader=u.user_id JOIN user_profile up ON d.downloader=up.profile_user_id WHERE is_allowed_download = 0 AND is_note_paid = 1 AND seller = '{$the_user_id}'";

        if(isset($_POST['search_buyerrequest'])) {
            $search = $_POST['search_buyerrequest'];
            $buyer_request_sql_1 .= " AND (note_title LIKE '%$search%' OR note_category LIKE '%$search%' OR user_email_id LIKE '%$search%' OR user_phone_country_code LIKE '%$search%' OR user_phone_number LIKE '%$search%' OR purchased_price LIKE '%$search%')";
        }   

        $buyer_request_sql_1 .= "ORDER BY attachment_downloaded_date DESC LIMIT $offset, $limit";
        $buyer_request_result_1 = query($buyer_request_sql_1);
        confirmQuery($buyer_request_result_1);

        if(row_count($buyer_request_result_1) > 0) {
            $buyerrequest_output .= "<section id='buyerrequest-notes-info'>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 col-md-12'>
                        <table class='table table-hover table-responsive w-100 d-block d-md-table' id='buyerrequest-notes-table'>
                            <thead>
                                <tr>
                                    <th scope='col'>Sr no.</th>
                                    <th scope='col'>Note Title</th>
                                    <th scope='col'>Category</th>
                                    <th scope='col'>Buyer</th>
                                    <th scope='col'>Phone No.</th>
                                    <th scope='col'>Sell Type</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Downloaded Date/Time</th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($buyer_request_result_1)) {
                $download_id = $row['download_id'];
                $note_id = $row['downloaded_note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['note_category'];
                $buyer = $row['user_email_id'];
                $phone = $row['user_phone_country_code']." ".$row['user_phone_number'];
                $sell_type = "Paid";
                $price = "$".$row['purchased_price'];
                $date_time = $row['attachment_downloaded_date'];

                $downloaded_date = new DateTime($date_time);
                $downloaded_date = $downloaded_date->format('d M Y, H:i:s');

                $buyerrequest_output .= "<tr>
                <td>{$sr_no}</td>
                <td><a href='Note_Details.php?note_id={$note_id}'>{$note_title}</a></td>
                <td>{$note_category}</td>
                <td>{$buyer}</td>
                <td>{$phone}</td>
                <td>{$sell_type}</td>
                <td>{$price}</td>
                <td>{$downloaded_date}</td>
                <td>
                    <div class='action-img'>
                        <div class='view-buyerrequest-note'>
                            <a href='Note_Details.php?note_id={$note_id}'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                        </div>
                        <div class='buyerrequest-note-action dropleft'>
                            <a href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                <a class='dropdown-item' href='NoteOperation.php?allow_download_id={$download_id}&allow_download_note_id={$note_id}'>Allow Download</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>";
            $sr_no += 1;    
            }
            $buyerrequest_output .= "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>";
            
            $buyer_request_sql_2 = "SELECT * FROM downloads d JOIN users u ON d.downloader=u.user_id JOIN user_profile up ON d.downloader=up.profile_user_id WHERE is_allowed_download = 0 AND is_note_paid = 1 AND seller = '{$the_user_id}'";

            if(isset($_POST['search_buyerrequest'])) {
                $search = $_POST['search_buyerrequest'];
                $buyer_request_sql_2 .= " AND (note_title LIKE '%$search%' OR note_category LIKE '%$search%' OR user_email_id LIKE '%$search%' OR user_phone_country_code LIKE '%$search%' OR user_phone_number LIKE '%$search%' OR purchased_price LIKE '%$search%')";
            }   

            $buyer_request_sql_2 .= "ORDER BY attachment_downloaded_date DESC";
            $buyer_request_result_2 = query($buyer_request_sql_2);
            confirmQuery($buyer_request_result_2);
            
            $totalRecords = row_count($buyer_request_result_2);
            $totalPage = ceil($totalRecords/$limit);
            
            $buyerrequest_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='buyerrequest_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='buyerrequest_prev' href='' aria-label='Previous'>
                            <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                        </a>
                    </li>";
            for ($i=1; $i <= $totalPage ; $i++) { 
               if ($i == $page_no) {
                $active = "active";
               }else{
                $active = "";
               }
               $buyerrequest_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $buyerrequest_output .= "<li class='page-item'>
                        <a class='page-link' id='buyerrequest_next' href='' aria-label='Next'>
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
        
        echo $buyerrequest_output;
    }

    if(isset($_POST['rejected_note'])) {
        $rejected_output = "";
        
        $the_user_id = $_SESSION['user_id'];


        $limit = 10;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_rejected_note_sql_1 = "SELECT seller_notes.note_id,seller_notes.note_title,note_category.category_name,seller_notes.admin_remarks,seller_notes_attachment.attached_file_path, seller_notes_attachment.attached_file_name,seller_notes.modified_date  FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_id = $the_user_id AND reference_data.value = 'rejected' AND is_note_active = 1";
        if(isset($_POST['search_rejected'])) {
            $search_rejected = $_POST['search_rejected'];
            $select_rejected_note_sql_1 .= " AND (note_title LIKE '%$search_rejected%' OR category_name LIKE '%$search_rejected%' OR admin_remarks LIKE '%$search_rejected%')";
        }
        $select_rejected_note_sql_1 .= " ORDER BY seller_notes.modified_date DESC LIMIT $offset, $limit";
        $select_rejected_note_result_1 = query($select_rejected_note_sql_1);
        confirmQuery($select_rejected_note_result_1);
        
        if(row_count($select_rejected_note_result_1) > 0){
            $rejected_output .= "<section id='myrejected-notes-info'>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 col-md-12'>
                        <table class='table table-hover table-responsive w-100 d-block d-md-table' id='myrejected-notes-table'>
                            <thead>
                                <tr>
                                    <th scope='col'>Sr no.</th>
                                    <th scope='col'>Note Title</th>
                                    <th scope='col'>Category</th>
                                    <th scope='col'>Remarks</th>
                                    <th scope='col'>Date Edited</th>
                                    <th scope='col'>Clone</th>
                                    <th scope='col'></th>
                                </tr>
                            </thead>
                            <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_rejected_note_result_1)) {
                $note_id = $row['note_id'];
                $note_title = $row['note_title'];
                $note_category = $row['category_name'];
                $admin_remark = $row['admin_remarks'];
                $attachment_path = $row['attached_file_path'];
                $attachment_path_name = $row['attached_file_name'];
                $date_edited = $row['modified_date'];
                
                $edited_date = new DateTime($date_edited);
                $edited_date = $edited_date->format("d-m-Y, H:i");
                $rejected_output .= "<tr>
                <td>$sr_no</td>
                <td><a href='Note_Details.php?note_id=$note_id'>$note_title</a></td>
                <td>$note_category</td>
                <td>$admin_remark</td>
                <td>$edited_date</td>
                <td><a href='RejectedNotes.php?rejected_note_id_edit=$note_id'>Clone</a></td>
                <td>
                    <div class='action-img'>
                        <div class='myrejected-note-action dropleft'>
                            <a href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='Edit' class='img-responsive'></a>

                            <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                                <a class='dropdown-item' href='RejectedNotes.php?download_rejected_note=$attachment_path&admin_download_note_name=$attachment_path_name'>Download Note</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>";
                $sr_no += 1;
            }
            $rejected_output .= "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>";
            
            $select_rejected_note_sql_2 = "SELECT * FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN seller_notes_attachment ON seller_notes.note_id=seller_notes_attachment.attachment_note_id JOIN reference_data ON seller_notes.note_status=reference_data.reference_id WHERE seller_id = $the_user_id AND reference_data.value = 'rejected' AND is_note_active = 1";
            if(isset($_POST['search_rejected'])) {
                $search_rejected = $_POST['search_rejected'];
                $select_rejected_note_sql_2 .= " AND (note_title LIKE '%$search_rejected%' OR category_name LIKE '%$search_rejected%' OR admin_remarks LIKE '%$search_rejected%')";
            }
            $select_rejected_note_sql_2 .= "ORDER BY seller_notes.modified_date DESC";
            $select_rejected_note_result_2 = query($select_rejected_note_sql_2);
            confirmQuery($select_rejected_note_result_2);
            
            $totalRecords = row_count($select_rejected_note_result_2);
            $totalPage = ceil($totalRecords/$limit);
            
            $rejected_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='rejected_notes_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='rejected_notes_prev' href='' aria-label='Previous'>
                            <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                        </a>
                    </li>";
            for ($i=1; $i <= $totalPage ; $i++) { 
               if ($i == $page_no) {
                $active = "active";
               }else{
                $active = "";
               }
               
                $rejected_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            
            $rejected_output .= "<li class='page-item'>
                        <a class='page-link' id='rejected_notes_next' href='' aria-label='Next'>
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
        
        echo $rejected_output;
    }
?>