<?php
include "common.php";
// Check if the user is already logged in

if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']===false)) {
    header("Location: ../home.php");
    exit;
}

// Include the database connection file
include "config.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data

    $job_id = $_POST['job_id'] ;
    $recruiter_id = $_POST['recruiter_id'] ;
    $job_title =   sanitizeInput($_POST['job_title']);
    $job_description = sanitizeInput($_POST['job_description']);
    $job_qualifications = sanitizeInput($_POST['job_qualifications']);
    $job_location= sanitizeInput($_POST["job_location"]);

    $sql = "UPDATE jobposting
    SET job_title = ?, job_description = ?, qualifications = ?, job_location = ?
    WHERE job_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $job_title, $job_description, $job_qualifications, $job_location, $job_id);
        if ($stmt->execute()) {
        $_SESSION['update_error'] = "Job Updated Successfully!";
        $_SESSION['$job_edit_id'] =  $job_id;
        $_SESSION['$job_recruiter_id']  = $recruiter_id;
        $_SESSION['$job_title']  = $job_title;
        $_SESSION['$job_description']  = $job_description;
        $_SESSION['$job_qualifications']  = $job_qualifications;
        $_SESSION['$job_location']  = $job_location;
        header("Location: ../jobs_edit.php");
        exit;
        } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
?>