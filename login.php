<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
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
            <input type="text" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account?
        <a href="register.php?type=recruiter">Register</a> as a recruiter! </br>
        <a href="register.php?type=seeker">Register</a> as a Job Seeker!</p>
    </div>
</body>
</html>
