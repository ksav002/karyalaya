<?php
    error_reporting();
    session_start();
    include_once '../database/value_pull.php';
    include_once '../database/value_push.php';
    include_once 'popup_modal.php';
    include_once 'popup_modal_modify.php';
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit(); // Stop executing the script
    }

    // Retrieve the name and title from the session variable
    $loggedInUsername = $_SESSION['username'];
    $title = $_SESSION['title'];

    //get the course code of whichever course is clicked
    if(isset($_GET['course_code'])) {
        $courseCode = $_GET['course_code'];
    }
    if($title == 'student') {
        $userDetails = getDetails($loggedInUsername);
        foreach($userDetails as $detail){
            $stdId = $detail['student_id'];
            $semesterNumber = $detail['semester_number'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assignments</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include_once 'login_navbar.php'; ?>
    <div class="heading">
        <h1><a href="dashboard.php">My Courses</a>>My Assignments</h1>
    </div>
    <div class="course-title">
        <?php
            if ($title == 'teacher'){
                $courseName = getCourse(null,$_SESSION['teacher_id']);
            } else if ($title == 'student'){
                $courseName = getCourse($stdId,$semesterNumber);
            }
            foreach($courseName as $courseName){
                if ($courseName['course_code'] == $_GET['course_code']){
                    echo $courseName['course_title'];
                    break;
                }
            }
        ?>
    </div>
    <div class="assignment-container">
        <div class="left">
            <div class="left-titles">
                <?php
                    if ($title == 'teacher'){
                        $categoryNames = getCategory($_SESSION['teacher_id'],$courseCode);
                    } elseif ($title == 'student') {
                        $teacherId = getSubjectTeacher($courseCode);
                        foreach ($teacherId as $teacherId) {
                            $teacherId = $teacherId['teacher_id'];
                        }
                        $categoryNames = getCategory($teacherId,$courseCode);
                    }
                    if ($categoryNames == false){
                        echo 'No category created.';
                    }else {
                        foreach ($categoryNames as $name){
                ?>
                <div class="category-name" onclick="loadQuestion(<?php echo $name['assignment_category_id'].','.$name['teacher_courses_id'];?>); keepSelected()">
                    <span><?php echo $name['category_name']; ?></span>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
            <?php
                if ($title == 'teacher'){
            ?>
            <div class="buttons">
                <a href="#create-category" rel="modal:open"><button>Create Category</button></a>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="right">
            <!-- everything here comes from fetch_questions.php through loadQuestion(): ajax -->
        </div>
    </div>

    <script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />

</body>
</html>