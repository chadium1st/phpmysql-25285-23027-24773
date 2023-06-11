<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBLICIOUS | My Jobs</title>
    <?php
        include "includes/metatags.php";
        include "includes/common.php";
        include "includes/config.php"
    ?>
</head>
<body>
    <?php
        include "includes/adminheader.php";
        // include "includes/recruiter-nav.php";

        $sql = "SELECT job_id, job_title, job_location, qualifications FROM jobposting";
        $result = mysqli_query($conn, $sql);
        
    ?>
    <h1>Your Jobs</h1>
    <div class="jobs-table-container">
        <table id="jobs-table">
            <tr>
                <th>
                    ID 
                </th>
                <th>
                    Title
                </th>
                <th>
                    Location
                </th>
                <th>
                    Qualifications
                </th>
                <th>
                    Delete
                </th>
            </tr>
            <?php
            if ($result) {
                if (mysqli_num_rows($result) > 0)
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                        <td><?php echo $row['job_id']?></td>
                        <td><?php echo $row['job_title']?></td>
                        <td><?php echo $row['job_location']?></td>
                        <td><?php echo $row['qualifications']?></td>
                        <td>
                            <button onclick="<?php include "includes/jobs_deleteaction.php"?>" class="delete-button">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php
                    }
            } else {
                header("includes/recruiter-home-main.php");
            }
        ?>
        </table>
    </div>
</body>
</html>