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
            $assignment_file = $_FILES['assignment_file']['name'];
        } else {
            // Set $assignment_file to null when no file is uploaded
            $assignment_file = null;
        }
        $result = createAssignment($category_id,$assignment_text,$assignment_deadline,$assignment_file);
        if ($result == true){
            // Redirect back to the same page to prevent form resubmission
            header("Location: ".$_SERVER['PHP_SELF']."?course_code=".$courseCode);
            exit();
        } else {
            $err['error-message'] = 'Error during assignment creation';
        }
    }
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
            <input type="hidden" id="category-id" name="category_id" value="2"> <!-- how to pass category id in here/value -->
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
            <label for="assignment-file">Select file for this assignment(If required):</label>
            <input type="file" name="assignment_file">
        </div>
        <div class="form-button">
            <input type="submit" value="Create" name="createAssignment">
        </div>
    </form>
</div>

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