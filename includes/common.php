<?php 
//The function below returns the sanitized the data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function returnHome($type) {
    if($type == "recruiter") {
        header("Location: recruiter-home.php");
        exit;
    }
    else if($type == "seeker") {
        header("Location: seeker-home.php");
        exit;
    }
    else if($type == "admin") {
        header("Location: admin-home.php");
        exit;
    }
}
