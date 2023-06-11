<?php
include "includes/common.php";
$active="myprofile";
// Check if the user is not logged in
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
        include "includes/myprofileinclude.php";
      }
      else if ($_SESSION['user_role'] === 'recruiter' || $_SESSION['user_role'] === 'Recruiter') {
        include "includes/adminheader.php";
        include "includes/myprofileinclude.php";
      } 
      else {
        include "includes/header.php";
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