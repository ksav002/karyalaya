<?php
include('config/function.php');
include_once 'config/dbcon.php';





if (isset($_POST['saveTeacher'])) {
    $err = [];
    if (isset($_POST['fname']) && !empty($_POST['fname']) && trim($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else {
        $err['fname'] = 'Please enter first name';
    }
    
    if (isset($_POST['lname']) && !empty($_POST['lname']) && trim($_POST['lname'])) {
        $lname = $_POST['lname'];
    } else {
        $err['lname'] = 'Please enter last name';
    }
    
    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $err['phone'] = 'Please enter phone number';
    }
    
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = 'Please enter email';
    }
    
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $err['username'] = 'Please enter username';
    }
    
    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
        $hashed_password = md5($password);
    } else {
        $err['password'] = 'Please enter password';
    }
    
    if (empty($err)) {
        try{
            $conn = connection();
            $query = "INSERT INTO teachers (fname, lname, phone, email, username, password) VALUES ('$fname', '$lname', '$phone', '$email', '$username', '$hashed_password')";
            print_r($query);
            $result = mysqli_query($conn, $query);
            echo '<script>
            alert("Added teacher successfully.");
            window.location.href = "index.php";
            </script>';
        }catch(exception $ex){
            die('Database error: '. $ex->getMessage());
        }


        exit();
    }
}

?>
