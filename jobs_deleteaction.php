<?php
include "includes/common.php";
// Check if the user is already logged in

if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
    header("Location: home.php");
    exit;
  }
// Include the database connection file
include "includes/config.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data

    $job_id = $_POST['job_id'] ;
   

    $sql = "DELETE FROM jobposting
    WHERE job_id = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $job_id);
        if ($stmt->execute()) {
        header("Location: jobs.php");
        exit;
        } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
?>