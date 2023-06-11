<?php
    include "includes/common.php";  
    if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'recruiter' || $_SESSION['user_role'] !== 'Recruiter')) {
        header("Location: ../index.php");
        exit;
    }
    
    include "includes/aside.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBLICIOUS | Create a Job Offer</title>
    <?php
        include "includes/metatags.php";
    ?>
</head>
<body>
    <?php
        include "includes/adminheader.php";
    ?>
    <h1>
        Create a Job!   
    </h1>
    <div id="register-container">
        <form action="create-jobs-action.php" method="POST" id="new-job-form">
            <!-- <label class="registerlabel" for="recruiter_id">Recruiter ID:</label>
            <input type="text" class="register-class" name="recruiter_id" required pattern="[0-9]" required><br><br> -->

            <label class="registerlabel" for="job_title">Job Title:</label>
            <input type="text" class="register-class" name="job_title" placeholder="e.g Web Development" required><br><br>

            <label class="registerlabel" for="qualifications">Job Requirements/Qualifications:</label>
            <input type="text" class="register-class" name="qualifications" required><br><br>

            <label class="registerlabel" for="job_location">Location:</label>
            <input type="text" name="job_location" class="register-class" required placeholder="e.g Islamabad"><br><br>

            <label class="registerlabel"for="job_description">Description:</label>
            <textarea type="text" name="job_description" class="register-class" placeholder="add details regarding the job."></textarea>    

            <input type="submit" value="Create Job" id="submitButton">
        </form>
    </div>

    <?php
        include "includes/footer.php";
    ?>
</body>
</html>