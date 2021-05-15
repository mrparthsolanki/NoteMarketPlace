<?php include "../Front/include/header.php"; ?>
<?php
    if(isset($_POST['spam_report'])) {
        $spam_report_data_output = "";
        $limit = 5;

        if (isset($_POST['spam_page_no'])) {
            $page_no = $_POST['spam_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_spam_sql_1 = "SELECT reported_note.report_id, reported_note.reported_note_id, reported_note.report_remarks, reported_note.created_date, downloads.attachment_path, downloads.note_title, downloads.note_category, users.user_first_name, users.user_last_name FROM reported_note JOIN downloads ON reported_note.against_download_id=downloads.download_id JOIN users ON reported_note.reported_by_id=users.user_id";
        
        if(isset($_POST['spam_search_field'])) {
            $search = $_POST['spam_search_field'];
            $select_spam_sql_1 .= " WHERE (reported_note.report_remarks LIKE '%$search%' OR downloads.note_title LIKE '%$search%' OR downloads.note_category LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%' OR reported_note.created_date LIKE '%$search%')";
        }
        $select_spam_sql_1 .= " ORDER BY reported_note.modified_date DESC";
        $select_spam_result_1 = query($select_spam_sql_1);
        confirmQuery($select_spam_result_1);
        $total_spam_count = row_count($select_spam_result_1);
        
        if(row_count($select_spam_result_1) > 0) {
            $select_spam_sql_2 = $select_spam_sql_1." LIMIT $offset, $limit";
            $select_spam_result_2 = query($select_spam_sql_2);
            confirmQuery($select_spam_result_2);
            
            $spam_report_data_output .= "<table class='table table-hover' id='spam-report-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Reported By</th>
                                <th scope='col'>Note Title</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Remark</th>
                                <th scope='col'>Action</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_spam_result_2)) {
                $report_id = $row['report_id'];
                $reported_note_id = $row['reported_note_id'];
                $report_remarks = $row['report_remarks'];
                $created_date = $row['created_date'];
                $note_path = $row['attachment_path'];
                $note_title = $row['note_title'];
                $note_category = $row['note_category'];
                $reported_by = $row['user_first_name']." ".$row['user_last_name'];

                $added_date = new DateTime($created_date);
                $added_date = $added_date->format("d-m-Y, H:i");

                $download_attachment_name_sql = "SELECT * FROM seller_notes_attachment WHERE attachment_note_id = $reported_note_id";
                $download_attachment_name_result = query($download_attachment_name_sql);
                confirmQuery($download_attachment_name_result);
                $row_21 = fetch_array($download_attachment_name_result);
                $note_path_name = $row_21['attached_file_name'];

                $spam_report_data_output .= "<tr>
        <td>$sr_no</td>
        <td>$reported_by</td>
        <td><a href='Note-Details.php?note_id=$reported_note_id'>$note_title</a></td>
        <td>$note_category</td>
        <td>$added_date</td>
        <td>$report_remarks</td>
        <td>
            <div class='action-img'>
                <div class='delete-spam-report'>
                    <a onclick='javascript: return confirm(\"Are you sure you want to delete reported issue\");' href='Spam-Reports.php?delete_report=$report_id'><img src='images/Dashboard/delete.png' alt='More' class='img-responsive'></a>
                </div>
            </div>
        </td>
        <td>
            <div class='action-img'>
                <div class='action-members dropleft'>
                    <a id='spam-report-action-dropdownMenu' href='' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='images/Dashboard/dots.png' alt='More' class='img-responsive'></a>

                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                        <a class='dropdown-item' href='Spam-Reports.php?admin_download_note=$note_path&admin_download_note_name=$note_path_name'>Download Notes</a>
                        <a class='dropdown-item' href='Note-Details.php?note_id=$reported_note_id'>View More Details</a>
                    </div>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;

            }
            $spam_report_data_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_spam_count/$limit);
            
            $spam_report_data_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='spam_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='spam_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $spam_report_data_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $spam_report_data_output .= "<li class='page-item'>
                        <a class='page-link' id='spam_page_next' href='' aria-label='Next'>
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
        
        echo $spam_report_data_output;
        
    }
    if(isset($_POST['manage_Admin'])) {
        $manage_Admin_output = "";
        $limit = 5;

        if (isset($_POST['mange_Admin_page_no'])) {
            $page_no = $_POST['mange_Admin_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_admin_sql_1 = "SELECT users.user_id, users.user_first_name, users.user_last_name, users.user_email_id, users.created_date, users.is_active, user_profile.user_phone_country_code, user_profile.user_phone_number FROM users JOIN user_roles ON users.user_role_id=user_roles.role_id JOIN user_profile ON users.user_id=user_profile.profile_user_id WHERE is_user_email_verified = 1 AND user_roles.role_name = 'admin'";
        
        if(isset($_POST['manage_Admin_search_field'])) {
            $search = $_POST['manage_Admin_search_field'];
            $select_admin_sql_1 .= " AND (users.user_email_id LIKE '%$search%' OR user_profile.user_phone_country_code LIKE '%$search%' OR user_profile.user_phone_number LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%' OR users.created_date LIKE '%$search%')";
        }
        $select_admin_sql_1 .= " ORDER BY users.created_date DESC";
        $select_admin_result_1 = query($select_admin_sql_1);
        confirmQuery($select_admin_result_1);
        $total_admins = row_count($select_admin_result_1);
        
        if(row_count($select_admin_result_1) > 0) {
            $select_admin_sql_2 = $select_admin_sql_1." LIMIT $offset, $limit";
            $select_admin_result_2 = query($select_admin_sql_2);
            confirmQuery($select_admin_result_2);
            
            $manage_Admin_output .= "<table class='table table-hover' id='administrator-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>First Name</th>
                                <th scope='col'>Last Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Phone No.</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Active</th>
                                <th scope='col'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            while($row = fetch_array($select_admin_result_2)) {
                $admin_id = $row['user_id'];
                $admin_first_name = $row['user_first_name'];
                $admin_last_name = $row['user_last_name'];
                $admin_email = $row['user_email_id'];
                $admin_phone = $row['user_phone_country_code']." ".$row['user_phone_number'];
                $admin_date = $row['created_date'];
                $admin_active = $row['is_active'];

                $admin_added_date = new DateTime($admin_date);
                $admin_added_date = $admin_added_date->format("d-m-Y, H:i");

                if($admin_active == 1) {
                    $admin_active_status = "Yes";
                }
                else {
                    $admin_active_status = "No";
                }

                $manage_Admin_output .= "<tr>
        <td>$sr_no</td>
        <td>$admin_first_name</td>
        <td>$admin_last_name</td>
        <td style='text-transform: lowercase;'>$admin_email</td>
        <td>$admin_phone</td>
        <td>$admin_added_date</td>
        <td>$admin_active_status</td>
        <td>
            <div class='action-img'>
                <div class='edit-admin'>
                    <a href='Edit_Administrator.php?admin_id_edit=$admin_id'><img src='images/Dashboard/edit.png' alt='Edit' class='img-responsive'></a>
                </div>
                <div class='delete-admin-action'>
                    <a onclick='javascript: return confirm(\"Are you sure you want to make this administrator inactive?\");' href='include/delete_category.php?admin_id=$admin_id'><img src='images/Dashboard/delete.png' alt='Delete' class='img-responsive'></a>
                </div>
            </div>
        </td>
    </tr>";
                $sr_no += 1;

            }
            $manage_Admin_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_admins/$limit);
            
            $manage_Admin_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='manage_Admin_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='manage_Admin_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $manage_Admin_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $manage_Admin_output .= "<li class='page-item'>
                        <a class='page-link' id='manage_Admin_page_next' href='' aria-label='Next'>
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
        
        echo $manage_Admin_output;
    }
?>