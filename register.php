<?php
session_start();
include "includes/common.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['type'])) {
        $type = sanitizeInput($_GET['type']);
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
if(!($type==='recruiter'||$type=='job_seeker')) {header("Location: index.php");exit;}//sets the by default type to job_seeker
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body id="register-body">
    <h1 id="register-h1">Registration Page</h1>
    <?php
        // Check if email already exists
        if (isset($_SESSION['register_error'])) {
            echo '<p id="register-error">' . $_SESSION['register_error'] . '</p>';
            unset($_SESSION['register_error']);
        }
        // else {echo " Register error not set ";}
    ?>
    <div id="register-container">
   <form action="register-action.php" method="POST" id="registrationForm">
        <label class="registerlabel" for="username">Username:</label>
        <input type="text" class="register-class" name="username" required pattern="[A-Za-z0-9\s]+" title="Only alphanumeric characters and spaces are allowed" placeholder="e.g Nick Jonas"><br><br>

        <label class="registerlabel" for="password">Password:</label>
        <input type="password" class="register-class" name="password" required><br><br>

        <label class="registerlabel" for="email">Email:</label>
        <input type="email" name="email" class="register-class" id="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" required placeholder="e.g Nick@yahoo.com"><br><br>

        <label class="registerlabel"for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" class="register-class" required pattern="[0-9]+" title="Only numeric characters are allowed" placeholder="e.g 923300022"><br><br>

        <input type="text" name="role" hidden value="<?php echo $type; ?>"><br><br>

        <input type="submit" value="Register" id="submitButton">
    </form>
    <p>Already have an account? <a href=login.php>Log in</a> here!</p>
    </div>
</body>
</html>
