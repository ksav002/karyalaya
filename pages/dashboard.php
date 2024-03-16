<?php
    session_start();
    include_once '../database/value_pull.php';
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit(); // Stop executing the script
    }

    // Retrieve the name and title from the session variable
    $loggedInUsername = $_SESSION['username'];
    $title = $_SESSION['title'];
    
    if($title == 'teacher'){
        $tableName = 'teachers';
    }
    else if($title == 'student'){
        $tableName = 'students';
    }
    $id = getId($tableName);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include_once 'login_navbar.php'; ?>
    <div class="heading">
        <h1>My Courses</h1>
    </div>
    <?php 
        $courseNames = getCourse(3);
        // echo '<pre>';
        // print_r($courseNames);
        foreach ($courseNames as $index => $course) {
            // echo "Index: " . $index . ", Course Code: " . $course['course_code'] . ", Course Title: " . $course['course_title'] . "<br>";
            echo "
            <div class='blocks'>
                <div class='left'>
                    <span>". $course['course_code'] ."</span>
                </div>
                <div class='right'>
                    <span>". $course['course_title'] ."</span>
                    <span>Teacher Name</span>
                </div>
            </div>
            ";
        }
    ?>
</body>
</html>