<?php
include "common.php";
// Check if the user is already logged in

if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']===false)) {
    header("Location: ../home.php");
    exit;
}
function checkOtherUser($email) {
    global $conn;

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT user_id, user_name, user_password, user_email, user_ph_no, user_role FROM user WHERE user_email = ? and user_id!=?");

    // Bind the email parameter to the prepared statement
    $stmt->bind_param("si", $email,$_SESSION['user_id']);

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if rows were returned
    if ($result->num_rows > 0) {
        // At least one row exists
        return true;
    }

    // No rows returned
    return false;
}
// Include the database connection file
include "config.php";

include "myupdataprofilequery.php";
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = sanitizeInput($_POST['username']);
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $newpassword2 = $_POST['newpassword2'];
    $email = sanitizeInput($_POST['email']);
    $phonenumber = sanitizeInput($_POST['phonenumber']);
    $user_password=null;
    if(password_verify($oldpassword, $_SESSION['user_password'])){
        if($newpassword===$newpassword2){
            $user_password=password_hash($newpassword, PASSWORD_DEFAULT);
        }
        else{
            $_SESSION['update_error'] = "New passwords are not matching!";
            header("Location: ../myprofile.php");
            exit;
        }
    }
    else{
        $_SESSION['update_error'] = "Old password is incorrect!";
        header("Location: ../myprofile.php");
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['update_error'] = "Invalid email format!";
        header("Location: ../myprofile.php");
        exit;
    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9\s]*$/", $username)) {
        $_SESSION['update_error'] = "Invalid username format!";
        header("Location: ../myprofile.php");
        exit;
    } elseif (!preg_match("/^\d{10,}$/", $phonenumber)) {
        $_SESSION['update_error'] = "Invalid phone number format(Must be 10 digits or greater)!";
        header("Location: ../myprofile.php");
        exit;
    } elseif(checkOtherUser($email)){
        $_SESSION['update_error'] = "User with this email already exists!";
        header("Location: ../myprofile.php");
        exit;
    }
    else{
        // Update the user information in the User table
        $sql = "UPDATE User
        SET user_name = ?, user_password = ?, user_email = ?, user_ph_no = ?
        WHERE user_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdi", $username, $user_password, $email, $phonenumber, $_SESSION['user_id']);
            
        if ($stmt->execute()) {
        $_SESSION['update_error'] = "Profile Updated Successfully!";
        $_SESSION['user_name'] = $username;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_ph_no'] = $phonenumber;
        $_SESSION['update_error'] = "Updated!";
        header("Location: ../myprofile.php");
        exit;
        } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
}
?>