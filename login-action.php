<?php
include "includes/common.php";
include "includes/config.php";
include "includes/common-login-register.php";
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    // Validate the email and password (you can add your own validation logic here)

    // Simulating user data retrieval from the database
    $user = getUserFromDatabase($email);

    if ($user !== null && password_verify($password, $user['user_password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_password'] = $user['user_password'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_ph_no'] = $user['user_ph_no'];
        $_SESSION['user_role'] = $user['user_role'];
        $_SESSION['loggedin'] = true;

        // Set email cookie
        setcookie('email', $user['user_email'], time() + (86400 * 30), '/');

        // Redirect to the welcome page or any other page you want
        header("Location: home.php");
        exit;
    }
    else if($user===null){
        $_SESSION['login_error'] = "Invalid Email";
        header("Location: login.php");
        exit;
    } 
    else if(!password_verify($password, $user['user_password'])){
        $_SESSION['login_error'] = "Invalid Password";
        header("Location: login.php");
        exit;
    }
    else {
        $_SESSION['login_error'] = "Invalid Email or Password";
        header("Location: login.php");
        exit;
    }
}

// Simulated function to retrieve user data from the database

?>