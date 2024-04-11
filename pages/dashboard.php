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

    //get teacher_id and semester_number into $value to view what courses teacher is teaching or what courses student is studying
    $userDetails = getDetails($loggedInUsername);
    foreach($userDetails as $detail){
        if ($title == 'teacher'){
            $value = $detail['teacher_id'];
            $_SESSION['teacher_id'] = $detail['teacher_id'];
        } else if($title == 'student') {
            $stdId = $detail['student_id']; //for 7 and 8 sem their elective subject is set according to their id as different people can have different electives
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
        if ($value !== '7' && $value !== '8'){
            $stdId = null;
        }
        $courseNames = getCourse($stdId,$value);
        foreach ($courseNames as $course) {
    ?>
    <div class='blocks'>
        <!-- if this link is clicked and if a teacher is assigned it will go inside that else remain in the same page -->
        <a href="<?php echo (getSubjectTeacher($course['course_code']) == false) ? $_SERVER['PHP_SELF'] : 'assignment.php?course_code='.$course['course_code']; ?>">
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
                                //tyo subject lai teacher assign navako case ma
                                echo 'No teacher assigned';
                                
                            } else {
                                //subject padaune teacher ko name dekhauna lai
                                $teacherIdName = getSubjectTeacher("{$course['course_code']}");
                                foreach ($teacherIdName as $teacherIdName){
                                    echo $teacherIdName['fname'].' '.$teacherIdName['lname'];
                                }
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