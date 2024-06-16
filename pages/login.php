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

                if(isset($_POST['remember'])){ //sets cookie if remember me is checked/on
                    setcookie('title', $title, time() + (86400 * 30), "/"); // 30 days
                    setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
                    setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
                } else { //deletes cookie
                    setcookie('title', $title, time() - (86400 * 30), "/");
                    setcookie('username', $username, time() - (86400 * 30), "/");
                    setcookie('password', $password, time() - (86400 * 30), "/");
                }
                header("location:dashboard.php");
            } else {
                $err['login'] = 'Invalid username or password';
            }
        }
    }

    //if cookies are set then put it in a variable and use that variable to put in value in input fields 
    if (isset($_COOKIE['title']) && isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
        $title_cookie = $_COOKIE['title'];
        $username_cookie = $_COOKIE['username'];
        $password_cookie = $_COOKIE['password'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">  
</head>
<body>
    <div class="background-color">
        <div class="login-wrapper">
            <div class="login-logo">
                <img src="../images/logo-with-name.svg" alt="Assignment Digitalization">
            </div>

            <div class="container">
                <h2 class="heading">
                    LOGIN
                </h2>
                <form action="" method="post">
                    <div class="toggle">
                        <input type="radio" value="teacher" name="title" class="teacher" id="teacher" <?php if (isset($title_cookie)){echo ($title_cookie == 'teacher') ? 'checked' : '';} ?> checked>
                        <label for="teacher">Teacher</label>

                        <input type="radio" value="student" name="title" class="student" id="student" <?php if (isset($title_cookie)){echo ($title_cookie == 'student') ? 'checked' : '';} ?>>
                        <label for="student">Student</label>

                        <div class="slider">
                            &nbsp;
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="input-control">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?php if(isset( $username_cookie)){echo $username_cookie;} ?>"/>
                            <span class="error"><?php if (isset($err['username'])){echo $err['username'];} ?></span>
                        </div>
                        <div class="input-control">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="<?php if(isset( $password_cookie)){echo $password_cookie;} ?>"/>
                            <span class="error"><?php if (isset($err['password'])){echo $err['password'];} ?></span>
                        </div>
                        <div>
                            <input type="checkbox" checked="checked" name="remember"/>
                            <label for="remember">Remember me</label>
                        </div>
                        <span class="error"><?php if (isset($err['login'])) {echo $err['login'];} ?></span>
                        <div class="form-button">
                            <input type="submit" value="Login" name="btnLogin">
                        </div>
                    </div>
                </form>
                <p class="terms">
                    By signing in, you agree to our <a href="#">terms and conditions.</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>