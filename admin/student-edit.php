<?php
include('includes/header.php');
include 'config/dbcon.php';

// Check if student_id is provided in the URL
if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    echo '<script>window.location.href = "show-student.php";</script>'; // Redirect if no id provided
    exit;
}

$conn = connection();  // Assuming this function connects to your database

$student_id = mysqli_real_escape_string($conn, $_GET['student_id']); // Sanitize the student_id
$err = [];

// Fetch student data based on student_id
$query = "SELECT * FROM students WHERE student_id = $student_id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $student = mysqli_fetch_assoc($result);  // Fetch student data as associative array
} else {
    echo '<script>alert("Student not found."); window.location.href = "index.php";</script>'; // Redirect if student not found
    exit;
}

// Update student data if form is submitted
if (isset($_POST['updateStudent'])) {
    if (isset($_POST['fname']) && !empty($_POST['fname']) && trim($_POST['fname'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    } else {
        $err['fname'] = 'Please enter first name';
    }
    
    if (isset($_POST['lname']) && !empty($_POST['lname']) && trim($_POST['lname'])) {
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    } else {
        $err['lname'] = 'Please enter last name';
    }
    
    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    } else {
        $err['phone'] = 'Please enter phone number';
    }
    
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    } else {
        $err['email'] = 'Please enter email';
    }
    
    if (isset($_POST['username']) && !empty($_POST['username']) && trim($_POST['username'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
    } else {
        $err['username'] = 'Please enter username';
    }
    
    // Update data if no errors
    if (empty($err)) {
        $query = "UPDATE students SET fname='$fname', lname='$lname', phone='$phone', email='$email', username='$username' WHERE student_id = $student_id";
        $result = mysqli_query($conn, $query);
        
        if ($result) {
            echo '<script>alert("Student updated successfully."); window.location.href = "index.php";</script>';
            exit;
        } else {
            echo '<script>alert("Failed to update student.");</script>';
        }
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Student
                    <a href="index.php" class="btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" value="<?= htmlspecialchars($student['fname']) ?>">
                                <span class="error"><?php if (isset($err['fname'])) { echo $err['fname']; } ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" value="<?= htmlspecialchars($student['lname']) ?>">
                                <span class="error"><?php if (isset($err['lname'])) { echo $err['lname']; } ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($student['phone']) ?>">
                                <span class="error"><?php if (isset($err['phone'])) { echo $err['phone']; } ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>">
                                <span class="error"><?php if (isset($err['email'])) { echo $err['email']; } ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($student['username']) ?>">
                                <span class="error"><?php if (isset($err['username'])) { echo $err['username']; } ?></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3 text-end">
                                <button type="submit" name="updateStudent" class="btn btn-primary">Update Student</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>