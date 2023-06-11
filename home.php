<?php
  include "includes/common.php";
  $active="home";
  //session_destroy();
  if (!isset($_SESSION['loggedin'])) {
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

  if ($_SESSION['user_role'] === 'admin') {
    include "includes/adminheader.php";
    include "includes/adminhomemain.php";
    include "includes/footer.php";
  } 
  // database issue, accounts that were created before this issue got fixed have recruiter's user typesaved with a capital 'R'.
  else if ($_SESSION['user_role'] === "Recruiter" || $_SESSION['user_role'] === "recruiter") {    
    include "includes/adminheader.php";
    include "includes/recruiter-home-main.php"; 
    include "includes/footer.php";
  }
  else {
    print("{$_SESSION["user_role"]}");
    include "includes/header.php";
  }
  ?>
  
  <?php
    include "includes/aside.php";
  ?>

  <!-- <script src="javascript/javascript.js"></script> -->

</body>
</html>