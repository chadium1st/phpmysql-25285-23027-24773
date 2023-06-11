<?php
include "common.php";

if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
    header("Location: ../index.php");
    exit;
  }
function checkOtherUser($email) {
    global $conn;

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT user_id, user_name, user_password, user_email, user_ph_no, user_role FROM user WHERE user_email = ? and user_id!=?");

    // Bind the email parameter to the prepared statement
    $stmt->bind_param("si", $email,$userid);

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
    $userid=$_POST['id'];
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $phonenumber = sanitizeInput($_POST['phonenumber']);
    $newPassword = $_POST['newpassword'];
    // Hash the password
    $user_password= password_hash($newPassword, PASSWORD_DEFAULT);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['update_error'] = "Invalid email format!";
        header("Location: ../users_edit.php");
        exit;
    } elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9\s]*$/", $username)) {
        $_SESSION['update_error'] = "Invalid username format!";
        header("Location: ../users_edit.php");
        exit;
    } elseif (!preg_match("/^\d{10,}$/", $phonenumber)) {
        $_SESSION['update_error'] = "Invalid phone number format(Must be 10 digits or greater)!";

        header("Location: ../users_edit.php");
        exit;
    } elseif(checkOtherUser($email)){
        $_SESSION['update_error'] = "User with this email already exists!";
        header("Location: ../users_edit.php");
        exit;
    }
    else{
        // Update the user information in the User table
        if($user_password!==""){
            $sql = "UPDATE User
            SET user_name = ?, user_password = ?, user_email = ?, user_ph_no = ?
            WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssdi", $username, $user_password, $email, $phonenumber, $userid);
        }
        else{
            $sql = "UPDATE User
            SET user_name = ? user_email = ?, user_ph_no = ?
            WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdi", $username, $email, $phonenumber, $userid);
        }
        if ($stmt->execute()) {
        $_SESSION['update_error'] = "Profile Updated Successfully!";
        header("Location: ../users_edit.php");
        exit;
        } else {
        // Update failed
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
}
?>