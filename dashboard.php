<?php
    session_start();
    include_once 'database/value_pull.php';
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit(); // Stop executing the script
    }

    // Retrieve the username from the session variable
    $loggedInUsername = $_SESSION['username'];
    // Retrieve the title from the session variable
    $title = $_SESSION['title'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="dashboard-header">
        <div class="logo">
            <img src="images/logo.svg" alt="Assignment Digitalization">
        </div>
        <div class="welcome">
            <h3>Welcome to the Dashboard, <?php echo $loggedInUsername; ?>!</h3>
        </div>
    </div>
    <div class="heading">
        <h1>My Courses</h1>
    </div>
    <div class="blocks">
        <p>Course 1</p>
    </div>
    <div class="blocks">
        <p>Course 2</p>
    </div>

</body>
</html>