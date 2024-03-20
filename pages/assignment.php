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
        <h1>My Assignments</h1>
    </div>
    <?php
        if  ($_SESSION['title'] == 'teacher'){
    ?>
    <!-- for teacher html starts here -->
    <div class="assignment-container">
        <div class="left">
            <div class="left-titles">
                <!-- new category-names should be generated according to category-names in database -->
                <div class="category-name">
                    <span>Chapter 1</span>
                </div>
                <div class="category-name">
                    <span>Chapter 2</span>
                </div>
                <div class="category-name">
                    <span>Chapter 3</span>
                </div>
                <div class="category-name">
                    <span>Chapter 4</span>
                </div>
                <div class="category-name">
                    <span>Chapter 5</span>
                </div>
                <div class="category-name">
                    <span>Chapter 6</span>
                </div>
                <div class="category-name">
                    <span>Chapter 7</span>
                </div>
            </div>
            <div class="buttons">
                <button onclick="createCategory()">Create Category</button>
            </div>
        </div>
        <div class="right">
            <div class="right-titles">
                <!-- new questions should be generated according to assignments in database -->
                <div class="question">
                    1.Define html.
                </div>
                <div class="question">
                    2.Define css.
                </div>
            </div>
            <div class="buttons">
                <button>View Submissions</button>
                <button onclick="createQuestion()">Create Question</button>
            </div>
        </div>
    </div>
    
    

    <?php    
        } 
        if  ($_SESSION['title'] == 'student'){
    ?>

    <!-- for student html starts here -->
    <div class="category">
        <div class="category-title">
            <span>Chapter 1</span>
        </div>
        <div class="hide-elements">
            <div class="content">
                <span> Assignment 1 -- Define html.</span>
            </div>
            <div class="buttons">
                <button>Select File</button>
                <button>Submit</button>
            </div>
        </div>
    </div>

    <div class="category">
        <div class="category-title">
            <span>Chapter 2</span>
        </div>
        <div class="hide-elements">
            <div class="content">
                <span> Assignment 1 -- Define js.</span>
            </div>
            <div class="buttons">
                <button>Select File</button>
                <button>Submit</button>
            </div>
        </div>
    </div>


    <?php 
        } 
    ?>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>