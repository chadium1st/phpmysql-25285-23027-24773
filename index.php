<!DOCTYPE html>
<html>
<head>
    <title>First Page</title>
    <?php
        include "includes/metatags.php";
    ?>
</head>
<body id="first-page-body">
    <div id="first-page-container">
        <div  id="first-page-option">
            <a  class="amp" href="register.php?type=recruiter">
                <p>Register as Recruiter!</p>
            </a>
        </div>
        <div id="first-page-option">
            <a class="amp" href="register.php?type=job_seeker">
                <p>Register as Job Seeker</p>
            </a>
        </div>
        <div id="first-page-login">
            <p>If you already have an account <a class="amp" href="login.php">log in!</a></p>
        </div>
    </div>
</body>
</html>
