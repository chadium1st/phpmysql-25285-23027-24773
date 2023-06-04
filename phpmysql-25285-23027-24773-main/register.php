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
if(!($type==='recruiter'||$type=='seeker')) {
    header("Location: index.php");
    exit;
} //sets the by default type to job_seeker

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Registration Page</h1>

    <p class = "checkEmail">
    <?php
        // Check if email already exists
        if (isset($_SESSION['register_error'])) {
            echo $_SESSION['register_error'];
            unset($_SESSION['register_error']);
        }
        else {echo " Register error not set ";}
    ?>
    </p>

   <form action="register-action.php" method="POST" id="registrationForm">

        <label for="username">Username:</label>
        <input type="text" name="username" required pattern="[A-Za-z0-9\s]+" title="Only alphanumeric characters and spaces are allowed" placeholder="e.g Nick Jonas"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" required placeholder="e.g Nick@yahoo.com"><br><br>

        <label for="phonenumber">Phone Number:</label>
        <input type="text" name="phonenumber" required pattern="[0-9]+" title="Only numeric characters are allowed" placeholder="e.g 923300022"><br><br>

        <input type="text" name="role" hidden value="<?php echo $type; ?>"><br><br>

        <input type="submit" value="Register" id="submitButton">

    </form>

    <p>Already have an account? <a href=login.php>Log in</a> here!</p>


</body>
</html>
