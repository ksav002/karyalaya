<?php
include('includes/header.php');
include_once 'config/dbcon.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit(); // Stop executing the script
}
$conn = connection();  // Assuming this function connects to your database

// Fetch student data from the database
$query = "SELECT * FROM students";  // Modify the query based on your database schema
$result = mysqli_query($conn, $query);

// Check if query was successful and fetch data
if ($result && mysqli_num_rows($result) > 0) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);  // Fetch all rows as associative array
} else {
    $students = [];  // Initialize as empty array if no results or error
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Student List
                    <a href="users.php" class="btn btn-danger float-end">Back</a>
                </h4>
                
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Fname</th>
                            <th>Lname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Date-Of-Birth</th>
                            <th>Batch year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($students as $key => $student) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?= htmlspecialchars($student['fname']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['lname']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['phone']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['email']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['username']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['dob']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($student['batch_year']) ?: 'N/A'; ?></td>
                            <td>
                                <a href="student-edit.php?student_id=<?= htmlspecialchars($student['student_id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="student-delete.php?student_id=<?= htmlspecialchars($student['student_id']); ?>" class="btn btn-danger btn-sm mx-2">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


