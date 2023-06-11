<?php if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true))) {
  header("Location: ../index.php");
  exit;
} ?>
<aside class="sidebar">
    <div id="sidebarLogocontainer">
      <p><b>JOB LICIOUS</b></p><a href="#">
      <img id="logoImg" src="graphic/logo.png" alt="Logo"></a>
    </div>
    <?php
    // Check if the user is not logged in
    if (!isset($_SESSION['loggedin'])) {
      header("Location: ../index.php");
      exit;
    }

    // Check the user's role and include the corresponding navigation file
    if ($_SESSION['user_role'] === 'admin') {
      include "includes/adminnavigation.php";
    } elseif ($_SESSION['user_role'] === 'recruiter' || $_SESSION['user_role'] === 'Recruiter') {
      include "includes/recruiter-nav.php";
    } elseif ($_SESSION['user_role'] === 'job_seeker') {
      //include "includes/jobseekernavigation.php";
    } else {
      // Handle cases where the user's role is not recognized
      //include "includes/navigation.php";
    }
    ?>

</aside>