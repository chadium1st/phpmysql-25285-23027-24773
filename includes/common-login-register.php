<?php
function getUserFromDatabase($email) {
    global $conn;
    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT user_id, user_name, user_password, user_email, user_ph_no, user_role FROM user WHERE user_email = ?");
    // Bind the email parameter to the prepared statement
    $stmt->bind_param("s", $email);
    // Execute the query
    $stmt->execute();
    // Get the result set
    $result = $stmt->get_result();
    // Check if a row was returned
    if ($result->num_rows > 0) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();
        // Return the user data
        return $row;
    }
    return null;
}