<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/meta-tags.php"; ?>
    <?php include "includes/config.php"; ?>
</head>
<body>
    <div>
        <h1>Job</h1>
        <?php
        $job_query = "SELECT * FROM jobposting";
        $result_job = $conn->query($job_query);

        if ($result_job->num_rows > 0) {
            while ($row = $result_job->fetch_assoc()) {
                $jobTitle = $row["job_title"];
                $description = $row["job_description"];
                $qualification = $row["job_qualification"];
                $location = $row["job_location"];

                echo "<div class='job-posting' onclick='toggleDescription(this)'>";
                echo "<div class='job-title'>" . $jobTitle . "</div>";
                echo "<div class='job-description'>" . $description . "</div>";
                echo "<div class='job-qualification'>" . $qualification . "</div>";
                echo "<div class='job-location'>" . $location . "</div>";
                echo "</div>";
            }
        } else {
            echo "No records found.";
        }
        ?>
    </div>
</body>
</html>