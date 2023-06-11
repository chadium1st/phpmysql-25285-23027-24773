<?php
    include "includes/common.php";  
    // Check if the user is already logged in
    if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)) {
        header("Location: ../index.php");
        exit;
    } else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOBLICIOUS | My Jobs</title>
    <?php
        include "metatags.php";
    ?>
</head>
<body>
</body>
</html>

<?php }?>