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

// Fetch teacher data from the database
$query = "SELECT * FROM teachers";  // Modify the query based on your database schema
$result = mysqli_query($conn, $query);

// Check if query was successful and fetch data
if ($result && mysqli_num_rows($result) > 0) {
    $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);  // Fetch all rows as associative array
} else {
    $teachers = [];  // Initialize as empty array if no results or error
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Teacher List
                    <a href="index.php" class="btn btn-danger float-end">Back</a>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teachers as $key => $teacher) { ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= htmlspecialchars($teacher['fname']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($teacher['lname']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($teacher['phone']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($teacher['email']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($teacher['username']) ?: 'N/A'; ?></td>
                            <td><?= htmlspecialchars($teacher['dob']) ?: 'N/A'; ?></td>
                            <td>
                                <a href="teacher-edit.php?teacher_id=<?= htmlspecialchars($teacher['teacher_id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="teacher-delete.php?teacher_id=<?= htmlspecialchars($teacher['teacher_id']); ?>" class="btn btn-danger btn-sm mx-2">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

