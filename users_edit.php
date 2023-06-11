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
            $_SESSION['$user_edit_id'] = $_POST['id'];
            $_SESSION['$user_edit_name']  = $_POST['name'];
            $_SESSION['$user_edit_email']  = $_POST['email'];
            $_SESSION['$user_edit_phone']  = $_POST['phone'];
            $_SESSION['$user_edit_role']  = $_POST['role'];
        }
            $user_id = $_SESSION['$user_edit_id'];
            $user_name = $_SESSION['$user_edit_name'];
            $user_email =  $_SESSION['$user_edit_email'];
            $user_ph = $_SESSION['$user_edit_phone'];
            $user_role =$_SESSION['$user_edit_role'];
  ?>
  <?php
        // Check if email already exists
        if (isset($_SESSION['update_error'])) {
            echo '<p id="register-error">' . $_SESSION['update_error'] . '</p>';
            unset($_SESSION['update_error']);
        }
    ?>
   <main id="register-container">
<form action="includes/user_editprofileaction.php" method="POST" id="registrationForm">
     <input type="number" name="id" class="register-class" hidden value="<?php echo $user_id; ?>"><br><br>
     <label class="registerlabel" for="username">Username:</label>
     <input type="text" class="register-class" name="username" required pattern="[A-Za-z0-9\s]+" title="Only alphanumeric characters and spaces are allowed" placeholder="e.g Nick Jones" value="<?php echo $user_name;?>"><br><br>
     <label class="registerlabel" for="newpassword">New Password:</label>
     <input type="password" class="register-class" name="newpassword" ><br><br>
     <label class="registerlabel" for="email">Email:</label>
     <input type="email" name="email" class="register-class" id="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}" required placeholder="e.g Nick@yahoo.com" value="<?php echo $user_email;?>"><br><br>
     <label class="registerlabel"for="phonenumber">Phone Number:</label>
     <input type="text" name="phonenumber" class="register-class" required pattern="[0-9]+" title="Only numeric characters are allowed" placeholder="e.g 923300022" value="<?php echo $user_ph; ?>"><br><br>
     <input type="text" name="role" class="register-class" hidden value="<?php echo $user_role; ?>"><br><br>
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