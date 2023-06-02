<?php

$host = "localhost";
$admin = "root";
$password = "";
$database = "jobs"; 

$conn = mysqli_connect($host, $admin, $password, $database);

if(!$conn){
    die("Database Connection Error: " . mysqli_connect_error());
}

else if($conn->connect_error) {
    trigger_error('Database connection failed: ' .$conn->connect_error, E_USER_ERROR);  
}

else {
    // get the tables from the database

    $query = "SHOW TABLES";
    $result = mysqli_query($conn, $query);

    // Prepare response array
    $response = array();

    if (mysqli_num_rows($result) > 0) {
        while($table = mysqli_fetch_row($result)) {
            $table_name = $table[0];
            $table_data = array();

            // selects all rows from the current table
            $query_table = "SELECT * FROM $table_name";
            $result_table = mysqli_query($conn, $query_table);

            if(mysqli_num_rows($result_table) > 0) {
                while($row = mysqli_fetch_assoc($result_table)) {
                    // add each row to table's array
                    $table_data[] = $row;
                }
            }

            // add everything to the response array object
            $response[$table_name] = $table_data;
        }
    }

    // Set the response header as JSON
    header('Content-Type: application/json');

    // Output the response as JSON string
    echo json_encode($response);
    $conn->close();
}
