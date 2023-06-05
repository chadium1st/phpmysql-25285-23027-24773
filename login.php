<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <?php
        include "includes/metatags.php";
    ?>
</head>
<body>
    <div id="supercontainer">
    <div id="container">
        <h1>Login</h1>
        <?php
        // Check if there is a login error message
        if (isset($_SESSION['login_error'])) {
            echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
        <form action="login-action.php" method="POST">
            <label for="email">Email:</label>
            <input type="text" class="login-text"name="email" required>

            <label for="password">Password:</label>
            <input type="password" class="login-text" name="password" required>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account?
        <a href="register.php?type=recruiter" class="amper">Register</a> as a recruiter! </br>
        <a href="register.php?type=job_seeker">Register</a> as a Job Seeker!</p>
    </div>
    </div>
</body>
</html>
