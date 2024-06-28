<?php
error_reporting(0);
include_once '../database/value_pull.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}
// Check if the category ID is set in the POST request
if(isset($_POST['categoryId'])) {
    // Get the category ID from the POST request
    $categoryId = $_POST['categoryId'];
    $assignmentQuestions = getAssignment($categoryId);
    // Check if assignment questions were fetched successfully
    if($assignmentQuestions !== false) {
        $questionDetails =  $assignmentQuestions;
    } else {
        // If no assignment questions were found for the provided category ID
        $noAssignmentError = "No assignment questions found.";
    }
} else {
    // If category ID is not set in the POST request
    echo "Category ID not provided.";
    exit();
}

$title = $_SESSION['title'];
?>

<!-- if no assignment error is shown, this if statement ensures that the button to create assignment is still shown -->
<?php if(isset($noAssignmentError)) { ?>
    <div class="error-message"><?php echo $noAssignmentError;?></div>
<?php } else { ?>

<div class="right-titles">
    <?php
        $assignmentNumber = 1; //yo chai assignment number 1,2,3... garna lai //ahile chai initialize ani paxi chai increment
        $currentDate = date('Y-m-d'); // Get the current date
        foreach($questionDetails as $details){
            // Check if the user is a teacher or if the deadline is in the future for students
            if ($title == 'teacher' || ($title != 'teacher' && $details['deadline'] >= $currentDate)) {
    ?>
    
    <div class="assignment-title"  data-assignment-id="<?php echo $details['assignment_id']; ?>">
        <div class="title-name">
            <span>Assignment <?php echo $assignmentNumber++ ?> ▼ </span>
            <span><?php echo $details['deadline']; ?></span>
        </div>
        <div class="question">
            <span><?php echo $details['assignment_text']; ?></span>
            <div class="assignment-buttons">
                <?php
                    if ($details['assignment_file'] !== ''){
                        $file_name = $details['assignment_file'];
                ?> 
                    <button onclick="previewFile('<?php echo $file_name; ?>')">Preview</button>
                <?php
                    }
                    if ($title == 'teacher'){
                ?>
                <a href="#update-assignment" data-modal="#update-assignment" rel="modal:open"><button onclick="passAssignmentIdForUpdate(<?php echo $details['assignment_id'] ?>)">Edit</button></a>

                <form action="" method="post" id="deleteAssignment" onsubmit="return confirmAssignmentDelete('deleteAssignment')">
                    <input type="hidden" name="assignmentId" id="delete-assignment-id" value="<?php echo $details['assignment_id'];?>">
                    <input type="submit" value="Delete" name="deleteAssignmentId">
                </form>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
            }
            $assignmentId = $details['assignment_id'];
        }
    }
    if(isset($_POST['viewFeedback'])){
        $submissionId = $_POST['submissionId'];
        
    }
    ?>
</div>

<?php
if ($title == 'teacher'){
?>

<div class="buttons">
    <div class="hidden-button">
    <form action="submission.php" method="post">
            <input type="hidden" name="assignmentId" id="assignment-id" value=""> <!-- value in here comes from js loadAccordion() -->
            <input type="hidden" name="teacherCoursesId" id="teacher-courses-id" value="<?php if(isset($_POST['teacherCoursesId'])){ echo $_POST['teacherCoursesId'];} ?>">
            <button type="submit">View Submissions</button>
        </form>
    </div>
    <a href="#create-assignment" data-modal="#create-assignment" rel="modal:open"><button>Create Assignment</button></a>
</div>

<?php
}
if ($title == 'student'){
?>
<div class="buttons">
    <div class="hidden-button">
    <?php
        $loggedInUsername = $_SESSION['username'];
        $userDetails = getDetails($loggedInUsername);
        foreach($userDetails as $detail){
            $studentId = $detail['student_id'];
        }
        $submissionId = checkSubmission($assignmentId,$studentId);

        if ($submissionId == false){ //if there is no data of the given details i.e., the submission id is null and it returns false show submit file
        ?>
        <a href="#submit-file" data-modal="#submit-file" rel="modal:open"><button>Submit File</button></a>
        <?php
        } else { //if the data exists then edit the data
            foreach ($submissionId as $submissionId){
        ?>
        <a href="#edit-file" data-modal="#edit-file" rel="modal:open" data-submission-id="<?php echo $submissionId['submission_id']; ?>"><button>Edit File</button></a>
        <form action="" onclick="return viewFeedbackForm()">
            <input type="hidden" name="submissionId" id="submission-id" value="<?php echo $submissionId['submission_id']; ?>">
            <a href="#view-feedback" data-modal="#view-feedback" rel="modal:open" data-submission-id="<?php echo $submissionId['submission_id']; ?>" data-feedback="<?php echo $submissionId['feedback']; ?>"><button>View Feedback</button></a>
        </form>
        <?php
            }
        }  
        ?>
        
    </div>
</div>
<?php
}
?>


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>   

