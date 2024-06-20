<?php
    error_reporting();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../database/value_pull.php';
    include_once '../database/value_modify.php';

    if (isset($_POST['updateAssignment'])){
        $assignment_id = $_POST['update_assignment_id'];
        $assignment_text = $_POST['update_assignment_text'];
        $assignment_deadline = $_POST['update_assignment_deadline'];

        // Check if file is uploaded
        if(isset($_FILES['update_assignment_file'])) {
            //store it in a array for easier access
            $assignment_file = $_FILES['update_assignment_file'];
            if ($assignment_file['error'] == 0){   //error 0 means file uploaded successfully
                //allowed file types
                $allowed_file_type = ['application/pdf'];
                if(in_array($assignment_file['type'],$allowed_file_type)){
                    if ($assignment_file['size'] <= 15728640){
                        //creates a unique name so that new file doesn't overwrite old one with same name
                        $file_extension = pathinfo($assignment_file['name'], PATHINFO_EXTENSION);
                        $file_new_name = uniqid('answer_', true) . '.' . $file_extension;
                        //provides file path to put the file in
                        $file_destination = '../user uploads/' . $file_new_name;
                        if (move_uploaded_file($assignment_file['tmp_name'],$file_destination)){
                            $result = updateAssignment($assignment_id,$assignment_text,$assignment_deadline,$file_new_name);
                        } else {
                            $err['update-error-message'] = 'File could not be uploaded to the specified path';
                        }    
                    } else {
                        $err['update-error-message'] = 'File size must be less than 15 MB';
                    }
                } else {
                    $err['update-error-message'] = 'Only pdf is allowed';
                }
            } else {
                // Set $assignment_file to null when no file is uploaded
                $assignment_file = null;
                $result = updateAssignment($assignment_id,$assignment_text,$assignment_deadline,$assignment_file);
            }
        }
        if (isset($result)){
            if ($result == true){
                // Redirect back to the same page to prevent form resubmission
                echo '<script>
                        alert("Assignment updated successfully.");
                        window.location.href = "'.$_SERVER['PHP_SELF'].'?course_code='.$courseCode.'";
                    </script>';
                exit();
            } else {
                $err['update-error-message'] = 'Error during assignment creation';
            }
        }
    }

    if (isset($_POST['editFile'])){
        $submission_id = $_POST['edit_submission_id'];

        // Check if file is uploaded
        if(isset($_FILES['edit_submission_file'])) {
            //store it in a array for easier access
            $submission_file = $_FILES['edit_submission_file'];
            if ($submission_file['error'] == 0){   //error 0 means file uploaded successfully
                //allowed file types
                $allowed_file_type = ['application/pdf'];
                if(in_array($submission_file['type'],$allowed_file_type)){
                    if ($submission_file['size'] <= 15728640){
                        //creates a unique name so that new file doesn't overwrite old one with same name
                        $file_extension = pathinfo($submission_file['name'], PATHINFO_EXTENSION);
                        $file_new_name = uniqid('answer_', true) . '.' . $file_extension;
                        //provides file path to put the file in
                        $file_destination = '../user uploads/' . $file_new_name;
                        if (move_uploaded_file($submission_file['tmp_name'],$file_destination)){
                            $result = updateSubmission($submission_id,$file_new_name);
                        } else {
                            $err['error-message'] = 'File could not be uploaded to the specified path';
                        }    
                    } else {
                        $err['error-message'] = 'File size must be less than 15 MB';
                    }
                } else {
                    $err['error-message'] = 'Only pdf is allowed';
                }
            } else {
                $err['error-message'] = 'Server Upload error';
            }
            if (isset($result)){
                if ($result == true){
                    // Redirect back to the same page to prevent form resubmission
                    echo '<script>
                                alert("Assignment edited successfully.");
                                window.location.href = "'.$_SERVER['PHP_SELF'].'?course_code='.$courseCode.'";
                            </script>';
                    exit();
                } else {
                    $err['error-message'] = 'Database Upload Error';
                }
            }
        }
    }
?>

<!-- this is for the popup modals of update assignment -->
<div id="update-assignment" class="modal">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateUpdateAssignmentForm()">
        <div class="input-control">
            <input type="hidden" id="update-assignment-id" name="update_assignment_id" value="">
        </div>
        <div class="input-control">
            <label for="assignment-text">Enter assignment text:</label><br>
            <textarea rows="5" cols="57" id="update-assignment-text" name="update_assignment_text"></textarea>
            <span class="error" id="update-assignment-text-error"></span>
        </div>
        <div class="input-control">
            <label for="assignment-deadline">Select deadline for this assignment:</label>
            <input type="date" id="update-assignment-deadline" name="update_assignment_deadline">
            <span class="error" id="update-assignment-deadline-error"></span>
        </div>
        <div class="input-control">
            <label for="update-assignment-file">If files are required select here(only pdf files):</label>
            <input type="file" name="update_assignment_file">
        </div>
        <div class="form-button">
            <input type="submit" value="Update" name="updateAssignment">
        </div>
    </form>
</div>

<!-- this is the pop up modal to edit submitted file by students -->
<div id="edit-file" class="modal">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateEditFileForm()">
    <div class="input-control">
        <input type="hidden" id="edit-submission-id" name="edit_submission_id" value="">
    </div>
        <div class="input-control">
            <label for="submission-file">Choose your file:</label>
            <input type="file" id="edit-submission-file" name="edit_submission_file">
            <span class="error" id="edit-file-error"></span>
        </div>
        <div class="form-button">
            <input type="submit" value="Edit" name="editFile">
        </div>
    </form>
</div>

<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>