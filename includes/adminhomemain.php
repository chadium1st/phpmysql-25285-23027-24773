<?php
if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'admin')) {
  header("Location: ../index.php");
  exit;
} ?>
<main class="Introduction">
        <div>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage"src="graphic/profileblack.svg" alt="jobs icon">
                    <h2>My Profile</h2>
                    <p>You can modify your profile.</p>
                </div>
                <div>
                    <a href="myprofile.php">
                        <img src="graphic/righterrow.svg" alt="forward to myprofile">
                    </a>
                </div>
            </section>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage" src="graphic/users.svg" alt="Users icon">
                    <h2>Users</h2>
                    <p>You can manage users here.</p>
                </div>
                <div>
                    <a href="users.php">
                        <img src="graphic/righterrow.svg" alt="forward to users">
                    </a>
                </div>
            </section>
        </div>
        <div>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage" src="graphic/jobs.svg" alt="jobs icon">
                    <h2>Jobs</h2>
                    <p>You can manage jobs here.</p>
                </div>
                <div>
                    <a href="jobs.php">
                        <img src="graphic/righterrow.svg" alt="forward to jobs">
                    </a>
                </div>
            </section>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage" src="graphic/reports.svg" alt="jobs icon">
                    <h2>Reports</h2>
                    <p>You can manage reports here.</p>
                </div>
                <div>
                    <a href="reports.php">
                        <img src="graphic/righterrow.svg" alt="forward to user reports">
                    </a>
                </div>
            </section>
        </div>
    </main>