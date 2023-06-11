<?php 
session_start();

$active=null;
//The function below returns the sanitized the data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$user_id = null;
$user_name = null;
$user_email = null;
$user_ph = null;
$user_role = null;
