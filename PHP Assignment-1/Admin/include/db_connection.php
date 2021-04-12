<?php
    ob_start();

    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "notesmarketplace";

    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }

    $connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
    if(!$connection){
        echo ("QUERY FAILED " . mysqli_connect_error($connection));
    }

    function confirmQuery($result) {
    
        global $connection;
        
        if(!$result ) {
            die("QUERY FAILED. " . mysqli_error($connection));
          }
    }
    
    function query($query){
        global $connection;
        
        return mysqli_query($connection, $query);
    }
    
    function escape($string){
        global $connection;
        
        return mysqli_real_escape_string($connection, $string);
        
    }

    function fetch_array($result){
        global $connection;
        
        return mysqli_fetch_array($result);
    }
    
    function row_count($result){
        return mysqli_num_rows($result);
    }
    function last_inserted_id() {
        global $connection;
        return mysqli_insert_id($connection);
    }

?>