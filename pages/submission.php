<?php

error_reporting();
include_once '../database/value_pull.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}

$assignmentId=105;
$teacherCoursesId=1;

$submissionResult = getSubmission($assignmentId,$teacherCoursesId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Submissions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include_once 'login_navbar.php'; ?>
    <div class="heading">
        <h1><a href="dashboard.php">My Courses</a>><a href="javascript:history.back()">My Assignments</a>>View Submissions</h1>
    </div> 
    <table border="1">
        <tr>
            <th>S.N.</th>
            <th>Student's Name</th>
            <th>Submitted File</th>
            <th>Modify</th>
        </tr>
        <?php foreach ($submissionResult as $key => $submissionResult){ ?>
            <tr>
                <td><?php echo $key+1 ?></td>
                <td><?php echo $submissionResult['fname']. ' ' .$submissionResult['lname'] ?></td>
                <td><?php echo '<a href='.$submissionResult['submission_file'].'>Download</a>' ?></td>
                <td><button>Delete</button></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>