<?php

include('includes/header.php');
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}
?>

<div class="row">
    <div class="col-md-12">
                <h4>User Management
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-4">
          <div class="card card-body p-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Students</p>
                    <h5 class="font-weight-bolder mb-0">
                    <a href="student-create.php" class="btn btn-primary float-end">Add Student</a>
                    </h5>
                </div>
          </div>
          <div class="col-md-4 mb-4">
          <div class="card card-body p-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Teachers</p>
                    <h5 class="font-weight-bolder mb-0">
                    <a href="teacher-create.php" class="btn btn-primary float-end">Add Teacher</a>
                    </h5>
                </div>
          </div>
    </div>

