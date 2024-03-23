<?php
include_once '../database/value_pull.php';

// Check if the category ID is set in the POST request
if(isset($_POST['categoryId'])) {

    // Get the category ID from the POST request
    $categoryId = $_POST['categoryId'];

    // Implement your logic to fetch assignment questions based on the category ID
    $assignmentQuestions = getAssignment($categoryId);

    // Check if assignment questions were fetched successfully
    if($assignmentQuestions !== false) {
        $questionDetails =  $assignmentQuestions;
        
    } else {
        // If no assignment questions were found for the provided category ID
        echo "No assignment questions found for this category.";
    }
} else {
    // If category ID is not set in the POST request
    echo "Category ID not provided.";
}
?>



<div class="right-titles">

<?php
$assignmentNumber = 1; //yo chai assignment number 1,2,3... garna lai
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
?>

</div>



<div class="buttons">
    <button>View Submissions</button>
    <button onclick="createQuestion()">Create Question</button>
</div>