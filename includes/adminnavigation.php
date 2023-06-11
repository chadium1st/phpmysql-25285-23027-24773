<?php if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
  header("Location: ../index.php");
  exit;
} ?>
<ul>
        <li class="sidebardiv">
          <a id="<?php if($active=="home")echo "active"; ?>" href="home.php">
            <div>
              <img class="imagetoinvert"  src="graphic/homewhitesvg.svg" alt="">
              <p class="sidebarParagraph" > Home</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="myprofile")echo "active"; ?>" href="myprofile.php">
            <div>
              <img class="imagetoinvert"  src="graphic/profilesvg.svg" alt="">
              <p class="sidebarParagraph"> Profile</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="users")echo "active"; ?>"  href="users.php">
            <div>
              <img class="imagetoinvert"  src="graphic/userwhite.svg" alt="">
              <p class="sidebarParagraph"> Users</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="jobs")echo "active"; ?>"  href="jobs.php">
            <div>
              <img class="imagetoinvert"  src="graphic/workwhite.svg" alt="">
              <p class="sidebarParagraph"> Jobs</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="about")echo "active"; ?>"  href="#">
            <div>
              <img class="imagetoinvert" src="graphic/aboutussvg.svg" alt="">
              <p class="sidebarParagraph"> About</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="contactus")echo "active"; ?>"  href="#">
            <div>
              <img class="imagetoinvert" src="graphic/contactussvg.svg" alt="">
              <p class="sidebarParagraph">Contact</p>
            </div>
          </a>
        </li>
        <li class="sidebardiv">
          <a id="<?php if($active=="policy")echo "active"; ?>"  href="#">
            <div>
              <img class="imagetoinvert" id="messageLogo" src="graphic/policywhitesvg.svg" alt="">
              <p class="sidebarParagraph"> Policy</p>
            </div>
          </a>
        </li>
      </ul>