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

    $report_id = $_POST['report_id'] ;
   

    $sql = "DELETE FROM report
    WHERE reportId = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $report_id);
        if ($stmt->execute()) {
        $_SESSION['update_error'] = "Terminated Successfully!";
        header("Location: reports_edit.php");
        exit;
        } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
?>