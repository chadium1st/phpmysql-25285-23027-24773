<?php
include "includes/common.php";
include "includes/config.php";
//session_destroy();
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>JobLicious</title>
  <?php
    include "includes/metatags.php";
  ?>
</head>
<body>


  <?php   
  $searchtxt=null;   
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the form data
            $searchtxt =$_POST['searchtxt'];
            $_SESSION['searchtext']=$_POST['searchtxt'];
        }
        include "includes/adminheader.php";
  ?>

  <main>
    <div id="search_buttons_container">
    <form action="search-result.php" method="POST">
        <input type="text" name="searchtxt" hidden value="<?php echo $searchtxt; ?>">
        <input type="text" name="search_button_value" hidden value="USER">
        <button type="submit" class="edit-button">USERS</button>
    </form>
    <form action="search-result.php" method="POST">
        <input type="text" name="searchtxt" hidden value=<?php echo$searchtxt; ?>>
        <input type="text" name="search_button_value" hidden value="JOBS">
        <button type="submit" class="edit-button">JOBS</button>
    </form>
    <form action="search-result.php" method="POST">
        <input type="text" name="searchtxt" hidden value=<?php echo$searchtxt; ?>>
        <input type="text" name="search_button_value" hidden value="REPORT">
        <button type="submit" class="edit-button">REPORTS</button>
    </form>
    </div>
    <h2 class="table-heading">
        <?php if(isset($_POST['search_button_value'])) {echo $_POST['search_button_value'];};?>
    </h2>
    
    <?php
        if($_POST['search_button_value']==="USER"){
              $query = "SELECT user_id, user_name, user_email, user_ph_no, user_role FROM user 
              WHERE (user_name LIKE CONCAT('%', ?, '%') OR user_email LIKE CONCAT('%', ?, '%')) AND user_id != ?";


            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi",$searchtxt,$searchtxt,$_SESSION['user_id']); 
            $stmt->execute();
            $result=$stmt->get_result();
            $users = $result->fetch_all(MYSQLI_ASSOC);

            echo '<table class="user-table">';
            echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>User Role</th><th>Actions</th></tr>';
            foreach ($users as $user) {
                echo '<tr>';
                echo '<td id="user-id">' . $user['user_id'] . '</td>';
                echo '<td id="user-name">' . $user['user_name'] . '</td>';
                echo '<td id="user-email">' . $user['user_email'] . '</td>';
                echo '<td id="user-phone">' . $user['user_ph_no'] . '</td>';
                echo '<td id="user-role">' . $user['user_role'] . '</td>';
                echo '<td class="user-actions">';
                echo '<form action="users_edit.php" method="POST" class="edit-form">';
                echo '<input type="hidden" name="id" value="' . $user['user_id'] . '">';
                echo '<input type="hidden" name="name" value="' . $user['user_name'] . '">';
                echo '<input type="hidden" name="email" value="' . $user['user_email'] . '">';
                echo '<input type="hidden" name="role" value="' . $user['user_role'] . '">';
                echo '<input type="hidden" name="phone" value="' . $user['user_ph_no'] . '">';
                echo '<button type="submit" class="edit-button">Edit</button>';
                echo '</form>';        
                echo '<form action="users_deleteaction.php" method="POST" class="delete-form">';
                echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
                echo '<button type="submit" class="delete-button">Delete</button>';
                echo '</form>'; 
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
        elseif($_POST['search_button_value']==="JOBS"){
            $query = "SELECT j.job_id, j.recruiter_id, j.job_title, j.job_description, j.qualifications, j.job_location, u.user_name AS recruiter_name 
            FROM jobposting j
            JOIN user u ON j.recruiter_id = u.user_id
            WHERE (j.job_title LIKE CONCAT('%', ?, '%') OR j.job_description LIKE CONCAT('%', ?, '%'))";
            
              $stmt = $conn->prepare($query);
              $stmt->bind_param("ss",$searchtxt,$searchtxt); 
              $stmt->execute();
              $result=$stmt->get_result();
              $jobs = $result->fetch_all(MYSQLI_ASSOC);
                    
            echo '<table class="user-table">';
            echo '<tr><th>JOB ID</th><th>RECRUITER ID</th><th>JOB TITLE</th><th>QUALIFICATIONS</th><th>JOB LOCATION</th><th>ACTIONS</th></tr>';
            foreach ($jobs as $job) {
                echo '<tr>';
                echo '<td>' . $job['job_id'] . '</td>';
                echo '<td>' . $job['recruiter_id'] . '</td>';
                echo '<td>' . $job['job_title'] . '</td>';
                //echo '<td rowspan="2">' . $job['job_description'] . '</td>';
                echo '<td>' . $job['qualifications'] . '</td>';
                echo '<td>' . $job['job_location'] . '</td>';
                echo '<td class="user-actions">';
                echo '<form  class="edit-form" action="jobs_edit.php" method="POST">';
                echo '<input type="hidden" name="job_id" value="' . $job['job_id']  . '">';
                echo '<input type="hidden" name="recruiter_id" value="' . $job['recruiter_id'] . '">';
                echo '<input type="hidden" name="recruiter_name" value="' . $job['recruiter_name'] . '">';
                echo '<input type="hidden" name="job_title" value="' . $job['job_title'] . '">';
                echo '<input type="hidden" name="job_description" value="' . $job['job_description'] . '">';
                echo '<input type="hidden" name="job_qualifications" value="' . $job['qualifications'] . '">';
                echo '<input type="hidden" name="job_location" value="' . $job['job_location'] . '">';
                echo '<button type="submit" class="edit-button">Edit</button>';
                echo '</form>';        
                echo '<form class="delete-form" action="jobs_deleteaction.php" method="POST">';
                echo '<input type="hidden" name="job_id" value="' . $job['job_id']  . '">';
                echo '<button type="submit" class="delete-button">Delete</button>';
                echo '</td>';
                echo '</tr>';
                //echo '<tr></tr>';
            }
            echo '</table>';
            }
            elseif($_POST['search_button_value']==="REPORT"){

                $query = "SELECT r.reportId, r.userId, r.report_txt, u.user_id, u.user_name, u.user_role 
                FROM report r
                JOIN user u ON r.userId = u.user_id
                WHERE r.report_txt LIKE CONCAT('%', ?, '%')";
      

$stmt = $conn->prepare($query);
$stmt->bind_param("s",$searchtxt); 

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
            }
    ?>
  </main>
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>
  <script src="javascript/javascript.js"></script>

</body>
</html>