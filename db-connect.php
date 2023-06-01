<?php

$host = "localhost";
$admin = "root";
$password = "";
$database = "houses";

$conn = mysqli_connect($host, $admin, $password, $database);

if(!$conn){
    die("Database Connection Error: " . mysqli_connect_error());
}
else {
    $query = "SELECT * from house;";
    $result = mysqli_query($conn, $query);

    // Prepare response array
    $response = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the response array
            $response[] = $row;
        }
    }

    // Set the response header as JSON
    header('Content-Type: application/json');

    // Output the response as JSON string
    echo json_encode($response);

}
