<?php
    if ((!isset($_SESSION['loggedin'])||($_SESSION['loggedin']!==true)) && ($_SESSION['user_role'] !== 'recruiter' || $_SESSION['user_role'] !== 'Recruiter')) {
    header("Location: ../index.php");
    exit;
    } 
?>
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
                    <h2>Applicants</h2>
                    <p>You can manage the applicants here.</p>
                </div>
                <div>
                    <a href="includes/applicants.php">
                        <img src="graphic/righterrow.svg" alt="forward to users">
                    </a>
                </div>
            </section>
        </div>
        <div>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage" src="graphic/jobs.svg" alt="jobs icon">
                    <h2>Create Jobs</h2>
                    <p>You can put out new jobs.</p>
                </div>
                <div>
                    <a href="create-jobs.php"> 
                        <img src="graphic/righterrow.svg" alt="forward to jobs">
                    </a>
                </div>
            </section>
            <section class="Introduction introductionsection" >
                <div>
                    <img class="mainimage" src="graphic/employee.png" alt="jobs icon">
                    <h2>Your Jobs</h2>
                    <p>You can manage your jobs here.</p>
                </div>
                <div>
                    <a href="own-jobs.php">
                        <img src="graphic/righterrow.svg" alt="forward to own jobs">
                    </a>
                </div>
            </section>
        </div>
    </main>