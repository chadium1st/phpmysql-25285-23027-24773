<?php
session_start();

// Check if the user is already logged in
// if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

//     // Redirecting to relevant homepage depending on type of user
//     if($type == "recruiter") {
//         header("Location: recruiter-home.php");
//         exit;
//     }
//     else if($type == "seeker") {
//         header("Location: seeker-home.php");
//         exit;
//     }
//     else if($type == "admin") {
//         header("Location: admin-home.php");
//         exit;
//     }

// }

// Include the database connection file
include "includes/config.php";
include "includes/common-login-register.php";
include "includes/common.php";


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = sanitizeInput($_POST['username']);
    $password = password_hash(sanitizeInput($_POST['password']), PASSWORD_DEFAULT);
    $email = sanitizeInput($_POST['email']);
    $phonenumber = sanitizeInput($_POST['phonenumber']);
    $role = sanitizeInput($_POST['role']);
    $user=getUserFromDatabase($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $_SESSION['register_error'] = "Invalid email format!";
        header("Location: register.php?type=" . urlencode($role));
        exit;
    } 
    else if (!preg_match("/^[a-zA-Z][a-zA-Z0-9\s]*$/", $username)) {
        $_SESSION['register_error'] = "Invalid username format!";
        header("Location: register.php?type=" . urlencode($role));
        exit;
    } 
    else if (!preg_match("/^\d{10,}$/", $phonenumber)) {
        $_SESSION['register_error'] = "Invalid phone number format(Must be 10 digits or greater)!";
        header("Location: register.php?type=" . urlencode($role));
        exit;

    } 
    else if($user!==null) {

        $_SESSION['register_error'] = "User with this email already exists!";
        header("Location: register.php?type=" . urlencode($role));
        exit;
    }
    else {
        // Insert the user information into the User table
        $sql = "INSERT INTO User (user_name, user_password, user_email, user_ph_no, user_role)

        VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $username, $password, $email, $phonenumber, $role);

        if ($stmt->execute()) {
            $_SESSION['register_error'] = "Registration Successful!";
            header("Location: register.php?type=" . urlencode($role));
            // header("Location:".urlencode($role)."-home.php");
            exit;
        } else {
            // Registration failed
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>