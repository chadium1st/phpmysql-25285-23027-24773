<?php
include "config.php";
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
    header("Location: ../index.php");
    exit;
  }
$query = "SELECT r.reportId, r.userId, r.report_txt, u.user_id, u.user_name, u.user_role 
          FROM report r
          JOIN user u ON r.userId = u.user_id";

$stmt = $conn->prepare($query);
$stmt->execute();
$result=$stmt->get_result();
$reports = $result->fetch_all(MYSQLI_ASSOC);

echo '<table class="user-table">';
        echo '<tr><th>REPORT ID</th><th>USER ID</th><th>REPORT TEXT</th><th>ACTIONS</th></tr>';
        foreach ($reports as $report) {
            echo '<tr>';
            echo '<td>' . $report['reportId'] . '</td>';
            echo '<td>' . $report['userId'] . '</td>';
            echo '<td>' . $report['report_txt'] . '</td>';
            //echo '<td rowspan="2">' . $job['job_description'] . '</td>';
            echo '<td class="user-actions">';
            echo '<form class="edit-form" action="reports_edit.php" method="POST">';
            echo '<input type="hidden" name="report_id" value="' . $report['reportId']  . '">';
            echo '<input type="hidden" name="user_id" value="' . $report['userId'] . '">';
            echo '<input type="hidden" name="report_txt" value="' . $report['report_txt'] . '">';
            echo '<input type="hidden" name="user_name" value="' . $report['user_name'] . '">';
            echo '<input type="hidden" name="user_role" value="' . $report['user_role'] . '">';
            echo '<button type="submit" class="edit-button">View Details</button>';
            echo '</form>';        
            echo '</td>';
            echo '</tr>';
            //echo '<tr></tr>';
        }
        echo '</table>';
?>
