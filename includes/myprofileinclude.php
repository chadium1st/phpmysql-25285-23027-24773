<?php
if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin']===false)) {
  header("Location: ../index.php");
  exit;
}
include "config.php";
// session_destroy();
$user_id=$_SESSION['user_id'];
$user_name=$_SESSION['user_name'] ;
$user_password=$_SESSION['user_password'] ;
$user_email=$_SESSION['user_email'] ;
$user_ph=$_SESSION['user_ph_no']  ;
$user_role=$_SESSION['user_role'] ;
$user_login=$_SESSION['loggedin'] ;
?>

    <?php
        // Check if email already exists
        if (isset($_SESSION['update_error'])) {
            echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
            unset($_SESSION['update_error']);
        }
    ?>
    <main id="register-container">
   <form action="includes/myupdateProfile-action.php" method="POST" id="registrationForm">
        <label class="registerlabel" for="username">Username:</label>
        <input type="text" class="register-class" name="username" required pattern="[A-Za-z0-9\s]+" title="Only alphanumeric characters and spaces are allowed" placeholder="e.g Nick Jones" value="<?php echo $user_name;?>"><br><br>

        <label class="registerlabel" for="oldpassword">Old Password:</label>
        <input type="password" class="register-class" name="oldpassword" required><br><br>

        <label class="registerlabel" for="newpassword">New Password:</label>
        <input type="password" class="register-class" name="newpassword" required><br><br>

        <label class="registerlabel" for="newpassword2">Verify New Password:</label>
        <input type="password" class="register-class" name="newpassword2" required><br><br>

        <label class="registerlabel" for="email">Email:</label>
        <input type="email" name="email" class="register-class" id="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" required placeholder="e.g Nick@yahoo.com" value="<?php echo $user_email;?>"><br><br>
        <label class="registerlabel"for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" class="register-class" required pattern="[0-9]+" title="Only numeric characters are allowed" placeholder="e.g 923300022" value="<?php echo $user_ph; ?>"><br><br>

        <input type="submit" value="Update" id="submitButton">
    </form>
    </main>
