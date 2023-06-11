<?php
session_start();
// ...

    // Check if the logout button was clicked

        session_unset();

        // Destroy the session
        session_destroy();

        // Redirect to login.php
        header("Location: ../login.php");
        exit;

?>