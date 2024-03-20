<?php
    error_reporting();
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

    //get teacher_id and semester_number to view what courses teacher is teaching or what courses student is studying
    $userDetails = getDetails($loggedInUsername);
    foreach($userDetails as $detail){
        if ($title == 'teacher'){
            $value = $detail['teacher_id'];
        } else if($title == 'student') {
            $value = $detail['semester_number'];
        }
    }
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
        $courseNames = getCourse($value);
        foreach ($courseNames as $course) {
    ?>
    <div class='blocks'>
        <a href="assignment.php">
            <div class='left'>
                <span><?php echo $course['course_code']; ?></span>
            </div>
            <div class='right'>
                <span><?php echo $course['course_title']; ?></span>
                <span>
                    <?php
                        if ($title == 'teacher'){
                            echo 'Semester '.$course['semester_number'];
                        } else if($title == 'student') {
                            if (getSubjectTeacher("{$course['course_code']}") == false){
                                echo 'No teacher assigned';
                            } else {
                                echo getSubjectTeacher("{$course['course_code']}");
                            }
                        }
                    ?>
                </span>
            </div>
        </a>
    </div>
    <?php
        }
    ?>
</body>
</html>