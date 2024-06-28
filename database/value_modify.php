<?php
error_reporting();
include_once 'connect.php';

if (isset($_POST['functionName']) && isset($_POST['someId'])) {
    $functionName = $_POST['functionName'];
    $assignmentId = $_POST['someId'];
    $returnValue = $functionName($assignmentId);
    if ($returnValue == true){
        echo true;
    }
}

//to delete the submitted values
if (isset($_POST['delete_submissionid'])) {
    $submissionId = $_POST['delete_submissionid'];
    $result = deleteSubmission($submissionId);
}

//to set feedback
if (isset($_POST['feedback_submissionid']) && $_POST['feedbackText']) {
    $submissionId = $_POST['feedback_submissionid'];
    $feedbackText = $_POST['feedbackText'];
    $result = createFeedback($submissionId,$feedbackText);
}




    function updateAssignment($assignment_id, $assignment_text, $assignment_deadline, $assignment_file) {
        try {
            $connection = connectDatabase();
            if ($assignment_file == null) {
                // If file is not present               
                $sql = "UPDATE assignments SET assignment_text='$assignment_text', deadline='$assignment_deadline' WHERE assignment_id='$assignment_id';";
            } else {
                // If file is present
                $sql = "UPDATE assignments SET assignment_text='$assignment_text', deadline='$assignment_deadline', assignment_file='$assignment_file' WHERE assignment_id='$assignment_id';";
            }
            print_r($sql);
            
            mysqli_query($connection, $sql);
            return true;
        } catch (Exception $ex) {
            die('Database Error: ' . $ex->getMessage());
        }
    }

    function deleteAssignment($assignment_id){
        try {
            $connection = connectDatabase();
            $sql = "DELETE FROM assignments WHERE assignment_id='$assignment_id';";
            mysqli_query($connection, $sql);
            return true;
            } catch (Exception $ex) {
                die('Database Error: ' . $ex->getMessage());
            }
    }

    function deleteSubmission($submissionId){
        try{
            $connection = connectDatabase();
            $sql = "DELETE FROM submission WHERE submission_id='$submissionId';";
            mysqli_query($connection,$sql);
            return true;
        } catch (Exception $ex){
            die('Database Error: '. $ex->getMessage());
        }
    }

    function updateSubmission($submissionId,$submissionFile){
        try{
            $connection = connectDatabase();
            $sql = "UPDATE submission SET submission_file='$submissionFile' WHERE submission_id='$submissionId';";
            mysqli_query($connection,$sql);
            return true;
        } catch (Exception $ex){
            die('Database Error: '. $ex->getMessage());
        }
    }   

    function createFeedback($submissionId,$feedback_text){
        try{
            $connection = connectDatabase();
            $sql = "UPDATE submission SET feedback='$feedback_text' WHERE submission_id='$submissionId';";
            mysqli_query($connection,$sql);
            return true;
        } catch (Exception $ex){
            die('Database Error: '. $ex->getMessage());
        }
    }   
?>