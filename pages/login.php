<?php
    error_reporting();
    session_start();
    include_once '../database/login_validation.php';
    if (isset($_POST['btnLogin'])){
        $err=[];
        if (isset($_POST['title']) && !empty($_POST['title']) && trim($_POST['title'])){
            $title =  $_POST['title'];
        }
        if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])){
            $username =  $_POST['username'];
        } else {
            $err['username'] = 'Please enter username';
        }
        if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])){
            $password =  $_POST['password'];
        } else {
            $err['password'] = 'Please enter password';
        }

        if($title == 'teacher'){
            $tableName = 'teachers';
        }
        else if($title == 'student'){
            $tableName = 'students';
        }
        //If there is no error, pass these 3 values to validate form and store the username and title in session then go to dashboard
        //username is passed to check whether the user is logged in or not across multiple pages
        //title is passed to know which dashboard to show for student/teacher
        if(count($err) == 0){
            if (validateUserLogin($tableName,$username,$password)){
                $_SESSION['username'] = $username;
                $_SESSION['title'] = $title;
                header("location:dashboard.php");
            } else {
                $err['login'] = 'Invalid username or password';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="background-color">
        <div class="login-wrapper">
            <div class="login-logo">
                <img src="../images/logo.svg" alt="Assignment Digitalization">
            </div>

            <div class="container">
                <h2 class="heading">
                    LOGIN
                </h2>
                <form action="" method="post">
                    <div class="toggle">
                        <input type="radio" value="teacher" name="title" class="teacher" id="teacher" checked>
                        <label for="teacher">Teacher</label>

                        <input type="radio" value="student" name="title" class="student" id="student">
                        <label for="student">Student</label>

                        <div class="slider">
                            &nbsp;
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="input-control">
                            <label for="username">Username</label>
                            <input type="text" name="username"/>
                            <span class="error"><?php if (isset($err['username'])){echo $err['username'];} ?></span>
                        </div>
                        <div class="input-control">
                            <label for="password">Password</label>
                            <input type="password" name="password"/>
                            <span class="error"><?php if (isset($err['password'])){echo $err['password'];} ?></span>
                        </div>
                        <div>
                            <input type="checkbox" checked="checked" name="remember"/>
                            <label for="remember">Stay logged in</label>
                        </div>
                        <span class="error"><?php if (isset($err['login'])) {echo $err['login'];} ?></span>
                        <div class="form-button">
                            <input type="submit" value="Login" name="btnLogin">
                        </div>
                    </div>
                </form>
                <!-- <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div> -->
                <p class="terms">
                    By signing in, you agree to our <a href="#">terms and conditions.</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>