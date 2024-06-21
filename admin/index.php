<?php

include('includes/header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}
?>

<div class="row">
    <div class="col-md-12">
                <h4>Users List
                </h4>   
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-4">
          <div class="card card-body p-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Students</p>
                    <h5 class="font-weight-bolder mb-0">
                    <a href="show-student.php" class="btn btn-primary float-end">Show Students</a>
                    </h5>
                </div>
          </div>
          <div class="col-md-4 mb-4">
          <div class="card card-body p-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Teachers</p>
                    <h5 class="font-weight-bolder mb-0">
                    <a href="show-teacher.php" class="btn btn-primary float-end">Show Teachers</a>
                    </h5>
                </div>
          </div>
    </div>

