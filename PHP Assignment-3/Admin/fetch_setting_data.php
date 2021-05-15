<?php include "../Front/include/header.php"; ?>
<?php
    if(isset($_POST['category_data'])) {
        $category_data_output = "";
        $limit = 5;

        if (isset($_POST['category_page_no'])) {
            $page_no = $_POST['category_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_category_query_1 = "SELECT note_category.category_id,note_category.category_name,note_category.category_description,note_category.is_active,note_category.created_date,users.user_first_name,users.user_last_name FROM note_category JOIN users ON note_category.created_by=users.user_id";
        
        if(isset($_POST['category_search_field'])) {
            $search = $_POST['category_search_field'];
            $select_category_query_1 .= " WHERE (note_category.category_name LIKE '%$search%' OR note_category.category_description LIKE '%$search%' OR note_category.created_date LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%')";
        }
        $select_category_query_1 .= " ORDER BY `note_category`.`category_id` DESC";
        
        $check_select_category_query_1 = query($select_category_query_1);
        confirmQuery($check_select_category_query_1);
        $total_cataegories = row_count($check_select_category_query_1);
        
        if(row_count($check_select_category_query_1) > 0) {
            $select_category_query_2 = $select_category_query_1." LIMIT $offset, $limit";
            $check_select_category_query_2 = query($select_category_query_2);
            confirmQuery($check_select_category_query_2);
            
            $category_data_output .= "<table class='table table-hover' id='published-notes-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Category</th>
                                <th scope='col'>Description</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Added By</th>
                                <th scope='col'>Active</th>
                                <th scope='col'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            $active = "Yes";
            while($row = fetch_array($check_select_category_query_2)){
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];
                $is_category_active = $row['is_active'];
                $category_date_added = $row['created_date'];
                $category_added_by_user = $row['user_first_name']." ".$row['user_last_name'];
                if ($is_category_active == 1){
                    $active = "Yes";
                }
                else{
                    $active = "No";
                }
                $date = new DateTime($category_date_added);

                $date = $date->format('d-m-Y, H:i');
                $category_data_output .= "<tr>
                        <td>{$sr_no}</td>
                        <td>{$category_name}</td>
                        <td>{$category_description}</td>
                        <td>{$date}</td>
                        <td>{$category_added_by_user}</td>
                        <td>{$active}</td>
                        <td>
                            <div class='action-img'>
                                <div class='edit-category'>
                                    <a href='Edit_Category.php?cate_id={$category_id}'><img src='images/Dashboard/edit.png' alt='Edit' class='img-risponsive'></a>
                                </div>
                                <div class='delete-category-action'>
                                    <a onclick='javascript: return confirm(\"Are you sure you want to make this category inactive?\");' href='include/delete_category.php?cate_id={$category_id}'><img src='images/Dashboard/delete.png' alt='Delete' class='img-risponsive'></a>
                                </div>
                            </div>
                        </td>
                    </tr>";

                $sr_no += 1;
            }
            $category_data_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_cataegories/$limit);
            
            $category_data_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='category_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='category_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $category_data_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $category_data_output .= "<li class='page-item'>
                        <a class='page-link' id='category_page_next' href='' aria-label='Next'>
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
        echo $category_data_output;
    }
    
    if(isset($_POST['type_data'])) {
        $type_data_output = "";
        $limit = 5;

        if (isset($_POST['type_page_no'])) {
            $page_no = $_POST['type_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_type_query_1 = "SELECT note_type.type_id, note_type.type_name, note_type.type_description,note_type.created_date, note_type.is_active, users.user_first_name,users.user_last_name FROM note_type JOIN users ON note_type.created_by=users.user_id";
        
        if(isset($_POST['type_search_field'])) {
            $search = $_POST['type_search_field'];
            $select_type_query_1 .= " WHERE (note_type.type_name LIKE '%$search%' OR note_type.type_description LIKE '%$search%' OR note_type.created_date LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%')";
        }
        
        $select_type_query_1 .= " ORDER BY note_type.created_date DESC";
        $check_select_type_query_1 = query($select_type_query_1);
        confirmQuery($check_select_type_query_1);
        $total_types = row_count($check_select_type_query_1);
        
        if(row_count($check_select_type_query_1) > 0){
            $select_type_query_2 = $select_type_query_1." LIMIT $offset, $limit";
            $check_select_type_query_2 = query($select_type_query_2);
            confirmQuery($check_select_type_query_2);
            
            $type_data_output .= "<table class='table table-hover' id='type-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Type</th>
                                <th scope='col'>Description</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Added By</th>
                                <th scope='col'>Active</th>
                                <th scope='col'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            $sr_no = ($limit*$page_no-($limit-1));
            $active = "Yes";
            while($row = fetch_array($check_select_type_query_2)){
                $type_id = $row['type_id'];
                $type_name = $row['type_name'];
                $type_description = $row['type_description'];
                $is_type_active = $row['is_active'];
                $type_date_added = $row['created_date'];
                $type_added_by_user = $row['user_first_name']." ".$row['user_last_name'];
                if ($is_type_active == 1){
                    $active = "Yes";
                }
                else{
                    $active = "No";
                }
                $date = new DateTime($type_date_added);

                $date = $date->format('d-m-Y, H:i');
                
                $type_data_output .= "<tr>
                        <td>{$sr_no}</td>
                        <td>{$type_name}</td>
                        <td>{$type_description}</td>
                        <td>{$date}</td>
                        <td>{$type_added_by_user}</td>
                        <td>{$active}</td>
                        <td>
                            <div class='action-img'>
                                <div class='edit-type'>
                                    <a href='Edit_Type.php?type_id={$type_id}'><img src='images/Dashboard/edit.png' alt='Edit' class='img-risponsive'></a>
                                </div>
                                <div class='delete-type-action'>
                                    <a onclick='javascript: return confirm(\"Are you sure you want to make this type inactive?\");' href='include/delete_category.php?type_id={$type_id}'><img src='images/Dashboard/delete.png' alt='Delete' class='img-risponsive'></a>
                                </div>
                            </div>
                        </td>
                    </tr>";

                $sr_no += 1;
            }
            $type_data_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_types/$limit);
            
            $type_data_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='type_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='type_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $type_data_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $type_data_output .= "<li class='page-item'>
                        <a class='page-link' id='type_page_next' href='' aria-label='Next'>
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
        
        echo $type_data_output;
    }

    if(isset($_POST['country_data'])) {
        $country_data_output = "";
        $limit = 5;

        if (isset($_POST['country_page_no'])) {
            $page_no = $_POST['country_page_no'];
        }else{
            $page_no = 1;
        }

        $offset = ($page_no-1) * $limit;
        
        $select_country_query_1 = "SELECT note_country.country_id, note_country.country_name, note_country.country_code, note_country.created_date, note_country.is_active, users.user_first_name, users.user_last_name FROM note_country JOIN users ON note_country.created_by=users.user_id";
        
        if(isset($_POST['country_search_field'])) {
            $search = $_POST['country_search_field'];
            $select_country_query_1 .= " WHERE (note_country.country_name LIKE '%$search%' OR note_country.country_code LIKE '%$search%' OR note_country.created_date LIKE '%$search%' OR users.user_first_name LIKE '%$search%' OR users.user_last_name LIKE '%$search%')";
        }
        
        $select_country_query_1 .= " ORDER BY note_country.created_date DESC";
        $check_select_country_query_1 = query($select_country_query_1);
        confirmQuery($check_select_country_query_1);
        $total_countries = row_count($check_select_country_query_1);
        
        if(row_count($check_select_country_query_1) > 0){
            $select_country_query_2 = $select_country_query_1." LIMIT $offset, $limit";
            $check_select_country_query_2 = query($select_country_query_2);
            confirmQuery($check_select_country_query_2);
            
            $country_data_output .= "<table class='table table-hover' id='country-info-table'>
                        <thead>
                            <tr>
                                <th scope='col'>Sr no.</th>
                                <th scope='col'>Country Name</th>
                                <th scope='col'>Country Code</th>
                                <th scope='col'>Date Added</th>
                                <th scope='col'>Added By</th>
                                <th scope='col'>Active</th>
                                <th scope='col'>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
            $sr_no = ($limit*$page_no-($limit-1));
            $active = "Yes";
            while($row = fetch_array($check_select_country_query_2)){
                $country_id = $row['country_id'];
                $country_name = $row['country_name'];
                $country_code = $row['country_code'];
                $is_country_active = $row['is_active'];
                $country_date_added = $row['created_date'];
                $country_added_by_user = $row['user_first_name']." ".$row['user_last_name'];
                if ($is_country_active == 1){
                    $active = "Yes";
                }
                else{
                    $active = "No";
                }
                $date = new DateTime($country_date_added);

                $date = $date->format('d-m-Y, H:i');
                $country_data_output .= "<tr>
                        <td>{$sr_no}</td>
                        <td>{$country_name}</td>
                        <td>{$country_code}</td>
                        <td>{$date}</td>
                        <td>{$country_added_by_user}</td>
                        <td>{$active}</td>
                        <td>
                            <div class='action-img'>
                                <div class='edit-country'>
                                    <a href='Edit_Country.php?country_id=$country_id'><img src='images/Dashboard/edit.png' alt='Edit' class='img-risponsive'></a>
                                </div>
                                <div class='delete-country-action'>
                                    <a onclick='javascript: return confirm(\"Are you sure you want to make this country inactive?\");' href='include/delete_category.php?country_id=$country_id'><img src='images/Dashboard/delete.png' alt='Delete' class='img-risponsive'></a>
                                </div>
                            </div>
                        </td>
                    </tr>";

                $sr_no += 1;
            }
            $country_data_output .= "</tbody>
                    </table>";
            
            $totalPage = ceil($total_countries/$limit);
            
            $country_data_output .= "<section class='dash-pagination'>
        <nav aria-label='Page navigation'>
            <ul class='pagination justify-content-center' id='country_pagination'>
                <li class='page-item'>
                    <a class='page-link' id='country_page_prev' href='' aria-label='Previous'>
                        <span aria-hidden='true'><i class='fa fa-angle-left' aria-hidden='true'></i></span>
                    </a>
                </li>";

            for ($i=1; $i <= $totalPage ; $i++) { 
                if ($i == $page_no) {
                    $active = "active";
                }else{
                    $active = "";
                }
                $country_data_output .= "<li class='page-item'><a class='page-link $active' id='$i' href=''>$i</a></li>";
            }
            $country_data_output .= "<li class='page-item'>
                        <a class='page-link' id='country_page_next' href='' aria-label='Next'>
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
        
        echo $country_data_output;
    }

?>