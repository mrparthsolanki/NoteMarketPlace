<?php  include "include/header.php"; ?>
<?php
    if(isset($_POST["inprogress_notes"])) {
        $inprogress_notes_output = "";
        
        $the_user_id = $_SESSION['user_id'];
        
        $limit = 5;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $inprogress_note_query_1 = "SELECT sn.note_id, sn.seller_id, rd.value, sn.note_title, nc.category_name, sn.created_date FROM seller_notes sn JOIN reference_data rd ON sn.note_status = rd.reference_id JOIN note_category nc ON sn.note_category = nc.category_id WHERE seller_id = $the_user_id AND rd.value IN ('draft', 'submitted for review', 'in review') AND is_note_active = 1";
        
        if(isset($_POST['search_field_inprogress'])) {
            $search_inprogress = $_POST['search_field_inprogress'];
            $inprogress_note_query_1 .= " AND (sn.note_title LIKE '%$search_inprogress%' OR nc.category_name LIKE '%$search_inprogress%' OR rd.value LIKE '%$search_inprogress%')";
        }
        
        $inprogress_note_query_1 .= "ORDER BY sn.created_date DESC LIMIT $offset, $limit";
        
        $inprogress_note_result_1 = query($inprogress_note_query_1);
        confirmQuery($inprogress_note_result_1);
        
        if(row_count($inprogress_note_result_1) > 0) {
            $inprogress_notes_output .= "<section id='dash-inprogress-notes-info'>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 col-md-12'>
                        <table class='table table-hover table-responsive w-100 d-block d-md-table' id='inprogress-notes-table'>
                            <thead>
                                <tr>
                                    <th scope='col'>Added Date</th>
                                    <th scope='col'>Title</th>
                                    <th scope='col'>Category</th>
                                    <th scope='col'>Status</th>
                                    <th scope='col'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>";
             while($row = fetch_array($inprogress_note_result_1)) {
                $note_id = $row['note_id'];
                $seller_id = $row['seller_id'];
                $note_status = $row['value'];
                $note_title = $row['note_title'];
                $note_category = $row['category_name'];
                $note_created_date = $row['created_date'];
                
                $note_date = new DateTime($note_created_date);

                $note_date = $note_date->format('d-m-Y');
                
                
                $inprogress_notes_output .= "<tr>
                        <td>{$note_date}</td>
                        <td>{$note_title}</td>
                        <td>{$note_category}</td>
                        <td>{$note_status}</td>";
                
                if($note_status === "draft") {
                    $inprogress_notes_output .= "<td>
                            <div class='action-img'>
                                <div class='dash-edit-inprogress-note'>
                                    <a href='EditNotes.php?edit_note_id={$note_id}'><img src='images/Dashboard/edit.png' alt='Edit' class='img-responsive'></a>
                                    </div>
                                <div class='dash-delete-inprogress-note'>
                                    <a onclick='javascript: return confirm(\"Are you sure, you want to delete this note?\")' href='NoteOperation.php?delete_inprogress_note=$note_id'><img src='images/Dashboard/delete.png' alt='Delete' class='img-responsive'></a>
                                </div>
                            </div>
                        </td>
                    </tr>";
                }
                else {
                    $inprogress_notes_output .= "<td>
                            <div class='action-img'>
                                <div class='dash-view-inprogress-note'>
                                    <a href='Note_Details.php?note_id=$note_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                                </div>
                            </div>
                        </td>
                    </tr>";
                            
                }
            }
            $inprogress_notes_output .= "</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>";

            $inprogress_note_query_2 = "SELECT sn.note_id, sn.seller_id, rd.value, sn.note_title, nc.category_name, sn.created_date FROM seller_notes sn JOIN reference_data rd ON sn.note_status = rd.reference_id JOIN note_category nc ON sn.note_category = nc.category_id WHERE seller_id = $the_user_id AND rd.value IN ('draft', 'submitted for review', 'in review') AND is_note_active = 1";
        
            if(isset($_POST['search_field_inprogress'])) {
                $search_inprogress = $_POST['search_field_inprogress'];
                $inprogress_note_query_2 .= " AND (sn.note_title LIKE '%$search_inprogress%' OR nc.category_name LIKE '%$search_inprogress%' OR rd.value LIKE '%$search_inprogress%')";
            }
            
            $inprogress_note_query_2 .= "ORDER BY sn.created_date DESC";
            
            $inprogress_note_result_2 = query($inprogress_note_query_2);
            confirmQuery($inprogress_note_result_2);
            $totalRecords = row_count($inprogress_note_result_2);
            $totalPage = ceil($totalRecords/$limit);

            $inprogress_notes_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='inprogress_notes_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='inprogress_notes_prev' href='' aria-label='Previous'>
                            <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                        </a>
                    </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
               if ($i == $page_no) {
                $active = "active";
               }else{
                $active = "";
               }
                $inprogress_notes_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $inprogress_notes_output .= "<li class='page-item'>
                        <a class='page-link' id='inprogress_notes_next' href='' aria-label='Next'>
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
        echo $inprogress_notes_output;
    }
    
    if(isset($_POST["published_notes"])) {
        $published_notes_output = "";
        
        $the_user_id = $_SESSION['user_id'];
        
        $limit = 5;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
         
        $select_published_note_sql_1 = "SELECT * FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN reference_data ON seller_notes.note_status = reference_data.reference_id WHERE seller_id = $the_user_id AND value = 'published' AND is_note_active = 1";
        
        if(isset($_POST['search_field_publish'])) {
            $search_publish = $_POST['search_field_publish'];
            $select_published_note_sql_1 .= " AND (note_title LIKE '%$search_publish%' OR category_name LIKE '%$search_publish%' OR note_price LIKE '%$search_publish%')";
        }
        $select_published_note_sql_1 .= "ORDER BY seller_notes.note_published_date DESC  LIMIT $offset, $limit"; 
        $select_published_note_result_1 = query($select_published_note_sql_1);
        confirmQuery($select_published_note_result_1); 
        
        if(row_count($select_published_note_result_1) > 0) {
            $published_notes_output .= "<section id='dash-published-notes-info'>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 col-md-12'>
                        <table class='table table-hover table-responsive w-100 d-block d-md-table' id='published-notes-table'>
                            <thead>
                                <tr>
                                    <th scope='col'>Added Date</th>
                                    <th scope='col'>Title</th>
                                    <th scope='col'>Category</th>
                                    <th scope='col'>Sell Type</th>
                                    <th scope='col'>Price</th>
                                    <th scope='col'>Actions</th>
                                </tr>
                            </thead>
                            <tbody>";
            while($published_row = fetch_array($select_published_note_result_1)) {
                $note_id = $published_row['note_id'];
                $note_title = $published_row['note_title'];
                $note_category = $published_row['category_name'];
                $note_sell_mode = $published_row['is_note_paid'];
                $note_price = $published_row['note_price'];
                $published_date = $published_row['note_published_date'];

                $note_added_date = new DateTime($published_date);
                $note_added_date = $note_added_date->format('d-m-Y');

                if($note_sell_mode == 1) {
                    $sell_type = "paid";
                }
                else {
                    $sell_type = "Free";
                }
                if($note_price > 0) {
                    $price = "$".$note_price;
                }
                else {
                    $price = "$0";
                }

                $published_notes_output .= "<tr>
                <td>$note_added_date</td>
                <td>$note_title</td>
                <td>$note_category</td>
                <td>$sell_type</td>
                <td>$price</td>
                <td>
                    <div class='action-img'>
                        <div class='dash-view-published-note'>
                            <a href='Note_Details.php?note_id=$note_id'><img src='images/Dashboard/eye.png' alt='View' class='img-responsive'></a>
                        </div>
                    </div>
                </td>
            </tr>";

            }
            $published_notes_output .= "</tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>";
            
             $select_published_note_sql_2 = "SELECT * FROM seller_notes JOIN note_category ON seller_notes.note_category=note_category.category_id JOIN reference_data ON seller_notes.note_status = reference_data.reference_id WHERE seller_id = $the_user_id AND value = 'published' AND is_note_active = 1";
        
            if(isset($_POST['search_field_publish'])) {
                $search_publish = $_POST['search_field_publish'];
                $select_published_note_sql_2 .= " AND (note_title LIKE '%$search_publish%' OR category_name LIKE '%$search_publish%' OR note_price LIKE '%$search_publish%')";
            }
            $select_published_note_sql_2 .= "ORDER BY seller_notes.note_published_date DESC"; 
            $select_published_note_result_2 = query($select_published_note_sql_2);
            confirmQuery($select_published_note_result_2); 
            
            $totalRecords = row_count($select_published_note_result_2);
            $totalPage = ceil($totalRecords/$limit);
            
            $published_notes_output .= "<section class='dash-pagination'>
            <nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center' id='published_notes_pagination'>
                <li class='page-item'>
                        <a class='page-link' id='published_notes_prev' href='' aria-label='Previous'>
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
                            <a class='page-link' id='published_notes_next' href='' aria-label='Next'>
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