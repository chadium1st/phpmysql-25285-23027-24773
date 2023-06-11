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
            $_SESSION['$job_edit_id'] = $_POST['job_id'];
            $_SESSION['$job_recruiter_id']  = $_POST['recruiter_id'];
            $_SESSION['$job_recruiter_name']  = $_POST['recruiter_name'];
            $_SESSION['$job_title']  = $_POST['job_title'];
            $_SESSION['$job_description']  = $_POST['job_description'];
            $_SESSION['$job_qualifications']  = $_POST['job_qualifications'];
            $_SESSION['$job_location']  = $_POST['job_location'];
        }
            $job_id = $_SESSION['$job_edit_id'] ;
            $recruiter_id = $_SESSION['$job_recruiter_id'] ;
            $recruiter_name = $_SESSION['$job_recruiter_name'] ;
            $job_title =   $_SESSION['$job_title'];
            $job_description = $_SESSION['$job_description'];
            $job_qualifications = $_SESSION['$job_qualifications'];
            $job_location=$_SESSION['$job_location'];
  ?>
  <?php
        // Check if email already exists
        if (isset($_SESSION['update_error'])) {
            echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
            unset($_SESSION['update_error']);
        }
    ?>
   <main id="register-container">
<form action="includes/jobs_editaction.php" method="POST">
     <input type="number" name="job_id" class="register-class" hidden value="<?php echo $job_id; ?>"><br><br>

     <label class="registerlabel" for="recruiter_id">Recruiter ID:</label>
     <input type="text" class="register-class" name="recruiter_id" readonly required value="<?php echo $recruiter_id;?>"><br><br>

     <label class="registerlabel" for="recruiter_name">Recruiter Name:</label>
     <input type="text" class="register-class" name="recruiter_name" readonly required value="<?php echo $recruiter_name;?>"><br><br>
     
     <label class="registerlabel" for="job_title">Job Title:</label>
     <input type="text" class="register-class" name="job_title" required placeholder="e.g looking for ML Engineer" value="<?php echo $job_title;?>"><br><br>

     <label class="registerlabel" for="job_description">Job Description:</label>
     <textarea class="register-class" name="job_description" rows="5" cols="50" placeholder="Write description here!"><?php echo $job_description;?></textarea>
    
     <label class="registerlabel" for="job_qualifications">Qualifications Required:</label>
     <input type="text" name="job_qualifications" class="register-class"  required placeholder="Write Qualifications here!" value="<?php echo $job_qualifications;?>"><br><br>
     
     <label class="registerlabel" for="job_location">Location:</label>
     <input type="text" name="job_location" class="register-class"  required placeholder="Write Job Location here!" value="<?php echo $job_location;?>"><br><br>
     
     <input type="submit" value="Update" id="submitButton">
</form>
</main>
  
  <?php
    include "includes/aside.php";
  ?>
  <?php
    include "includes/footer.php";
  ?>
</body>
</html>