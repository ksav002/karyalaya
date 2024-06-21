<?php
error_reporting(E_ALL);
session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function validateAdminLogin($email, $password){
    $conn = new mysqli("localhost", "root", "", "project");
    $query = "SELECT * FROM admins WHERE email='$email' AND password = '$password' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['btnLogin'])) {
    $err = [];
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = 'Please enter email';
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] = 'Please enter password';
    }

    if (count($err) == 0) {
        if (validateAdminLogin($email, $password)) {
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit();
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
    <link rel="stylesheet" href="assets/css/style.css">  
</head>
<body>
    <div class="background-color">
        <div class="login-wrapper">
            <div class="container">
                <h2 class="heading">LOGIN</h2>
                <form action="" method="post">
                    <input type="hidden" value="admin" name="title" id="admin">
                    <div class="form-box">
                        <div class="input-control">
                            <label for="email">Email</label>
                            <input type="text" name="email" />
                            <span class="error"><?= $err['username'] ?? '' ?></span>
                        </div>
                        <div class="input-control">
                            <label for="password">Password</label>
                            <input type="password" name="password" />
                            <span class="error"><?= $err['password'] ?? '' ?></span>
                        </div>
                        <span class="error"><?= $err['login'] ?? '' ?></span>
                        <div class="form-button">
                            <input type="submit" value="Login" name="btnLogin">
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>
