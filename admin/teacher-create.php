<?php

include('includes/header.php');
include 'config/dbcon.php';





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
            window.location.href = "show-teacher.php";
            </script>';
        }catch(exception $ex){
            die('Database error: '. $ex->getMessage());
        }

    }
}

?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Teacher
                    <a href="users.php" class="btn btn-danger float-end">Back</a>
                </h4>
                
            </div>
            <div class="card-body">

                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Fname</label>
                                <input type="text" name="fname" class="form-control" >
                                <span class="error"><?php if (isset($err['fname'])){echo $err['fname'];} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Lname</label>
                                <input type="text" name="lname" class="form-control" >
                                <span class="error"><?php if (isset($err['lname'])){echo $err['username'];} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="Phone" name="phone" class="form-control" >
                                <span class="error"><?php if (isset($err['phone'])){echo $err['phone'];} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="Email" name="email" class="form-control" >
                                <span class="error"><?php if (isset($err['email'])){echo $err['email'];} ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="Username" name="username" class="form-control" >
                                <span class="error"><?php if (isset($err['username'])){echo $err['username'];} ?></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 text-end">
                                <button type="submit" name="saveTeacher" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

