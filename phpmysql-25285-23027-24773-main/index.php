<?php
include "includes/common.php";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>First Page</title>
</head>
<body>
    <p>Register as <a href="register.php?type=recruiter">Recruiter</a>!</p> or <p>Register as <a href="register.php?type=seeker">Job Seeker</a></p>
    <p>If you already have an account <a href="login.php">log in</a></p>

    <?php include "includes/footer.php" ?>
</body>
</html>
