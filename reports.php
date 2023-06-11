<?php
include "includes/common.php";
$active="jobs";
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
        include "includes/adminheader.php";
  ?>
  <main>
    <h2 class="table-heading">
        REPORTS
    </h2>
    <?php 
        include "includes/reportstable.php";
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