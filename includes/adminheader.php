<?php
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin' || $_SESSION['user_role'] !== 'recruiter' || $_SESSION['user_role'] !== 'Recruiter')) {
  header("Location: ../index.php");
  exit;
} ?>
<header class="header">
    <div class="toggle-btn" onclick="toggleSidebar()">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="logo">
      <img src="graphic/logo.png" alt="Logo">
     
        <a href="includes/logout.php"><img id="imagetoinvert" src="graphic/logoutsvg.svg "alt="Logout icon" title="Logout"></a>
     
    </div>
    
    <form action="search-result.php" method="POST" class="search">
        <input type="text" name="searchtxt" placeholder="Search.." value="<?php if(isset($_SESSION['searchtext'])) echo $_SESSION['searchtext'];?>">
        <input type="text" name="search_button_value" hidden value="USER">

        <button type="submit">
          <i class="fa fa-search">
            <img class="search-icon" src="graphic/searchsvg.svg" alt="search icon" title="Search">
          </i>
        </button>
    </form>
    <nav class="nav">
      <ul>
        <li><a href="home.php"><img id="imagetoinvert" src="graphic/home_filled.svg" alt="home icon" title="Home"></a></li>
      </ul>
    </nav>
    
  </header>