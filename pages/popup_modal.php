<?php
    error_reporting();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once '../database/value_pull.php';
    include_once '../database/value_push.php';

    //get the course code of whichever course is clicked
    if(isset($_GET['course_code'])) {
        $courseCode = $_GET['course_code'];
    }

    //since student-id is needed if a student submits a file/answer
    $loggedInUsername = $_SESSION['username'];
    if($_SESSION['title'] == 'student') {
        $userDetails = getDetails($loggedInUsername);
        foreach($userDetails as $detail){
            $student_id = $detail['student_id'];
        }
    }

    //get the data that is inserted in the popup modal form create category so that it can be passed to insert in db
    if (isset($_POST['createCategory'])){
        $category_name = $_POST['category_name'];
        $result = createCategory($_SESSION['teacher_id'],$_GET['course_code'],$category_name);
        if ($result == true){
            // Redirect back to the same page to prevent form resubmission
            header("Location: ".$_SERVER['PHP_SELF']."?course_code=".$courseCode);
            exit();
        } else {
            $err['error-message'] = 'Category already exists';
        }
    }
    //get the data that is inserted in the popup modal form create assignment so that it can be passed to insert in db
    elseif (isset($_POST['createAssignment'])){
        $category_id = $_POST['category_id'];
        $assignment_text = $_POST['assignment_text'];
        $assignment_deadline = $_POST['assignment_deadline'];

        // Check if file is uploaded
        if(isset($_FILES['assignment_file'])) {
            //store it in a array for easier access
            $assignment_file = $_FILES['assignment_file'];
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
                            $result = createAssignment($category_id,$assignment_text,$assignment_deadline,$file_new_name);
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
                // Set $assignment_file to null when no file is uploaded
                $assignment_file = null;
                $result = createAssignment($category_id,$assignment_text,$assignment_deadline,$assignment_file);
            }
        }
        if (isset($result)){
            if ($result == true){
                // Redirect back to the same page to prevent form resubmission
                header("Location: ".$_SERVER['PHP_SELF']."?course_code=".$courseCode);
                exit();
            } else {
                $err['error-message'] = 'Error during assignment creation';
            }
        }
    }
    //get data and pass from submit assignment by students
    elseif (isset($_POST['submitFile'])){
        $assignment_id = $_POST['assignment_id'];
        $student_id = $_POST['student_id'];
        $teacher_courses_id = $_POST['teacher_courses_id'];

        // Check if file is uploaded
        if(isset($_FILES['submission_file'])) {
            //store it in a array for easier access
            $submission_file = $_FILES['submission_file'];
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
                            $result = createSubmission($assignment_id,$student_id,$teacher_courses_id,$file_new_name);
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
                    header("Location: ".$_SERVER['PHP_SELF']."?course_code=".$courseCode);
                    exit();
                } else {
                    $err['error-message'] = 'Database Upload Error';
                }
            }
        }
    }




    if ($_SESSION['title'] == 'teacher'){
?>

<!-- this is for the popup modals of create category -->
<div id="create-category" class="modal">
    <form action="" method="post" onsubmit="return validateCreateCategoryForm()">
        <div class="input-control">
            <label for="category-name">Enter category name:</label>
            <input type="textbox" id="category-name" name="category_name">
            <span class="error" id="category-name-error"><?php if (isset($err['category_name'])){echo $err['category_name'];} ?></span>
        </div>
        <div class="form-button">
            <input type="submit" value="Create" name="createCategory">
        </div>
    </form>
</div>

<!-- this is for the popup modals of create assignment -->
<div id="create-assignment" class="modal">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateCreateAssignmentForm()">
        <div class="input-control">
            <input type="hidden" id="category-id" name="category_id" value=""> <!-- value here comes from loadQuestion() js -->
        </div>
        <div class="input-control">
            <label for="assignment-text">Enter assignment text:</label><br>
            <textarea rows="5" cols="57" id="assignment-text" name="assignment_text"></textarea>
            <span class="error" id="assignment-text-error"></span>
        </div>
        <div class="input-control">
            <label for="assignment-deadline">Select deadline for this assignment:</label>
            <input type="date" id="assignment-deadline" name="assignment_deadline">
            <span class="error" id="assignment-deadline-error"></span>
        </div>
        <div class="input-control">
            <label for="assignment-file">If files are required select here(only pdf files):</label>
            <input type="file" name="assignment_file">
        </div>
        <div class="form-button">
            <input type="submit" value="Create" name="createAssignment">
        </div>
    </form>
</div>
<?php
    }
    if ($_SESSION['title'] == 'student'){
?>
<!-- this is the pop up modal to submit file by students -->
<div id="submit-file" class="modal">
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateSubmitFileForm()">
    <div class="input-control">
        <input type="hidden" id="assignment-id" name="assignment_id" value=""> <!-- value comes from loadQuestion() js -->
        <input type="hidden" id="student-id" name="student_id" value="<?php echo $student_id; ?>"> 
        <input type="hidden" id="teacher-courses-id" name="teacher_courses_id" value=""> <!-- value comes from loadQuestion() js -->
    </div>
        <div class="input-control">
            <label for="submission-file">Choose your file:</label>
            <input type="file" id="submission-file" name="submission_file">
            <span class="error" id="submit-file-error"></span>
        </div>
        <div class="form-button">
            <input type="submit" value="Submit" name="submitFile">
        </div>
    </form>
</div>
<?php
    }
?>
<!-- after submission error modal -->
<div id="error-after-submission" class="modal">
    <span id="error-message"></span>
</div>

<script type="text/javascript" src="../js/script.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />

<!-- displays error message if there is error returning from the backend -->
<?php if (isset($err['error-message'])){ ?>
    <script>
        displayErrorModal("<?php echo $err['error-message']; ?>");
    </script>
<?php } ?>