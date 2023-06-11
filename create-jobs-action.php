<?php
include "includes/common.php";

// Check if the user is already logged in
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include "includes/config.php";
include "includes/common-login-register.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_title = sanitizeInput($_POST["job_title"]);
    $job_description = sanitizeInput($_POST["job_description"]);
    $job_location = sanitizeInput($_POST["job_location"]);
    $qualifications = sanitizeInput($_POST["qualifications"]);
}
$recruiter_id = $_SESSION['user_id'];
// Insert the user information into the User table
$sql = "INSERT INTO jobposting (job_title, job_description, job_location, qualifications, recruiter_id)
VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssds", $job_title, $job_description, $job_location, $qualifications, $recruiter_id);

if($stmt->execute()) 
    ?> <h1>Your job has been listed!</h1>
<?php
    header("Location: home.php");
    exit;
?>
