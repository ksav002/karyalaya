<?php
error_reporting();
include_once '../database/value_pull.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}
print_r($_POST);
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
        $noAssignmentError = "No assignment questions found for this category.";
    }
} else {
    // If category ID is not set in the POST request
    echo "Category ID not provided.";
    exit();
}
$title = $_SESSION['title'];
?>

<!-- if no assignment error is shown, this if ststement ensures that the button to create assignment is still shown -->
<?php if(isset($noAssignmentError)) { ?>
    <div class="error-message"><?php echo $noAssignmentError;?></div>
<?php } else { ?>

<div class="right-titles">
    <?php
        $assignmentNumber = 1; //yo chai assignment number 1,2,3... garna lai //ahile chai initialize ani paxi chai increment
        foreach($questionDetails as $details){
    ?>
    <div class="assignment-title">
        <div class="title-name">
            <span>Assignment <?php echo $assignmentNumber++ ?></span>
            <span><?php echo $details['deadline']; ?></span>
        </div>
        <div class="question">
            <span><?php echo $details['assignment_text']; ?></span>
            <!-- for preview -->
            <?php
                if ($details['assignment_file'] !== NULL){
            ?> 

                <a href="preview.php" target="_blank">Preview</a>

            <?php
                }
            ?>
        </div>
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
    <div class="hidden-button">
    <form action="submission.php" method="post">
            <input type="hidden" name="assignmentId" value="<?php echo $assignmentId; ?>">
            <input type="hidden" name="teacherCoursesId" value="<?php echo $teacherCoursesId; ?>">
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
    <button>Select file</button>
    <button>Upload file</button> <!-- form use nagari file upload garna milxa ki mildaina -->
</div>
<?php
}
?>

<script type="text/javascript" src="../js/jquery.min.js"></script>