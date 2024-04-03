<?php
    error_reporting();
    session_start();
    include_once '../database/value_pull.php';
    include_once '../database/value_push.php';
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

    //get the data inserted in the popup modal forms so that it can be passed to insert in db
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
    <div class="assignment-container">
        <div class="left">
            <div class="left-titles">
                <?php
                    $categoryNames = getCategory($_SESSION['teacher_id'],$courseCode);
                    if ($categoryNames == false){
                        echo 'No category created.';
                    }else {
                        foreach ($categoryNames as $name){
                ?>
                <div class="category-name" onclick="loadQuestion(<?php echo $name['assignment_category_id']; ?>)">
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
                <a href="#create-category" rel="modal:open">Create Category</a>  <!-- make this look like a button --> 
            </div>
            <?php
                }
            ?>
        </div>
        <div class="right">
            <!-- everything here comes from fetch_questions.php through loadQuestion(): ajax -->
        </div>
    </div>
    

    <!-- this is for the popup modals -->
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
    <!-- after submission error modal -->
    <div id="error-after-submission" class="modal">
        <span id="error-message"></span>
    </div>



    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />

    <!-- displays error message if there is error returning from the backend -->
    <?php if (isset($err['error-message'])){ ?>
        <script>
            displayErrorModal("<?php echo $err['error-message']; ?>");
        </script>
    <?php } ?>

</body>
</html>