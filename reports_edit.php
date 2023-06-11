<?php
include "includes/common.php";
$active="myprofile";
// Check if the user is not logged in
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
  <script>
    const searchButton = document.querySelector('.search button');
    const searchIcon = document.querySelector('.search button i img');
    const searchIconHover = document.createElement('div');
    searchIconHover.classList.add('search-icon-hover');

    searchButton.appendChild(searchIconHover);

    searchButton.addEventListener('mouseover', () => {
      searchIcon.style.display = 'none';
      searchIconHover.style.display = 'inline-block'; 
    });

    searchButton.addEventListener('mouseout', () => {
      searchIcon.style.display = 'inline-block';
      searchIconHover.style.display = 'none';
    });
  
    function toggleSidebar() {
      var sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('open');
  
      var button = document.querySelector('.toggle-btn');
      button.classList.toggle('active');
    }
  </script>
  <?php
   
        include "includes/adminheader.php";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['report_id'] = $_POST['report_id'];
            $_SESSION['report_user_id']  = $_POST['user_id'];
            $_SESSION['report_txt']  = $_POST['report_txt'];
            $_SESSION['report_user_name']  = $_POST['user_name'];
            $_SESSION['report_user_role']  = $_POST['user_role'];

            $report_id = $_SESSION['report_id'] ;
            $user_id = $_SESSION['report_user_id'] ;
            $report_txt = $_SESSION['report_txt'] ;
            $user_name =   $_SESSION['report_user_name'];
            $user_role = $_SESSION['report_user_role'];

            echo '<main id="register-container">';
            echo '<form action="report_deleteaction.php" method="POST">';
            echo '<label class="registerlabel" for="report_id">Report ID:</label>';
            echo '<input type="text" class="register-class" name="report_id" readonly required value="' . $report_id . '"><br><br>';

            echo '<label class="registerlabel" for="user_id">User ID:</label>';
            echo '<input type="text" class="register-class" name="user_id" readonly required value="' . $user_id . '"><br><br>';

            echo '<label class="registerlabel" for="user_name">User Name:</label>';
            echo '<input type="text" class="register-class" name="user_name" readonly required placeholder="e.g looking for ML Engineer" value="' . $user_name . '"><br><br>';

            echo '<label class="registerlabel" for="report_txt">Report Description:</label>';
            echo '<textarea class="register-class" name="report_txt" rows="5" cols="50" readonly placeholder="Write description here!">' .$report_txt. '</textarea>';

            echo '<label class="registerlabel" for="user_role">User Role:</label>';
            echo '<input type="text" name="user_role" class="register-class" required readonly placeholder="Write Qualifications here!" value="' . $user_role . '"><br><br>';

            echo '<input type="submit" value="Terminate" id="submitButton">';
            echo '</form>';
            echo '</main>';
        }
           
  ?>
  <?php
        if (isset($_SESSION['update_error'])) {
            echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
            unset($_SESSION['update_error']);
        }
    ?>

  
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>
</body>
</html>