<?php 
//The function below returns the sanitized the data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function returnHome($type) {
    if(isset($_SESSION["user_role"])) {
        if($type == "recruiter") {
            header("Location: includes/recruiter-home.php");
            exit;
        }
        else if($type == "seeker") {
            header("Location: includes/seeker-home.php");
            exit;
        }
        else if($type == "admin") {
            header("Location: includes/admin-home.php");
            exit;
        } else exit;
    }
}

function returnName() {
    if(isset($_SESSION["user_name"])) {
        return $_SESSION["user_name"];
    } else echo "Not logged in.";
}

function returnType() {
    if(isset($_SESSION["user_role"])) {
        if($_SESSION["user_role"] == 'admin') {
            return "admin";
        }
        else if($_SESSION["user_role"] == 'recruiter') {
            return "recruiter";
        }
        else if($_SESSION["user_role"] == 'seeker') {
            return "seeker";
        }
    }
}
