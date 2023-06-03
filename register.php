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
    <style>
     body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Registration Page</h1>

    <?php
        // Check if email already exists
        if (isset($_SESSION['register_error'])) {
            echo '<p style="color: red;">' . $_SESSION['register_error'] . '</p>';
            unset($_SESSION['register_error']);
        }
        else {echo " Register error not set ";}
    ?>
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
